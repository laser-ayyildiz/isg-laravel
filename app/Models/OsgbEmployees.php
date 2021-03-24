<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OsgbEmployees extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_type',
        'firstname',
        'lastname',
        'email',
        'phone',
        'tc',
        'start_at',
        'deleted',
        'worker_text',
    ];
}
