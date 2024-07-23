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
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class ViewSchoolRequest extends ViewRecord
{

    use InteractsWithRecord;
    protected static string $resource = SchoolRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('status_to_review')
                ->requiresConfirmation()
                ->color(Color::Yellow)
                ->label(__('Mark as in review'))

                ->action(function($record){
                    $record->status = SchoolRequestStatus::InReview;
                    $record->update();
                    return redirect()->route('filament.dashboard.resources.school-requests.index');
                })
                ->visible(function($record){
                    return $record->status == SchoolRequestStatus::Submitted->value || $record->status == SchoolRequestStatus::Cancelled->value;
                })
                ->sendSuccessNotification()
                ->successNotificationTitle(__('Mark as in review successfully')),
            Actions\Action::make('status_to_escalated')
                ->requiresConfirmation()
                ->color(Color::Yellow)
                ->label(__('Escalate it to director'))
                ->action(function($record){
                    $record->status = SchoolRequestStatus::Escalated;
                    $record->update();
                    return redirect()->route('filament.dashboard.resources.school-requests.index');
                })
                ->visible(function($record){
                    return $record->status == SchoolRequestStatus::InReview->value;
                })
                ->sendSuccessNotification()
                ->successNotificationTitle(__('Escalated successfully')),
            Actions\Action::make('status_to_reject')
                ->requiresConfirmation()
                ->color(Color::Red)
                ->label(__('Reject the request'))
                ->action(function($record){
                    $record->status = SchoolRequestStatus::Rejected;
                    $record->update();
                    return redirect()->route('filament.dashboard.resources.school-requests.index');
                })
                ->visible(function($record){
                    return $record->status == SchoolRequestStatus::InReview->value;
                })
                ->sendSuccessNotification()
                ->successNotificationTitle(__('Cancelled successfully')),
            Actions\Action::make('status_to_completed')
                ->requiresConfirmation()
                ->color(Color::Sky)
                ->label(__('Mark it completed'))
                ->action(function($record){
                    $record->status = SchoolRequestStatus::Completed;
                    $record->update();
                    // Notifi
                })
                ->visible(function($record){
                    return $record->status == SchoolRequestStatus::InReview->value ;
                })
                ->sendSuccessNotification()
                ->successNotificationTitle(__('Mark Complete')),

        ];
    }

    public static function canAccess(array $parameters = []): bool{
        $record = $parameters['record'];
        // Vérifier si l'utilisateur a le rôle ou la permission nécessaire
        $user = User::find(auth()->user()->id);
        // Exemple de vérification basée sur le statut
        switch ($record->status) {
            case SchoolRequestStatus::Submitted->value:
                return ($user->hasRole(RoleType::HEAD_OF_DEPARTMENT) || $user->hasRole(RoleType::ACADEMIC_MANAGER));
            case SchoolRequestStatus::Cancelled->value:
                return false;
            case SchoolRequestStatus::InReview->value:
                return ($user->hasRole(RoleType::HEAD_OF_DEPARTMENT) || $user->hasRole(RoleType::ACADEMIC_MANAGER));
            case SchoolRequestStatus::Escalated->value:
                return $user->hasRole(RoleType::DIRECTOR);
            case SchoolRequestStatus::Rejected->value:
                return false;
            case SchoolRequestStatus::Completed->value:
                return true;
            default:
                return false;
        }
    }
}
