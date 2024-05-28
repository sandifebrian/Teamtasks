<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'client', 'kickOffDate', 'targetDate', 'budget'];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function features(): HasMany
    {
        return $this->hasMany(Feature::class);
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
