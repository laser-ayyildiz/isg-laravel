<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEducationType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'validity_period_type_1',
        'validity_period_type_2',
        'validity_period_type_3',
    ];
}
