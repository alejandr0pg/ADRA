<?php

namespace Modules\Agency\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    use SoftDeletes;
    
    protected $fillable = [];

    public function country()
    {
    	return $this->belongsTo(\Modules\Country\Entities\Country::class, 'country_id');
    }

    public function treasury()
    {
    	return $this->hasOne(Treasury::class, 'agency_id');
    }

    public function director()
    {
    	return $this->belongsTo(\App\User::class, 'director_id');
    }

    public function belongs_to()
    {
        return $this->belongsTo(Agency::class, 'belong_to');
    }

    public function childrens()
    {
        return $this->hasMany(Agency::class, 'belong_to');
    }

}
