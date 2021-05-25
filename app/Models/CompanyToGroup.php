<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyToGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'leader_id',
        'member_id',
    ];

    public function company()
    {
        return $this->belongsTo(CoopCompany::class);
    }
}
