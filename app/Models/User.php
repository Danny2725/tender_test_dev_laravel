<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Thêm trường 'role' vào danh sách fillable
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
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the tenders created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenders(): HasMany
    {
        return $this->hasMany(Tender::class, 'creator_id');
    }

    /**
     * Get the invites for the user as a supplier.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invites(): HasMany
    {
        return $this->hasMany(Invite::class, 'supplier_id');
    }

    /**
     * Check if the user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
}