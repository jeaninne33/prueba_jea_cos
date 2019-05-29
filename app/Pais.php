<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    public $table="paises"; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'nombre'
    ]; 
    //se define la relacion de uno a muchos, es decir un pais contiene muchos departamentos 
    public function Departamentos(){

        return $this->hasMany('App\Departamento','pais_id','id');
    }
}
