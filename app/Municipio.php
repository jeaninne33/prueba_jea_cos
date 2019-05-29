<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    public $table="municipios"; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'nombre', 'departamento_id'
    ]; 
    //se define la relacion, es decir un municipio pertenece a un departamento 
    public function Departamento(){
        return $this->belongsTo('App\Departamento','departamento_id','id');
    }
}
