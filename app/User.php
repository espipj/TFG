<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

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

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_user','user_id','role_id');
    }

    public function ganaderia(){
        return $this->belongsTo(Ganaderia::class, 'ganaderia_id');
    }

    public function asociacion(){
        return $this->belongsTo(Asociacion::class, 'asociacion_id');
    }

    public function laboratorio(){
        return $this->belongsTo(Laboratorio::class, 'laboratorio_id');
    }

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

    private function hasRole($role)
    {
        if ($this->roles()->where('name',$role)->first()){
            return true;
        }else{
            return false;
        }
    }
}
