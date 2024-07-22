<?php

namespace App\Filament\Dashboard\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class RoleWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $authuser = User::find(auth()->user()->id)->getRoleNames();
        return [
            Stat::make(
                label: 'Meilleur fournisseur du mois:',
                value:( $authuser ?? ''),
            ),
        ];
    }
}
