<?php

declare(strict_types = 1);
namespace App\Enums;

enum RoleType: string{

    case DIRECTOR = 'director';
    case SECRETARY_DIRECTOR = 'secretaire_director';
    case DEPUTY_DIRECTOR = 'deputy_director';
    case SCHOOLING = 'schooling';
    case COMPUTER_CELL = 'computer_cell';

    case ACADEMIC_MANAGER = 'academic_manager';

    case STUDENT = 'student';

    case USER = 'user';
}
