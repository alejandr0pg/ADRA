<?php

namespace Modules\CorePlanification\Entities;

use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{		
	//protected $table = "lineas_de_accion" ;
    protected $fillable = ['descripcion'];


       /**
     * Get the comments for the blog post.
     */
    public function objetivos()
    {
        return $this->hasMany('Modules\CorePlanification\Entities\Objetivo');
    }
    

}
