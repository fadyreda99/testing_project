<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\UpdatedEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    public function sendPasswordResetNotification($token): Void
    {
        $this->notify(new updatedEmailNotification($token));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'social_id',
        'social_type',
    ];

    protected $attributes = [
        'social_type'=>'testing'
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
        'password' => 'hashed',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // public function phones()
    // {
    //     return $this->hasMany(Phone::class);
    // }
    public function phone()
    {
        return $this->hasOne(Phone::class);
    }

    public function serial(){
        return $this->hasOneThrough(Serial::class, Phone::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function latestPost(){
        return $this->hasOne(Post::class)->latestOfMany();
    }

    public function comments(){
        return $this->hasManyThrough(Comment::class, Post::class);
    }

    public function rules(){
        return $this->belongsToMany(Rule::class);
    }

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
}
