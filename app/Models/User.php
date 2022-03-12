<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role)
    {
        return $this->role->name == $role;
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = bcrypt($password);
    }

    public function setPhotoAttribute($photo)
    {
        if (isset($this->attributes['photo'])) {
            Storage::delete($this->attributes['photo']);
        }
        return $this->attributes['photo'] = $photo->store('images/users');
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id')->withTimestamps();
    }

    public function follow(User $user)
    {
        return $this->follows()->save($user);
        // jadi di belakang layar, kode diatas akan mengisi field user_id di table follows dengan id user yang saat ini sedang di pilih atau sedang active,
        // lalu akan mengisi field following_user_id dengan $user->id yang dikirim di parameter User $user
    }

    public function followedPost()
    {
        $following = $this->follows()->pluck('id');
        return Post::whereIn('user_id', $following)
            ->orWhere('user_id', auth()->id())
            ->latest();
    }
}