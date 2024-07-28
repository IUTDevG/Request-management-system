<?php

namespace App\Filament\Admin\Resources\SchoolRequestResource\Pages;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use App\Enums\SchoolRequestStatus;
use Filament\Support\Colors\Color;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Admin\Resources\SchoolRequestResource;
use App\Enums\RoleType;
use Filament\Forms;
use Filament\Actions;

class ViewSchoolRequest extends ViewRecord
{
    protected static string $resource = SchoolRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                Actions\Action::make('status_to_escalated')
                ->requiresConfirmation()
                ->icon('heroicon-o-arrow-up-circle')
                ->color(Color::Yellow)
                ->form([
                    Forms\Components\Select::make('assigned_to')
                        ->required()
                        ->options(function () {
                            $roles = RoleType::cases();
                            $result = [];
                            $i = 0;
                            $user = User::find(auth()->user()->id);
                            foreach ($roles as $role) {
                                if ($role->value == $user->getRole() || $role->value == RoleType::STUDENT->value || $role->value == RoleType::SECRETARY_DIRECTOR->value || $role->value == RoleType::USER->value || $role->value == RoleType::HEAD_OF_DEPARTMENT->value) {
                                } else {
                                    $result[$role->value] = $role->value;
                                }
                                $i++;
                            }
                            return ($result);
                        })
                ])
                ->label(__('Assign it'))
                ->action(function (array $data, $record) {
                    $record->status = SchoolRequestStatus::Escalated;
                    $record->assigned_to = $data['assigned_to'];
                    $record->update();
                    return redirect()->route('filament.dashboard.resources.school-requests.index');
                })
                ->hidden(fn ($record) => $record->status == SchoolRequestStatus::Completed->value || $record->status == SchoolRequestStatus::Rejected->value)

                ->visible(function ($record) {
                    $user = User::find(auth()->user()->id);
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
                        $record->status = SchoolRequestStatus::Rejected;
                        $record->update();
                    })
                    ->hidden(function ($record) {
                      $state=  $record->status;
                      if ($state == SchoolRequestStatus::Rejected->value) {
                          return true;
                      }
                    })
                    ->color(Color::Red)
            ])
        ];
    }
}
