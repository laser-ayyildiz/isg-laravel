<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'type',
        'name',
        'employer',
        'email',
        'phone',
        'bill_address',
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
        'contract_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(CoopCompany::class);
    }
}
