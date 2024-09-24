<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, HasUlids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Append profile photo URL to the user model.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        // the avatar is stored in the /storage/app/private/avatars folder

        return $this->profile_photo_path ? Storage::url($this->profile_photo_path) : 'https://eu.ui-avatars.com/api/?name=' . urlencode($this->name) . '&size=250';
    }

    /**
     * Get the notifications for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the wishlist for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }


    /**
     * Get the ratings and reviews for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */ 
    public function reviews()
    {
        // the Review model is a polymorphic model that has a reviewable_id and reviewable_type
        // the reviewable_id is the id of the model that is being reviewed
        // the reviewable_type is the type of the model that is being reviewed
        // the user_id is the id of the user that is reviewing the model
        // the rating is the rating of the model
        // the review is the review of the model
        return $this->morphMany(Review::class, 'reviewable');
    }

    /**
     * Get the listings for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}
