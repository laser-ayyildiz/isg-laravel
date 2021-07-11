<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentToFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id',
        'file_id'
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
