<?php

namespace Modules\Agency\Entities;

use Illuminate\Database\Eloquent\Model;

class Treasury extends Model
{
    protected $fillable = ['agency_id'];

    public function currency()
    {
    	return $this->belongsTo(\Modules\Currency\Entities\Currency::class, 'currency_id');
    }

    public function counter()
    {
    	return $this->belongsTo(\App\User::class, 'counter_id');
    }
}
