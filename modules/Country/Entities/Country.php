<?php

namespace Modules\Country\Entities;

use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    protected $fillable = [
    	'slug', 'currency_id', 'lang_id', 'iso'
    ];

    public function currency()
    {
   		return $this->belongsTo(\Modules\Currency\Entities\Currency::class, 'currency_id');
    }

    public function lang()
    {
    	return $this->belongsTo(\App\Languaje::class, 'lang_id');
    }

}
