<?php

namespace App\Filament\Admin\Resources\SchoolRequestResource\Widgets;

use App\Models\SchoolRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SchoolRequestOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('School Request'), SchoolRequest::all()->count())
        ];
    }
}
