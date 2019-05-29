<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'direccion', 'telefono','municipio_id'
    ]; 

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //se hace la relacion con la tabla municipio
    public function Municipio(){
        return $this->belongsTo('App\Municipio','municipio_id','id');
    }

     //se define la relacion, es decir usuario puede crear muchos emails
     public function Emails(){
        return $this->hasMany('App\Email','id','user_id');
    }
}
