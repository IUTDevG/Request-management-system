<?php

namespace App\Filament\Dashboard\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class RoleWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $roles = User::find(auth()->user()->id)->getRoleNames();
        $values = '';
        $i = 0;
        foreach($roles as $role){
            // dd($role);
            if($i==0){
            $values = $role;
            }
            else{
                $values += ', '.$role;
            }
            $i++;
        }

        // dd($values);
        // $values.

        return [
            Stat::make(
                label: 'Role:',
                value:( $values ?? ''),
            ),
        ];
    }
}
