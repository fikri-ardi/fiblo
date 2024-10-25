<?php

namespace App\Models;

use App\Traits\Following;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Following;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

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

    protected $with = ['role'];

    /**
     * Get all of the user's post
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the user role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the user links
     */
    public function links()
    {
        return $this->hasOne(Link::class);
    }

    /**
     * Get all of the users's visitors 
     */
    public function visitors()
    {
        return $this->morphMany(Visitor::class, 'visitable');
    }

    public function hasRole($role)
    {
        return $this->role->name == $role;
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function password(): Attribute
    {
        return new Attribute(
            set: fn($value) => bcrypt($value)
        );
    }

    // public function photo(): Attribute
    // {
    //     return new Attribute(
    //         // get: fn($value) => $value ? asset("storage/$value") : null,
    //         // set: function ($value) {
    //         //     /**
    //         //      * $this->attibutes['photo'] berisi data yang ada di dalam field photo di table users
    //         //      */
    //         //     if (isset($this->attributes['photo'])) {
    //         //         Storage::delete($this->attributes['photo']);
    //         //     }
    //         //     return $this->attributes['photo'] = $value->store('images/users');
    //         // }
    //     );
    // }
}
