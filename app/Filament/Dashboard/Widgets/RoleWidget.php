<?php

namespace App\Filament\Dashboard\Widgets;

use App\Models\User;
use App\Enums\RoleType;
use App\Enums\SchoolRequestStatus;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class RoleWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $user = User::find(auth()->user()->id);
        // $role
        $user = $user->getRole();
        if ($user){
            $user = RoleType::tryFrom($user)->label();
        }
        return [
            Stat::make(
                label: 'Role:',
                value: ($user ?? ''),
            ),
        ];
    }
}
