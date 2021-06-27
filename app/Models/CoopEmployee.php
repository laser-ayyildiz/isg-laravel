<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoopEmployee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'company_id',
        'email',
        'phone',
        'tc',
        'position',
        'recruitment_date',
    ];

    public function company()
    {
        return $this->belongsTo(CoopCompany::class)->withTrashed();
    }

    public function files()
    {
        return $this->hasMany(EmployeeToFile::class, 'employee_id');
    }
}
