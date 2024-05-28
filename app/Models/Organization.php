<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function addMembers(array $members, Organization $organization): bool
    {
        return DB::table('people')->whereIn('id', $members)->update('organization_id', $organization->id);
    }
}
