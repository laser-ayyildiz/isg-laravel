<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'period',
        'valid_date',
        'maintained_at',
    ];

    public function company()
    {
        return $this->belongsTo(CoopCompany::class);
    }

    public function file()
    {
        return $this->hasMany(EquipmentToFile::class);
    }
}
