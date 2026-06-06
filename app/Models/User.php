<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'role',
        'password',
        'google_id',
        'avatar',
        'email_verified_at',
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

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'favorites')->withTimestamps();
    }

    public function otps()
    {
        return $this->hasMany(UserOtp::class);
    }

    public function hasSocialAccount(string $provider): bool
    {
        $field = $provider . '_id';
        return !is_null($this->$field);
    }

    public function markEmailAsVerified(): void
    {
        if (is_null($this->email_verified_at)) {
            $this->forceFill(['email_verified_at' => now()])->save();
        }
    }

    public function generateAvatarUrl(): string
    {
        if ($this->avatar) {
            if (str_starts_with($this->avatar, 'http')) {
                return $this->avatar;
            }

            return asset('storage/' . $this->avatar);
        }

        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email ?? 'guest@homeliving.com'))) . '?d=identicon&s=300';
    }
}
