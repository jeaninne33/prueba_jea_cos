<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// SE instancian los modelos
use App\User;
use App\Email;
use DB;
use  App\Http\Requests\EmailStoreRequest;

class EmailController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('email.index');
    }
    public function getData(Request $request)
    {
        //instancio las columnas de forma de array para la busqueda de la tabla 
        $columnas=array(
            0=>'emails.id',
            1=>'destinatario',
            2=>'asunto',
            3=>'mensaje',
            4=>'name',
            5=>'emails.id',
        );
        //datos que sirven para aplicar filtros de busqueda en la tablas 
        
        $limite=$request->input('length');
        $start = $request->input('start');
        $orden=$columnas[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        //trae todos los usuarios
        $emails = Email::join('users','users.id','user_id')->select('emails.*','users.name');
      
        //se inicia el conteo de el total
        $totalFiltro = $emails;
            //validacion para que no haga el recorridoen caso de llegar vacio el arreglo
        if(!empty($emails)){
                //filtro para el buscador de la tabla
            if(!empty($request->input('search.value'))){
                $search = $request->input('search.value');
                $emails=$emails->where(function ($query) use ($search) {
                    $query->where('name','like',"%{$search}%")
                    ->orWhere('destinatario','like',"%{$search}%")
                    ->orWhere('asunto','like',"%{$search}%")
                    ->orWhere('mensaje','like',"%{$search}%")
                    ->orWhere('emails.id','like',"%{$search}%");
                });
              
                $totalFiltro=$emails;
            }
           
            /***
             * se filtra por los valores de la tabla
             */
            $emails=$emails->offset($start)->orderBy($orden,$dir)->limit($limite)->get();
            $totalFiltro=$totalFiltro->count();
          }else{
            $totalFiltro=0;
          }
          
         //  //creo  un json data para retornar a la tabla de inscripciones
         $json_data=array(
            "draw"=> intval($request->input('draw')),
            "recordsTotal"	=> intval($totalFiltro),
            "recordsFiltered" => intval($totalFiltro),
            "data"=> $emails
         );
        
        return $json_data;

    }
    public function create()
    {
        return view('email.create');
    }

   
    public function store(EmailStoreRequest $request)
    {
        $email=New Email();
        $email->fill($request->all());
        $email->save();

        $result=[ 'msj'=>'El email se ha creado Correctamente','route'=>route('emails.index')];
        return response()->json($result,200);

    }

}
