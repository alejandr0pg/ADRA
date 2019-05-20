<?php

namespace Modules\CorePlanification\Entities;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $fillable = [];



       /**
     * Get the comments for the blog post.
     */
    public function indicadores()
    {
        return $this->hasMany('Modules\CorePlanification\Entities\Indicador');
    }
    
}
