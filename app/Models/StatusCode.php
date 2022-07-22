<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusCode extends Model
{
    use HasFactory;

    //code
    const FALSE = 0;
    const TRUE = 1;
    const LARAVEL_VALIDATION_ERROR = 2;
    const EXCEPTION = 3;
    const FORCE_LOGOUT = 4;
    const RESOURCE_NOT_FOUND = 5;
    const MAINTENANCE_MODE = 6;
}
