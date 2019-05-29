<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    public $table="departamentos"; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'nombre','pais_id'
    ]; 
    //se define la relacion, es decir un departamento contiene muchos municipios 
    public function Municipios(){
        return $this->hasMany('App\Municipio','departamento_id', 'id');
    }
    //se define la relacion, es decir un departamento pertenece a un pais
    public function Pais(){
        return $this->belongsTo('App\Pais','pais_id','id');
    }
}
