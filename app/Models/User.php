<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'gender',
        'birthdate',
        'address',
        'slogan',
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
        'birthdate' => 'date',
    ];


    // 1 User có nhiều Post (HasMany)
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // 1 User có nhiều Comment (HasMany)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Có quan hệ nhiều-nhiều với model khác qua bảng trung gian (user_roles) (BelongsTomany)
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    // Eager Loading là kỹ thuật tải trước các quan hệ của một model cùng lúc với model chính.
    public function hasRole(string $roleName): bool
    {
        // Kiểm tra xem quan hệ 'roles' đã được load từ trước chưa (tức là dùng eager loading)
        if ($this->relationLoaded('roles')) {
            // Nếu đã load rồi, kiểm tra trong collection roles xem có role nào có 'name' đúng $roleName
            return $this->roles->contains('name', $roleName);
        }
        // Nếu chưa load, thì truy vấn trong DB
        return $this->roles()->where('name', $roleName)->exists();
    }

    public function hasPermission(string $permissionName): bool
    {
        // Lặp qua tất cả các vai trò của người dùng
        foreach ($this->roles as $role) {
            // Nếu permission đã được eager load ở role
            if ($role->relationLoaded('permissions')) {
                // Kiểm tra xem role này có permission với tên tương ứng không (trong collection)
                if ($role->permissions->contains('name', $permissionName)) {
                    return true;
                }
            } else {
                // Nếu chưa load, thì truy vấn trong DB
                if ($role->permissions()->where('name', $permissionName)->exists()) {
                    return true;
                }
            }
        }
        return false;
    }
}
