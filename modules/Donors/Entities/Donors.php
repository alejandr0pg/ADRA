<?php

namespace Modules\Donors\Entities;

use Illuminate\Database\Eloquent\Model;

class Donors extends Model
{
    protected $fillable = [];

    public function country()
    {
    	return $this->belongsTo(\Modules\Country\Entities\Country::class, 'country_id');
    }

    public function origin()
    {
    	return $this->belongsTo(Origin::class, 'origin_id');
    }
}
