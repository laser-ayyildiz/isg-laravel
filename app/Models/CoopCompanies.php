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
        'uzman_id',
        'uzman_id_2',
        'uzman_id_3',
        'hekim_id',
        'hekim_id_2',
        'hekim_id_3',
        'saglık_p_id',
        'saglık_p_id_2',
        'ofis_p_id',
        'ofis_p_id_2',
        'muhasebe_p_id',
        'muhasebe_p_id_2',
        'yetkili_id',
        'change',
        'remi_freq',
        'changer',
        'deleted',

    ];
}
