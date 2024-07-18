<?php
declare(strict_types = 1);
namespace App\Enums;

enum LevelType : string{
    case LEVEL_ONE = 'level 1';
    case LEVEL_TWO = 'level 2';
    case LEVEL_THREE = 'level 3';
    case LEVEL_FOUR = 'level 4';
    case LEVEL_FIVE = 'level 5';
}
