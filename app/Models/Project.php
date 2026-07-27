<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'cover_image',
        'gallery_images',
        'location',
        'completed_at',
        'sort_order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'completed_at' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Accessor to safely convert cover image path to full public URL
    protected function coverImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->cover_image 
                ? (str_starts_with($this->cover_image, 'http') ? $this->cover_image : Storage::url($this->cover_image))
                : 'https://placehold.co/800x600/1F3B2C/F7F2E4?text=Project+Image',
        );
    }
}