<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoopCompanies extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'address',
        'employer',
        'city',
        'town',
        'contract_at',
        'nace_kodu',
        'mersis_no',
        'sgk_sicil',
        'vergi_no',
        'vergi_dairesi',
        'katip_is_yeri_id',
        'katip_kurum_id',
        'change',
        'remi_freq',
        'changer',
        'deleted',
        'change_from'
    ];
}
