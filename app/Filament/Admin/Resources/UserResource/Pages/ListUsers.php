<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

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
use Spatie\Permission\Models\Role;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('create')
                ->slideOver(true)
                ->modalIcon('heroicon-o-user')
                ->form([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('firstName')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('username')
                        ->required()
                        ->maxLength(255),
                        PhoneInput::make('phone_number')
                            ->label('Numéro de téléphone')
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
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Hidden::make('password')
                        ->default('password'),

                    Forms\Components\Select::make('role')
                        ->required()
                        ->options(Role::all()->pluck('name', 'name')),
                    Forms\Components\Select::make('department_id')
                        ->options(Department::all()->pluck('slug', 'id')),
                ])
                ->action(function (array $data) {
                    // dd($data);
                    $department = $data['department_id'];
                    $user = User::create($data);
                    $user->assignRoleWithDepartment($data['role'], $data['department_id']);
                    Notification::make('user_created_successfuly')
                        ->title('Cree avec succes')
                        ->body('Un utilisateur avec le role ' . $data['role'] . ' a ete cree avec succes')
                        ->success()
                        ->send();
                }),
        ];
    }
}
