<?php

namespace App\ModelsExtended;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \App\Models\User implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    \Illuminate\Contracts\Auth\MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;

    const DEFAULT_ADMIN = 1;

    /**
     * @param string $email
     * @return Builder|Model|User
     */
    public static function getByEmail(string $email): Model|Builder|User
    {
        return self::query()->where( "email", $email )->firstOrFail();
    }

    /**
     * @param int $id
     * @return Builder|Model|User|null
     */
    public static function getById(int $id): Model|Builder|User|null
    {
        return self::query()->where( "id", $id )->first();
    }
}
