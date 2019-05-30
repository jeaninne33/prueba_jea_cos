@extends( 'layouts.layout' )
@section('container')

<br>
<div class="col-lg-10 mt-9">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Listado de Usuarios</h4>
                <hr>
               <p> <a class="btn btn-primary pull-right" 
                href="{!! route('users.create') !!}"><i class="fa fa-plus">Agregar Usuario</i></a>
                <p>
                <br>
                <hr>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center" id="lista_usuarios">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Direccion</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Municipio</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="row">
   
    </div>
    {{ Html::script('/js/datatables/jquery.dataTables.min.js') }} 
    {{ Html::script('/js/datatables/dataTables.bootstrap.min.js')     }}
<script type="text/javascript">
    $(document).ready(function(){
        var table = $('#lista_usuarios').DataTable( {
                "processing": true,
                "serverSide": true,   
                'order':[[0, 'desc']],
				"ajax": {
					"url":"<?= route('users.datos') ?>",
					"dataType":"json",
					"type":"POST",
                    "data":function ( d ) {//se hace como una funcion para que tome el valor actualizado del filtro
                        d._token="<?= csrf_token() ?>";
                     }
                },
                "drawCallback":function(response){
                    //se recorre la tabla para agregar bla clase task_pending
                    $('#lista_periodos .task_pending').each(function () {
                        $(this).parents('tr').addClass('task_pending');
                    });
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "direccion" },
                    { "data": "telefono" },
                    { "data": "nombre" },
                    { "data": "action" },
                    
                ]
            } );
        });
    
</script>
@endsection
