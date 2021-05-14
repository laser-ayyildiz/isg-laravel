<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeToFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'file_id'
    ];

    public function employee()
    {
        return $this->belongsTo(CoopEmployee::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}