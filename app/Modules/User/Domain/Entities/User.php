<?php

namespace App\Modules\User\Domain\Entities;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Modules\User\Domain\Database\Factories\UserFactory;

/**
 * @property int                 $id
 * @property string              $first_name
 * @property string              $last_name
 * @property string              $email
 * @property string|null         $password
 * @property \Carbon\Carbon|null $email_verified_at
 * @property \Carbon\Carbon      $created_at
 * @property \Carbon\Carbon      $updated_at
 *
 **** Dynamic Attributes****
 * @property string              $name
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => sprintf('%s %s', $attributes['first_name'], $attributes['last_name'])
        );
    }
}
