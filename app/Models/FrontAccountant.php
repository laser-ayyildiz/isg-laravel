<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrontAccountant extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'phone',
        'email',
    ];

    public function company()
    {
        return $this->belongsTo(CoopCompany::class);
    }
}
