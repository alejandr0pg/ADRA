<?php

namespace Modules\Emergency\Entities;

use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    protected $fillable = [];

    public function contribution()
    {
        return $this->belongsTo(Contribution::class, 'contribution_id');
    }

    public function cordinator()
    {
        return $this->belongsTo(\App\User::class, 'cordinator_id');
    }

    public function currency()
    {
        return $this->belongsTo(\Modules\Currency\Entities\Currency::class, 'currency_id');
    }

    public function country()
    {
        return $this->belongsTo(\Modules\Country\Entities\Country::class, 'country_id');
    }

    public function agency()
    {
        return $this->belongsTo(\Modules\Agency\Entities\Agency::class, 'agency_id');
    }

    public function type()
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }

    public function nationalDirector()
    {
        return $this->belongsTo(\App\User::class, 'director_national_id');
    }

    public function regionalDirector()
    {
        return $this->belongsTo(\App\User::class, 'director_regional_id');
    }
}
