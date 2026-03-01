<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskManager extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'user_id',
            'name',
            'description',
            'start_date',
            'is_active',
        ];

    protected $casts =
        [
            'start_date' => 'date',
            'is_active' => 'boolean',
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
