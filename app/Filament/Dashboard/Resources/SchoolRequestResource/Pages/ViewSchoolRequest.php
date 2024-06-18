<?php

namespace App\Filament\Dashboard\Resources\SchoolRequestResource\Pages;

use App\Enums\SchoolRequestStatus;
use App\Filament\Dashboard\Resources\SchoolRequestResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;

class ViewSchoolRequest extends ViewRecord
{
    protected static string $resource = SchoolRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('change_status')
                ->requiresConfirmation()
                ->color(Color::Yellow)
                ->form([
                    Forms\Components\Select::make('status')
                    ->required()
                    ->options(SchoolRequestStatus::class)
                    // ->optionsLimit()

                ]),
        ];
    }
}
