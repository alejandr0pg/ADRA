<?php

namespace Modules\Emergency\Entities;

use Illuminate\Database\Eloquent\Model;

class Sitrep extends Model
{
    protected $fillable = ['emergency_id'];

    public function extra_info()
    {
        return $this->hasMany(SitrepExtraInfo::class, 'sitrep_id');
    }
}
