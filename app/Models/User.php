<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes; // Thêm SoftDeletes vào đây
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username', // Thêm vào đây
        'email',
        'password',
        'role',       // Thêm vào đây
        'gender',     // Thêm vào đây
        'birthdate',  // Thêm vào đây
        'address',    // Thêm vào đây
        'slogan',     // Thêm vào đây
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
        'birthdate' => 'date', // Cast birthdate thành kiểu date
    ];

    // Định nghĩa mối quan hệ với Post (một User có nhiều Post)
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Định nghĩa mối quan hệ với Comment (một User có nhiều Comment)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
