<?php

namespace App\Services;

use App\Enums\RoleType;
use Illuminate\Support\Facades\Auth;

class UserRedirectService
{
    public static function getRedirectUrl(): string
    {
        $user = Auth::user();

        if (!$user) {
            return route('login');
        }

        if ($user->hasRole(RoleType::COMPUTER_CELL)) {
            return url('/admin');
        }

        if ($user->hasAnyRole([
            RoleType::ACADEMIC_MANAGER,
            RoleType::DEPUTY_DIRECTOR,
            RoleType::SCHOOLING,
            RoleType::SECRETARY_DIRECTOR,
            RoleType::DIRECTOR,
            RoleType::HEAD_OF_DEPARTMENT
        ])) {
            return url('/dashboard');
        }

        if ($user->hasRole(RoleType::STUDENT)) {
            return route('student.home');
        }

        return route('login');
    }
}