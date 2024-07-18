<?php

namespace App\Filament\Dashboard\Resources\SchoolRequestResource\Pages;

use App\Filament\Dashboard\Resources\SchoolRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolRequest extends EditRecord
{
    protected static string $resource = SchoolRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            // Actions\DeleteAction::make(),
        ];
    }
}
