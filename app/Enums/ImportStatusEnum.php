<?php


namespace App\Enums;


enum ImportStatusEnum: int
{

    case IN_PROGRESS = 1;
    case SUCCESS = 3;
    case ERROR = 2;
}
