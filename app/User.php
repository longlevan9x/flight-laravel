<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property mixed username
 * @property mixed password
 * @property mixed role
 * @property mixed email
 * @property mixed|string api_token
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'role', 'password', 'api_token'
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
     * @param bool $save
     * @return mixed|string
     */
    public function generateToken($save = true)
    {
        $this->api_token = str_random(60);
        if ($save) {
            $this->save();
        }
        return $this->api_token;
    }
}
