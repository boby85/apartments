<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ["name", "price", "currency", "description", "properties", "category_id", "rating", "slug"];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
