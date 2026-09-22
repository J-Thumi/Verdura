<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'botanical_name',
        'category',
        'description',
        'price',
        'image_url',
        'is_featured',
        'is_active',
        'slug'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active plants.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for category filtering.
     */
    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    protected static function booted(): void
    {
        static::saved(function () {
            Cache::forget('featured_specimen');
            Cache::forget('all_active_plants');
        });

        static::deleted(function () {
            Cache::forget('featured_specimen');
            Cache::forget('all_active_plants');
        });

        static::creating(function (Plant $plant) {
            if (empty($plant->slug)) {
                $baseSlug = Str::slug($plant->name);
                $slug = $baseSlug;
                $counter = 1;

                while (static::where('slug', $slug)->exists()) {
                    $slug = "{$baseSlug}-{$counter}";
                    $counter++;
                }

                $plant->slug = $slug;
            }
        });
    }

    

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value && Storage::disk('public')->exists($value)
                ? Storage::url($value)
                : ($value ?: 'https://via.placeholder.com/400x300?text=Plant+Photo')
        );
    }

    /**
     * Use 'slug' for Route Model Binding instead of 'id'
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}