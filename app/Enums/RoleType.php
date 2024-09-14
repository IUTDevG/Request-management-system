<?php

declare(strict_types = 1);
namespace App\Enums;

enum RoleType: string{
//On va utiliser les labels des enums dans les tables de la base de données
    case DIRECTOR = 'director';
    case SECRETARY_DIRECTOR = 'secretaire_director';
    case DEPUTY_DIRECTOR = 'deputy_director';
    case SCHOOLING = 'schooling';
    case COMPUTER_CELL = 'computer_cell';
    case HEAD_OF_DEPARTMENT = 'head_of_department';
    case ACADEMIC_MANAGER = 'academic_manager';

    case STUDENT = 'student';

//    case USER = 'user';

    public function label(): string
    {
        return match($this) {
            self::DIRECTOR => __('Director'),
            self::SECRETARY_DIRECTOR => __('Secretary Director'),
            self::DEPUTY_DIRECTOR => __('Deputy Director'),
            self::SCHOOLING => __('Schooling'),
            self::COMPUTER_CELL => __('Computer Cell'),
            self::HEAD_OF_DEPARTMENT => __('Head of Department'),
            self::ACADEMIC_MANAGER => __('Academic Manager'),
            self::STUDENT => __('Student'),
//            self::USER => __('User'),
        };
    }
}
