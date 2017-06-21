<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Class User.
 *
 * An edit by me of the default Laravel User class.
 * @package App
 * @author Laravel
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Definition of the relationship BelongsTo Role.
     *
     * We need to define Eloquent our relationships in order to work with it.
     * A User, BelongsToMany Role.
     * We define as well how it's going to be saved at our migration the foreign keys of role_user (pivot table), role_id and user_id.
     * @see Role
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relationship BelongsToMany
     */
    public function roles(){
        return $this->belongsToMany(Role::class, 'role_user','user_id','role_id');
    }

    /**
     * Definition of the relationship BelongsTo Ganaderia.
     *
     * We need to define Eloquent our relationships in order to work with it.
     * A User, BelongsTo Ganaderia.
     * We define as well how it's going to be saved at our migration the foreign key of Ganaderia.
     * @see Ganaderia
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relationship BelongsToMany
     */
    public function ganaderia(){
        return $this->belongsTo(Ganaderia::class, 'ganaderia_id');
    }

    /**
     * Definition of the relationship BelongsTo Asociacion.
     *
     * We need to define Eloquent our relationships in order to work with it.
     * A User, BelongsTo Asociacion.
     * We define as well how it's going to be saved at our migration the foreign key of Asociacion.
     * @see Asociacion
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relationship BelongsToMany
     */
    public function asociacion(){
        return $this->belongsTo(Asociacion::class, 'asociacion_id');
    }

    /**
     * Definition of the relationship BelongsTo Laboratorio.
     *
     * We need to define Eloquent our relationships in order to work with it.
     * A User, BelongsTo Laboratorio.
     * We define as well how it's going to be saved at our migration the foreign key of Laboratorio.
     * @see Laboratorio
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relationship BelongsToMany
     */
    public function laboratorio(){
        return $this->belongsTo(Laboratorio::class, 'laboratorio_id');
    }

    /**
     * Helper function to check if a User has a Roles or multiple Roles
     * @param array|Role $roles An array of Roles to check or just a Role
     * @return bool The result of checking if a User has a Role or any Role of the list
     * @uses User::hasRole()
     * @see User::hasRole()
     */
    public function hasAnyRole($roles){
        if(is_array($roles)){
            foreach ($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }
        }else{
            if($this->hasRole($roles)){
                return true;
            }
        }

        return false;

    }

    /**
     * Given a Role it determines if the User haves it or not
     * @param Role $role the Role to check.
     * @return bool The result of checking if a User has a Role
     */
    private function hasRole($role)
    {
        if ($this->roles()->where('name',$role)->first()){
            return true;
        }else{
            return false;
        }
    }
}
