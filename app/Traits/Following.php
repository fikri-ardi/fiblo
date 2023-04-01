<?php

namespace App\Traits;

use App\Models\{User, Post};

trait Following
{
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'user_id')->withTimestamps();
    }

    public function follow(User $user)
    {
        /**
         * jadi di belakang layar, kode diatas akan mengisi field user_id di table follows dengan id user yang saat ini sedang di pilih atau sedang active,
         * lalu akan mengisi field following_user_id dengan $user->id yang dikirim di parameter User $user
         */

        /**
         * $this di sini mengacu pada user yang sedang login jika kita menggunakan auth()->user() untuk
         * mengakses method follow() ini, contoh: auth()->user()->follow($post->author)
         * 
         * $user adalah target user yang ingin kita follow, seperti author post
         */
        if ($this->id !== $user->id) {
            return $this->wasFollow($user) ? $this->unfollow($user) : $this->follows()->save($user);
        }
    }

    public function unfollow(User $user)
    {
        /**
         * jadi di belakang layar, kode diatas akan mengakses table follows,
         * lalu memisahkan user_id dengan following_user_id atau menghapus baris data tersebut.
         */
        return $this->follows()->detach($user);
    }

    public function wasFollow(User $user)
    {
        return $this->follows()->where('following_user_id', $user->id)->first();
    }

    public function followedPost()
    {
        $following = $this->follows()->pluck('id');
        return Post::whereIn('user_id', $following)
            ->orWhere('user_id', auth()->id())
            ->latest();
    }
}
