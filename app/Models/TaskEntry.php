<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskEntry extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'task_id',
            'entry_date',
            'actual_value',
        ];

    protected $casts =
        [
            'entry_date' => 'date',
            'actual_value' => 'integer',
        ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
