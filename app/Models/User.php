<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    const ROLE_ADMIN   = 'admin';
    const ROLE_PETUGAS = 'sarana';
    const ROLE_DIVISI  = 'divisi';

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    // Optional: accessor helpers
    public function isAdmin(): bool   { return $this->role === self::ROLE_ADMIN; }
    public function isPetugas(): bool { return $this->role === self::ROLE_SARANA; }
    public function isDivisi(): bool  { return $this->role === self::ROLE_DIVISI; }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
}
