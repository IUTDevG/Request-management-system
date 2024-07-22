<?php

namespace App\Filament\Admin\Resources\SchoolRequestResource\Pages;

use App\Enums\SchoolRequestStatus;
use App\Filament\Admin\Resources\SchoolRequestResource;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;

class ViewSchoolRequest extends ViewRecord
{
    protected static string $resource = SchoolRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
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
                      if ($state === SchoolRequestStatus::Rejected->value) {
                          return true;
                      }
                    })
                    ->color(Color::Red)
            ])
        ];
    }
}
