<?php

namespace App\Filament\Admin\Resources;

use App\Enums\RoleType;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use libphonenumber\PhoneNumberType;
use Illuminate\Database\Eloquent\Builder;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

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
                    ->required()
                    ->maxLength(255),
                Forms\Components\Hidden::make('password')
                    ->label(__('Password'))
                    ->default('password'),


            ]);
    }

    public static function table(Table $table): Table
    {
        // dd(auth()->user()->department);
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('firstName')
                    ->label(__('Firstname'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label(__('Role'))
                    ->getStateUsing(function ($record) {
                        return $record->getRoleNames()
                            ->map(function ($roleName) {
                                return RoleType::tryFrom($roleName)?->label() ?? $roleName;
                            })
                            ->implode(', ');
                    }),
                Tables\Columns\TextColumn::make('department')
                    ->label(__('Department'))
                    ->getStateUsing(function ($record) {
                        return ($record->getDepartment()->abbreviation ?? null);
                    }),


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
