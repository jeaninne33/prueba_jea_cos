<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// SE instancian los modelos
use App\User;
use App\Pais;
use App\Departamento;
use App\Municipio;
use DB;
/**
 * 
 */
use  App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('user.index');
    }
    public function getData(Request $request)
    {
        //instancio las columnas de forma de array para la busqueda de la tabla 
        $columnas=array(
            0=>'id',
            1=>'name',
            2=>'email',
            3=>'direccion',
            4=>'telefono',
            5=>'municipio',
            6=>'id',
        );
        //datos que sirven para aplicar filtros de busqueda en la tablas 
        
        $limite=$request->input('length');
        $start = $request->input('start');
        $orden=$columnas[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        //trae todos los usuarios
        $users = User::with('Municipio');
      
        //se inicia el conteo de el total
        $totalFiltro = $users;
            //validacion para que no haga el recorridoen caso de llegar vacio el arreglo
        if(!empty($users)){
                //filtro para el buscador de la tabla
            if(!empty($request->input('search.value'))){
                $search = $request->input('search.value');
                $users=$users->where(function ($query) use ($search) {
                    $query->where('name','like',"%{$search}%")
                    ->orWhere('email','like',"%{$search}%")
                    ->orWhere('telefono','like',"%{$search}%")
                    ->orWhere('direccion','like',"%{$search}%")
                    ->orWhere('id','like',"%{$search}%");
                });
              
                $totalFiltro=$users;
            }
           
            /***
             * se filtra por los valores de la tabla
             */
            $users=$users->offset($start)->orderBy($orden,$dir)->limit($limite)->get();
            $totalFiltro=$totalFiltro->count();
            //recorrido de la tabla de actores
            foreach($users as $key=>$user){
              $acciones="<a href='".route( 'admin.common.periods.edit', [$user->id]) ."'  title=". __('messages.general.messages.buttons.edit'). " class='btn btn-default btn-xs'><i class='glyphicon glyphicon-edit'></i></a>
                    <form action='".route( 'admin.common.periods.destroy', [$user->id]) ."' method='post' class='deletes'>
                        <input name='_method' type='hidden' value='DELETE'>
                        <button type='button' value='' title=" . __('messages.general.messages.buttons.delete') . " class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></button>
                    </form>";
                //asignacion de botones de acciones 
                //asignaciones de las variables al arreglo de oportunidad
                $perido->action=$acciones;
            }//fin foreach oportunidades
          }else{
            $totalFiltro=0;
          }
          
         //  //creo  un json data para retornar a la tabla de inscripciones
         $json_data=array(
            "draw"=> intval($request->input('draw')),
            "recordsTotal"	=> intval($totalFiltro),
            "recordsFiltered" => intval($totalFiltro),
            "data"=> $users
         );
        
        return $json_data;

    }
    public function create()
    {
        return view('user.create');
    }
    // funcion que me permite listar paises
    public function listarPaises(){
        //me trae todos los paises
        return DB::table('paises')->get();
    }
    // funcion que me permite listar departamentos
    public function listarDepartamentos(Request $request){
        //si envio una peticion por vue en el multiselect me filtra por el pais que escogi
        if(isset($request->id)){
            return DB::table('departamentos')->where('pais_id',$request->id)->get();
            //si no me lista todos los departamentos
        }else{
            return DB::table('departamentos')->get();
        }
    }
    // funcion que me permite listar municipios
    public function listarMunicipios(Request $request){
        //si envio una peticion por vue en el multiselect me filtra por el departamento que escogi
        if(isset($request->id)){
            return DB::table('municipios')->where('departamento_id',$request->id)->get();
            //si no me lista todos los departamentos
        }else{
            return DB::table('municipios')->get();
        }
    }
    

    public function store(UserStoreRequest $request)
    {
        $user=New User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->municipio_id=$request->municipio_id;
        $user->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user=User::find($request->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->municipio_id=$request->municipio_id;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user=User::find($request->id);
        $user->delete();
    }
}
