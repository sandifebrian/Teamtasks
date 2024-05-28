<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'startDate', 'targetDate'];
    protected $with = ['taskStatus'];

    public function feature(): BelongsTo
    {
        return $this->belongsTo(Feature::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function assignee(): belongsTo
    {
        return $this->belongsTo(Person::class, 'assignee');
    }

    public function assigner(): belongsTo
    {
        return $this->belongsTo(Person::class, 'assigner');
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function taskLogs(): HasMany
    {
        return $this->hasMany(TaskLog::class);
    }

    public function taskStatus(): HasOne
    {
        return $this->hasOne(TaskLog::class)->latestOfMany();
    }
}
