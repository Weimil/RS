<?php

namespace App\Models;

use App\Traits\WeimilFriendable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, WeimilFriendable, TwoFactorAuthenticatable;

    // ════════════════════════════════════════

    const TABLE = 'users';

    const ID = 'id';

    const NAME = 'name';
    const ROLE = 'role';
    const SURNAME = 'surname';
    const USER_NAME = 'user_name';
    const EMAIL = 'email';
    const PASSWORD = 'password';

    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';

    // ════════════════════════════════════════

    protected $table = self::TABLE;

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $fillable = [
        self::NAME,
        self::SURNAME,
        self::USER_NAME,
        self::ROLE,
        self::EMAIL,
        self::PASSWORD
    ];

    protected $hidden = [
        self::PASSWORD,
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret'
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    // ════════════════════════════════════════
}
