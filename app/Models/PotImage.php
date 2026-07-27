<?php

// app/Models/PotImage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PotImage extends Model
{
    protected $guarded = [];

    public function pot(): BelongsTo
    {
        return $this->belongsTo(Pot::class);
    }
}