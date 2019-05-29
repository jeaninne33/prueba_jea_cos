<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public $table="emails"; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'destinatario','asunto','mensaje','user_id','enviado'
    ]; 
    //se define la relacion, es decir la relacion del email con el usuario que lo creo
    public function Usuario(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
