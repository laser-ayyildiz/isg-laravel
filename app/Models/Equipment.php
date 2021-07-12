<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'period',
        'file_id',
        'valid_date',
        'maintained_at',
    ];

    public function company()
    {
        return $this->belongsTo(CoopCompany::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
