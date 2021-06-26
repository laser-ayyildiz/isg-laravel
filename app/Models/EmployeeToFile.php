<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeToFile extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'employee_id',
        'file_id'
    ];

    public function employee()
    {
        return $this->belongsTo(CoopEmployee::class)->withTrashed();
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}