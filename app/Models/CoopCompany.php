<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoopCompany extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'employer',
        'email',
        'phone',
        'address',
        'city',
        'town',
        'remi_freq',
        'nace_kodu',
        'mersis_no',
        'sgk_sicil',
        'vergi_no',
        'vergi_dairesi',
        'katip_is_yeri_id',
        'katip_kurum_id',
        'change',
        'contract_at'
    ];
}
