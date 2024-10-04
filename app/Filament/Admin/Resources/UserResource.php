<?php

namespace App\Filament\Admin\Resources;

use App\Enums\RoleType;
use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\Department;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    //    protected static ?string $navigationGroup='École';
    public static function getNavigationGroup(): string
    {
        return (__('School'));
    }

    public static function getModelLabel(): string
    {
        return (__('Users'));
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('firstName')
                    ->label(__('Firstname'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('username')
                    ->label(__('Username'))
                    ->required()
                    ->unique('users', 'username', ignoreRecord: true)
                    ->maxLength(255),
                PhoneInput::make('phone_number')
                    ->label(__('Phone number'))
                    ->countryStatePath('phone_country')
                    ->required()
                    ->startsWith(
                        [
                            '+23762',
                            '+23765',
                            '+23766',
                            '+23767',
                            '+23768',
                            '+23769'
                        ]
                    )
                    ->unique(ignoreRecord: true)
                    ->validateFor("CM", PhoneNumberType::MOBILE, true)
                    ->onlyCountries(['CM'])
                    ->initialCountry('CM'),
                Forms\Components\TextInput::make('email')
                    ->label(__('Email address'))
                    ->email()
                    ->unique('users', 'email', ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = User::withoutRole(RoleType::STUDENT);
        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('firstName')
                    ->label(__('Firstname'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label(__('Role'))
                    ->limit(25)
                    ->getStateUsing(function ($record) {
                        return $record->getRoleNames()
                            ->map(function ($roleName) {
                                return RoleType::tryFrom($roleName)?->label() ?? $roleName;
                            })
                            ->implode(', ');
                    }),
                Tables\Columns\TextColumn::make('department')
                    ->label(__('Department'))
                    ->badge()
                    ->getStateUsing(function ($record) {
                        return ($record->getDepartment()->abbreviation ?? null);
                    }),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email address'))
                    ->copyable(true)
                    ->copyMessage('Copied')
                    ->copyMessageDuration('1500'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label(__('View user'))
                        ->color('primary'),
                    Tables\Actions\EditAction::make()
                        ->label(__('Edit user'))
                        ->color('secondary'),
                    Tables\Actions\Action::make('edit_role')
                        ->label(__('Edit role'))
                        ->color('warning')
                        ->icon('heroicon-o-user-group')
                        ->form([
                            Forms\Components\Select::make('role')  // Changer '' en 'role'
                                ->label(__('Role'))
                                ->options(function () {
                                    return collect(RoleType::cases())
                                        ->filter(fn($role) => $role->value !== RoleType::STUDENT->value)
                                        ->mapWithKeys(fn($role) => [$role->value => $role->label()])
                                        ->toArray();
                                })
                                ->required(),
                            Forms\Components\Select::make('department_id')
                                ->label(__('Department'))
                                ->requiredIf('role', [RoleType::ACADEMIC_MANAGER->value, RoleType::HEAD_OF_DEPARTMENT->value])
                                ->options(Department::all()->pluck('name', 'id')),
                        ])
                        ->action(function (array $data, Model $record) {
                            $user = $record;

                            if ($user->getRole()) {
                                $user->removeRole($user->getRole());
                            }
                            if ($data['role'] == RoleType::ACADEMIC_MANAGER->value || $data['role'] == RoleType::HEAD_OF_DEPARTMENT->value) {
                                $user->assignRoleWithDepartment($data['role'], $data['department_id']);
                            } else {
                                $user->assignRole($data['role']);
                            }
                            Notification::make('user_role_changed_successfully')
                                ->title(__('User role changed successfully'))
                                ->body(__('Role of user :user has been changed to :role', ['user' => $user->name, 'role' => RoleType::tryFrom($data['role'])->label()]))
                                ->success()
                                ->send();
                        }),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(__('Delete selected users')),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            // 'view' => Pages\ViewUser::route('/{record}'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
