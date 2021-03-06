<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyFileType extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'validity_period_type_1',
        'validity_period_type_2',
        'validity_period_type_3',
    ];
}
