<?php

namespace Modules\Emergency\Entities;

use Illuminate\Database\Eloquent\Model;

class ConceptExpenditure extends Model
{
    protected $fillable = [];

    public function expenditure()
    {
        return $this->hasMany(Expenditure::class, 'concept_id');
    }
}
