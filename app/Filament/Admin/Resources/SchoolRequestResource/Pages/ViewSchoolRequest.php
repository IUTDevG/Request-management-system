<?php

namespace App\Filament\Admin\Resources\SchoolRequestResource\Pages;

use Filament\Forms;
use App\Models\User;
use App\Enums\RoleType;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use App\Enums\SchoolRequestStatus;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Admin\Resources\SchoolRequestResource;

class ViewSchoolRequest extends ViewRecord
{
    protected static string $resource = SchoolRequestResource::class;

    protected function getHeaderActions(): array
    {
        $user = User::find(auth()->user()->id);
        return [
            ActionGroup::make([
                Action::make('status_to_review')
                    ->requiresConfirmation()
                    ->color(Color::Yellow)
                    ->label(__('Mark as in review'))

                    ->action(function ($record) {
                        try {
                            $record->status = SchoolRequestStatus::InReview->value;
                            $record->update();
                        } catch (\Throwable $th) {
                            Notification::make('error')
                                ->danger()
                                ->title(__('Server Error'))
                                ->body(__('Try again later'))
                                ->send()
                            ;
                        }
                    })
                    ->visible(function ($record) {
                        return $record->status == SchoolRequestStatus::Submitted->value || $record->status == SchoolRequestStatus::Cancelled->value;
                    })
                    ->hidden(fn($record) => $record->status == SchoolRequestStatus::Completed->value)
                    ->sendSuccessNotification()
                    ->successNotificationTitle(__('Mark as in review successfully')),/*  */
                Action::make('assign')
                    ->requiresConfirmation()
                    ->icon('heroicon-o-arrow-up-circle')
                    ->color(Color::Yellow)
                    ->form([
                        Forms\Components\Select::make('assigned_to')
                            ->required()
                            ->options(
                                function ($record) use ($user) {
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
                                }
                            )
                    ])
                    ->label(__('Assign it'))
                    ->action(function (array $data, $record) {
                        try {
                            $record->status = SchoolRequestStatus::Escalated->value;
                            $record->assigned_to = $data['assigned_to'];
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
                    ->hidden(fn($record) => $record->status == SchoolRequestStatus::Completed->value || $record->status == SchoolRequestStatus::Rejected->value)

                    ->visible(function ($record) use ($user) {
                        return ($record->status == SchoolRequestStatus::InReview->value || $record->status == SchoolRequestStatus::Escalated->value && $record->assigned_to == $user->getRole());
                    })
                    ->sendSuccessNotification()
                    ->successNotificationTitle(__('Assigned successfully')),
                Action::make('Reject_status')
                    ->icon('heroicon-o-x-circle')
                    ->label(__('Cancel Request'))
                    ->requiresConfirmation()
                    ->modalHeading(__('Reject status'))
                    ->modalDescription(__('Are you sure you want to reject :request ?', ['request' => $this->record->title]))
                    ->action(function ($record) {
                        try {
                            $record->status = SchoolRequestStatus::Rejected->value;
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
                    ->hidden(function ($record) {
                        $state =  $record->status;
                        if ($state == SchoolRequestStatus::Rejected->value) {
                            return true;
                        }
                    })
                    ->color(Color::Red),
                Action::make('status_to_completed')
                    ->requiresConfirmation()
                    ->color(Color::Sky)
                    ->icon('heroicon-o-check-circle')
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
                    })
                    ->visible(function ($record) use ($user) {
                        return $record->status == SchoolRequestStatus::InReview->value || ($record->status == SchoolRequestStatus::Escalated->value && $record->assigned_to == $user->getRole());
                    })
                    ->hidden(fn($record) => $record->status == SchoolRequestStatus::Completed->value)
                    ->sendSuccessNotification()
                    ->successNotificationTitle(__('Mark Complete')),

            ])
        ];
    }
}
