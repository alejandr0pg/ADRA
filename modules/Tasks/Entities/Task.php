<?php

namespace Modules\Tasks\Entities;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [];

    public function checklist()
    {
        return $this->hasMany(TasksChecklist::class, 'task_id');
    }
}
