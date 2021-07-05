<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyToFile extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'company_id',
        'file_id',
        'file_type',
        'assigned_at',
        'valid_date'
    ];

    public function type()
    {
        return $this->belongsTo(CompanyFileType::class, 'file_type');
    }

    public function company()
    {
        return $this->belongsTo(CoopCompany::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
