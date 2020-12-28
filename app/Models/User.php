<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $roles = ['admin', 'manager', 'customer'];

    /**
     * Returns  an array of valid roles that a user can have.
     *
     * @return array
     */

    public function assignRole(string $role) {

        if(!in_array($role, self::$roles)) {
            throw new \Exception("User role cannot be set to [$role].");
        }
        
        $this->role = $role;
        $this->save();
    }

    public function presentRole() {
        return ucfirst($this->role);
    }
}
