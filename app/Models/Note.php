<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory, SoftDeletes, MassPrunable;

    protected $table = 'notes';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'date',
        'is_favorite',
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
    ];

    public function prunable(): Builder
    {
        return static::onlyTrashed()->where('deleted_at', '<=', now()->subDays(30));
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    // --- Query Scopes ---

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%');
        });
    }

    public function scopeFavorites(Builder $query, bool $favoritesOnly): Builder
    {
        if ($favoritesOnly) {
            return $query->where('is_favorite', true);
        }
        return $query;
    }

    public function scopeByTag(Builder $query, ?int $tagId): Builder
    {
        if ($tagId) {
            return $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('tags.id', $tagId);
            });
        }
        return $query;
    }

    public function scopeSort(Builder $query, string $orderBy): Builder
    {
        return match ($orderBy) {
            'alphabetical' => $query->orderBy('title', 'asc'),
            'newest' => $query->orderBy('date', 'desc'),
            'oldest' => $query->orderBy('date', 'asc'),
            default => $query->orderBy('is_favorite', 'desc')->orderBy('created_at', 'desc'),
        };
    }
}
