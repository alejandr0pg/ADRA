<?php

namespace Modules\Emergency\Entities;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $fillable = ['name', 'path', 'type', 'file_type_id', 'emergency_id'];

    public function fileType()
    {
        return $this->belongsTo(\Modules\Tasks\Entities\Task::class, 'file_type_id');
    }
}
