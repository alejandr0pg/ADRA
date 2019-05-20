<?php

namespace Modules\Emergency\Entities;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [];

    public function originCurrency()
    {
        return $this->belongsTo(\Modules\Currency\Entities\Currency::class, 'origin_currency_id');
    }

    public function donor()
    {
        return $this->belongsTo(\Modules\Donors\Entities\Donors::class, 'donor_id');
    }
}
