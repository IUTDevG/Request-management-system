<?php

namespace App\Filament\Dashboard\Resources\SchoolRequestResource\Pages;

use App\Filament\Dashboard\Resources\SchoolRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSchoolRequest extends ViewRecord
{
    protected static string $resource = SchoolRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
