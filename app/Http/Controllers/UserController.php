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
            0=>'users.id',
            1=>'name',
            2=>'email',
            3=>'direccion',
            4=>'telefono',
            5=>'municipios.nombre',
            6=>'users.id',
        );
        //datos que sirven para aplicar filtros de busqueda en la tablas 
        
        $limite=$request->input('length');
        $start = $request->input('start');
        $orden=$columnas[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        //trae todos los usuarios
        $users = User::join('municipios','municipios.id','municipio_id')->select('users.*','municipios.nombre');
      
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
                    ->orWhere('nombre','like',"%{$search}%")
                    ->orWhere('users.id','like',"%{$search}%");
                });
                $totalFiltro=$users;
            }
            /***
             * se filtra por los valores de la tabla
             */
            $users=$users->offset($start)->orderBy($orden,$dir)->limit($limite)->get();
            $totalFiltro=$totalFiltro->count();
            //recorrido de usuarios para agregar los bootones
            foreach($users as $key=>$user){
              $acciones="<a href='".route( 'users.edit', [$user->id]) ."'  title='Editar' class='btn btn-default btn-xs'><i class='glyphicon glyphicon-edit'></i></a>
                    <form action='".route( 'users.destroy', [$user->id]) ."' method='post' class='deletes'>
                        <input name='_method' type='hidden' value='DELETE'>
                        ". csrf_field()."
                        <button type='button' value='' title='Eliminar' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></button>
                    </form>";
                //asignacion de botones de acciones 
                $user->action=$acciones;
            }//fin foreach 
          }else{
            $totalFiltro=0;
          }
         //  //creo  un json data para retornar a la tabla
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
        $datos['pais']=Pais::pluck('nombre','id');
        $datos['departamento']=collect([]);
        $datos['municipio']=collect([]);
        return view('user.create')->with($datos);
    }
    public function edit($id)
    {
        $user=User::find($id);//buscamos el usuario
        $datos['pais']=Pais::pluck('nombre','id');//se añade la variable al array a enviar a la vista
        //buscamos el pais_id y departamento_id para cargar todas las opciones
        $municipio=Municipio::join('departamentos','departamentos.id','departamento_id')
                ->where('municipios.id',$user->municipio_id)
                ->select('municipios.*','departamentos.pais_id')->first();
        $user->departamento_id=$municipio->departamento_id;
        $user->pais_id=$municipio->pais_id;
        $datos['municipio']=Municipio::where('departamento_id',$municipio->departamento_id)->pluck('nombre','id');
        $datos['departamento']=Departamento::where('pais_id',$municipio->pais_id)->pluck('nombre','id');
        $datos['user']= $user;
        return view('user.edit')->with($datos);
    }
   /**
    * funcion para listar departamentos
    *  */
    public function Departamentos(Request $request){
        $departamentos=Departamento::where('pais_id',$request->id)->get();//buscamos el listado  de departamentos perteneciente al pais
        $select='<option value="" selected>Selecciona una opción</option>';//se crea las primera opcion del select
        foreach($departamentos as $depar){
            $select.='<option value="'.$depar->id.'">'.$depar->nombre.'</option>';//se completa las opciones del select
        }
       return $select;
    }
    /***
     * funcion que listar municipios
     * 
     */
    // 
    public function Municipios(Request $request){
        $municipios=Municipio::where('departamento_id',$request->id)->get();//buscamos el listado  de municipios perteneciente al departamento
        $select='<option value="" selected>Selecciona una opción</option>';//se crea las primera opcion del select
        foreach($municipios as $muni){
            $select.='<option value="'.$muni->id.'">'.$muni->nombre.'</option>';//se completa las opciones del select
        }
       return $select;
    }
    

    public function store(UserStoreRequest $request)
    {
        $user=New User();//se instancia el objeto
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->direccion=$request->direccion;
        $user->telefono=$request->telefono;
        $user->municipio_id=$request->municipio_id;
        $user->save();//se guardan los cambios
        //retornamos un array con el msj y la ruta ne caso de requerir un redirec
        $result=[ 'msj'=>'El usuario se ha creado Correctamente','route'=>route('users.index')];
        return response()->json($result,200);

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
        $user=User::find($id);//se busca el registro a actualizar
        $user->name=$request->name;
        $user->email=$request->email;
        $user->direccion=$request->direccion;
        $user->telefono=$request->telefono;
        //solo actualizamos la contraseña si ingresa una nueva
        if(isset($request->password) && !empty($request->password)){
            $user->password=bcrypt($request->password);
        }
        $user->municipio_id=$request->municipio_id;
        $user->save();//alamacenamos los cambios
        //retornamos un array con el msj y la ruta ne caso de requerir un redirec
        $result=[ 'msj'=>'El usuario se ha editado Correctamente','route'=>route('users.index')];
        return response()->json($result,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);//buscamos el registro a eliminar
        if(isset($user)){//en caso satisfactorio de encontralo
            $tiene_email=Email::where('user_id', $id)->get();//se busca si tiene algun email relacionado
            if( count($tiene_email)>0){//si existen emails no se permite eliminar el registro
                $result = ['msj' => 'No se puede eliminar el usuario debido a que posee emails relacionados', 'route' => route('users.index')];
                return response()->json($result, 422);
            }
            $user->delete();//se elimina
            //retornamos un array con el msj y la ruta ne caso de requerir un redirec
            $result=['msj' => 'El usuario se ha eliminado correctamente','route'=>route('users.index')];
            return response()->json($result,200);
        }
        //retornamos un array con el msj y la ruta ne caso de requerir un redirec
        //en caso de llegar aca es debido  a un error, por ende se enviar 422 la respuesta
        $result=['msj' => 'Error no se encontro el usuario','route'=>route('users.index')];
        return response()->json($result,422);
    }
}
