<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'position'];
    protected $tableName = 'people';

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'supervisor_id');
    }

    public function userInfo(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function projects(): HasMany
    // {
    //     return $this->hasMany(Project::class);
    // }

    // public function features(): HasMany
    // {
    //     return $this->hasMany(Feature::class);
    // }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
