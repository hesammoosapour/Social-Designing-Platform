<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, softDeletes,InteractsWithMedia ;
    protected $dates = ['deleted_at'];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function  registerMediaCollections(): void
    {
        $this->addMediaCollection('Design')
            ->acceptsMimeTypes(['image/jpg', 'image/gif', 'image/png', 'image/jpeg', 'image/bmp', 'image/tiff', 'image/webp'])
            ->withResponsiveImages()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(50)
                    ->height(50);
                $this->addMediaConversion('card')
                    ->width(368)
                    ->height(232)
                    ->sharpen(10);
                $this->addMediaConversion('big_card')
                    ->width(650)
                    ->height(500)
                    ->sharpen(30);
            });
    }

    public function userMedia()
    {
        return $this->morphOne(\App\Models\Media::class, 'modelable');
    }

}
