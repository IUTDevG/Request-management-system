<?php

namespace App\Filament\Dashboard\Resources\SchoolRequestResource\Pages;

use App\Filament\Dashboard\Resources\SchoolRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolRequests extends ListRecords
{
    protected static string $resource = SchoolRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
