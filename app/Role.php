<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * Simple class to define roles, it has not fillable as is not even needed.
 * @see User
 * @package App
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class Role extends Model
{

    /**
     * Definition of the relationship BelongsTo User.
     *
     * We need to define Eloquent our relationships in order to work with it.
     * A Role, BelongsTo User.
     * We define as well how it's going to be saved at our migration the foreign keys of role_user (pivot table), role_id and user_id.
     * @see User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relationship BelongsTo
     */
    public function users(){
        return $this->belongsToMany(User::class, 'role_user','role_id','user_id');
    }
}
