<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// this model represents a listing of room/flat/house for rent
class Listing extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'location',
        'status',
    ];

    /**
     * Get the user that owns the listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reviews for the listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

}
