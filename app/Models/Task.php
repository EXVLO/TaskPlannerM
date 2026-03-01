<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'task_manager_id',
            'name',
            'description',
            'daily_target',
            'is_active',
        ];

    protected $casts =
        [
            'daily_target' => 'integer',
            'is_active' => 'boolean',
        ];

    public function taskManager()
    {
        return $this->belongsTo(TaskManager::class);
    }

    public function entries()
    {
        return $this->hasMany(TaskEntry::class);
    }
}
