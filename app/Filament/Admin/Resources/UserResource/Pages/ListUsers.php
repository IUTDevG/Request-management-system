<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Enums\RoleType;
use Filament\Actions;
use libphonenumber\PhoneNumberType;
use Filament\Forms;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Admin\Resources\UserResource;
use App\Models\Department;
use App\Models\User;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Mockery\Matcher\Not;
use Spatie\Permission\Models\Role;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('create')
                ->label(__('Add a user'))
                ->slideOver(true)
                ->icon('heroicon-o-plus')
                ->modalIcon('heroicon-o-user')
                ->form([
                    Forms\Components\TextInput::make('name')
                        ->label(__('Name'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('firstName')
                        ->label(__('Firstname'))
                        ->maxLength(255),
                    Forms\Components\TextInput::make('username')
                        ->label(__('Username'))
                        ->unique('users', 'username')
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
                        ->unique('users', 'email')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('password')
                        ->label(__('Password'))
                        ->password(true)
                        ->required()
                        ->revealable(true),

                    Forms\Components\Select::make('role')
                        ->label(__('Role'))
                        ->required()
                        ->options(
                            function () {
                                return collect(RoleType::cases())->mapWithKeys(function ($role) {
                                    if ($role->value !== RoleType::STUDENT->value) {
                                        return [$role->value => $role->label()];
                                    }
                                    return [];
                                })->toArray();
                            }
                        ),
                    Forms\Components\Select::make('department_id')
                        ->label(__('Department'))
                        ->requiredIf('role', [RoleType::ACADEMIC_MANAGER->value, RoleType::HEAD_OF_DEPARTMENT->value])
                        ->options(Department::all()->pluck('name', 'id')),
                ])
                ->action(function (array $data) {
                    try {
                        $user = User::create($data);
                        if ($data['role'] == RoleType::ACADEMIC_MANAGER->value || $data['role'] == RoleType::HEAD_OF_DEPARTMENT->value) {
                            $user->assignRoleWithDepartment($data['role'], $data['department_id']);
                        }
                        $role = RoleType::tryFrom($data['role'])->label();
                        Notification::make('user_created_successfuly')
                            ->title(__('User created successfully'))
                            ->body('Un utilisateur avec le role ' . $role . ' a ete cree avec succes')
                            ->success()
                            ->send();
                    } catch (\Throwable $th) {
                        Notification::make('user_creation_failed')
                            ->title(__('Creation de l\'utilisateur a echoue'))
                            ->body($th->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
