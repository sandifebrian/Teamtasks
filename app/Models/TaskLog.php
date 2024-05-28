<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    use HasFactory;
    protected $fillable = ['status'];

    /**
     * Get the task associated with the TaskLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function task(): HasOne
    {
        return $this->hasOne(Task::class);
    }
}
