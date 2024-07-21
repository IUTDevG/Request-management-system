<?php

namespace App\Filament\Admin\Resources\SchoolRequestResource\Pages;

use App\Filament\Admin\Resources\SchoolRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolRequest extends EditRecord
{
    protected static string $resource = SchoolRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
