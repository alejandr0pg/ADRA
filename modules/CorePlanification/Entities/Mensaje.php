<?php

namespace Modules\CorePlanification\Entities;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = [];




 public function autor()
    {
        return $this->belongsTo('App\User','autor_id');
    }
}
