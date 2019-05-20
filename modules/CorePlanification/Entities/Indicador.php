<?php

namespace Modules\CorePlanification\Entities;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    protected $fillable = [];	



    /**
     * Get the comments for the blog post.
     */
    public function documentos()
    {
        return $this->hasMany('Modules\CorePlanification\Entities\Document');
    }

 public function objetivo()
    {
        return $this->belongsTo('Modules\CorePlanification\Entities\Objetivo','objetivo_id');
    }


    /**
     * Get the comments for the blog post.
     */
    public function medios_verificacion()
    {
        return $this->hasMany('Modules\CorePlanification\Entities\Document','verification_id');
    }
    
     /**
     * Get the comments for the blog post.
     */
    public function mensajes()
    {
        return $this->hasMany('Modules\CorePlanification\Entities\Mensaje','indicador_id');
    }
    
}
