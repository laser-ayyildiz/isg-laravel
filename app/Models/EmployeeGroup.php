<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'employee_id',
        'assignment_file_id',
        'osgb_employee_id',
        'isveren',
        'group',
        'sub_group',
    ];

    public function company()
    {
        return $this->belongsTo(CoopCompany::class, 'company_id');
    }

    public function employee()
    {
        return $this->belongsTo(CoopEmployee::class, 'employee_id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'assignment_file_id');
    }

    public function osgbEmployee()
    {
        return $this->belongsTo(User::class, 'osgb_employee_id');
    }
}
