<?php

namespace App;

use App\Notifications\customerPasswordResetNotification;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as AuthCanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Customer extends Model implements AuthenticatableContract, AuthCanResetPassword
{
    use HasApiTokens;
    use Authenticatable;
    use CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'password_reset_token', 'password_reset_token_expire_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the customer info for customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customerInfo()
    {
        return $this->hasOne('App\CustomerInfo');
    }

    /**
     * Get the reviews that this customer has
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    /**
     * Get the orders that this customer has
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * Password Reset
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new customerPasswordResetNotification($token));
    }
}
