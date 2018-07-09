<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, CanResetPassword;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'address', 'phone', 'active', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission(Permission $permission) 
    {
        return !! optional(optional($this->role)->permissions)->contains($permission);
    }

    public function isAdmin()
    {
        return $this->hasPermission(Permission::find(1));
    }
    public function shifts()
    {
        return $this->belongsToMany(ClinicShift::class, 'shift_user', 'user_id', 'shift_id')->withPivot('confirmed')->withTimestamps();
    }
    public function confirmedShifts()
    {
        return $this->belongsToMany(ClinicShift::class, 'shift_user', 'user_id', 'shift_id')->wherePivot('confirmed', true)->withTimestamps();
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
