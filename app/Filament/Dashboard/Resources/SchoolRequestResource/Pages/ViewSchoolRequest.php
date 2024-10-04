<?php

namespace App\Filament\Dashboard\Resources\SchoolRequestResource\Pages;

use Filament\Forms;
use App\Models\User;
use Filament\Actions;
use App\Enums\RoleType;
use App\Enums\SchoolRequestStatus;
use Filament\Support\Colors\Color;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Dashboard\Resources\SchoolRequestResource;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Illuminate\Support\Facades\Log;

class ViewSchoolRequest extends ViewRecord
{

    use InteractsWithRecord;
    protected static string $resource = SchoolRequestResource::class;

    protected function getHeaderActions(): array
    {
        $user = User::find(auth()->user()->id);
        return [
            Action::make('status_to_review')
                ->requiresConfirmation()
                ->color(Color::Yellow)
                ->label(__('Mark as in review'))
                ->action(function ($record) {
                    try {
                        $record->status = SchoolRequestStatus::InReview->value;
                        $record->update();
                    } catch (\Exception $e) {
                        Notification::make('error')
                            ->danger()
                            ->title(__('Server Error'))
                            ->body(__('Try again later'))
                            ->send();
                        Log::alert($e->getMessage());
                    }
                })
                ->visible(function ($record) use ($user) {
                    return (($record->status == SchoolRequestStatus::Submitted->value || $record->status == SchoolRequestStatus::Cancelled->value) && ($user->getRole() !== RoleType::SECRETARY_DIRECTOR->value));
                    })
                ->hidden(fn($record) => $record->status == SchoolRequestStatus::Completed->value)
                ->sendSuccessNotification()
                ->successNotificationTitle(__('Mark as in review successfully')),
            Action::make('status_to_escalated')
                ->requiresConfirmation()
                ->color(Color::Yellow)
                ->form([
                    Forms\Components\Select::make('assigned_to')
                        ->required()
                        ->options(function ($record) use ($user) {
                            try {
                                return collect(RoleType::cases())->mapWithKeys(function ($role) use ($user, $record) {
                                    if (($role->value !== RoleType::STUDENT->value && $user->getRole() !== $role->value)) {
                                        if (($role->value == RoleType::HEAD_OF_DEPARTMENT || $role->value == RoleType::ACADEMIC_MANAGER) && User::existWithRoleInDepartement($record->id, $role->value)) {
                                            return [$role->value => $role->label()];
                                        }
                                        if ((User::existWithRole($role->value))) {
                                            return [$role->value => $role->label()];
                                        }
                                    }
                                    return [];
                                })->toArray();
                            } catch (\Exception $e) {
                                Notification::make('error')
                                    ->danger()
                                    ->title(__('Server Error'))
                                    ->body(__('Try again later'))
                                    ->send();
                                Log::alert($e->getMessage());
                            }
                        })
                ])
                ->label(__('Assign it'))
                ->action(function (array $data, $record) {
                    try {
                        $record->status = SchoolRequestStatus::Escalated->value;
                        $record->assigned_to = $data['assigned_to'];
                        $record->update();
                        return redirect()->route('filament.dashboard.resources.school-requests.index');
                    } catch (\Exception $e) {
                        Notification::make('error')
                            ->danger()
                            ->title(__('Server Error'))
                            ->body(__('Try again later'))
                            ->send();
                        Log::alert($e->getMessage());
                    }
                })
                ->hidden(fn($record) => $record->status == SchoolRequestStatus::Completed->value || $record->status == SchoolRequestStatus::Rejected->value)

                ->visible(function ($record) use ($user) {
                    return (($record->status == SchoolRequestStatus::InReview->value || $record->status == SchoolRequestStatus::Escalated->value && $record->assigned_to == $user->getRole()) || ($user->getRole() == RoleType::SECRETARY_DIRECTOR->value && $record->status == SchoolRequestStatus::Submitted->value));
                })
                ->sendSuccessNotification()
                ->successNotificationTitle(__('Assigned successfully')),
            Action::make('status_to_reject')
                ->requiresConfirmation()
                ->color(Color::Red)
                ->label(__('Reject the request'))
                ->action(function ($record) {
                    try {
                        $record->status = SchoolRequestStatus::Rejected->value;
                        $record->update();
                        return redirect()->route('filament.dashboard.resources.school-requests.index');
                    } catch (\Exception $e) {
                        Notification::make('error')
                            ->danger()
                            ->title(__('Server Error'))
                            ->body(__('Try again later'))
                            ->send();
                        Log::alert($e->getMessage());
                    }
                })
                ->visible(function ($record) use ($user) {
                    return ($record->status == SchoolRequestStatus::InReview->value || ($record->status == SchoolRequestStatus::Escalated->value && $record->assigned_to == $user->getRole()));
                })
                ->hidden(fn($record) => $record->status == SchoolRequestStatus::Completed->value)
                ->sendSuccessNotification()
                ->successNotificationTitle(__('Cancelled successfully')),
            Action::make('status_to_completed')
                ->requiresConfirmation()
                ->color(Color::Sky)
                ->label(__('Mark it completed'))
                ->action(function ($record) {
                    try {
                        $record->status = SchoolRequestStatus::Completed->value;
                        $record->update();
                    } catch (\Exception $e) {
                        Notification::make('error')
                            ->danger()
                            ->title(__('Server Error'))
                            ->body(__('Try again later'))
                            ->send();
                        Log::alert($e->getMessage());
                    }
                    // Notifi
                })
                ->visible(function ($record) use ($user) {
                    return $record->status == SchoolRequestStatus::InReview->value || ($record->status == SchoolRequestStatus::Escalated->value && $record->assigned_to == $user->getRole());
                })
                ->hidden(fn($record) => $record->status == SchoolRequestStatus::Completed->value)
                ->sendSuccessNotification()
                ->successNotificationTitle(__('Mark Complete')),

        ];
    }

    public static function canAccess(array $parameters = []): bool
    {
        $record = $parameters['record'];
        // Vérifier si l'utilisateur a le rôle ou la permission nécessaire
        $user = User::find(auth()->user()->id);
        // Exemple de vérification basée sur le statut
        switch ($record->status) {
            case SchoolRequestStatus::Submitted->value:
                return ($user->hasRole(RoleType::SECRETARY_DIRECTOR));
            case SchoolRequestStatus::Cancelled->value:
                return false;
            case SchoolRequestStatus::InReview->value:
                return ($user->hasRole(RoleType::HEAD_OF_DEPARTMENT) || $user->hasRole(RoleType::ACADEMIC_MANAGER));
            case SchoolRequestStatus::Escalated->value:
                return ($record->assigned_to == $user->getRole());
            case SchoolRequestStatus::Rejected->value:
                return false;
            case SchoolRequestStatus::Completed->value:
                return true;
            default:
                return false;
        }
    }
}
