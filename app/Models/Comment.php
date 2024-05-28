<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content'];
    protected $defaults = [
        'creator_id' => 1
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function attachment(): MorphOne
    {
        return $this->morph(Attachment::class, 'attachable');
    }
}
