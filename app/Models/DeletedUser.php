<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'auth_type',
        'firstname',
        'lastname',
        'recruitment_date',
        'email',
        'tc',
        'phone',
        'profile_photo_path'
    ];
}
