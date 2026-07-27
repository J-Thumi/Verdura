<?php
// app/Models/Pot.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Pot extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'has_drainage_holes' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($pot) {
            if (empty($pot->slug)) {
                $pot->slug = Str::slug($pot->name);
            }
        });
    }

    public function images(): HasMany
    {
        return $this->hasMany(PotImage::class)->orderBy('sort_order', 'asc');
    }
}