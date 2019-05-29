@extends( 'layouts.layout' )
@section('container')

<br>
<div class="row">
    <div class="col-lg-10 col-ml-12">
        <div class="row">
            <!-- basic form start -->
            <div class="col-10 mt-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Listado de Usuarios</h4>
                            <br>
                        <div class="">
                            <a class="btn btn-primary pull-right" 
                            href="{!! route('users.create') !!}"><i class="fa fa-plus">Agregar Usuario</i></a>
                        </div>
                        <br> <br>
                            <div class="c">
                                <div class="table-responsive">
                                    <table id="lista_usuarios" class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Email</th>
                                                <th>Direccion</th>
                                                <th>Telefono</th>
                                                <th>Municipio</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div> <!-- row / end -->
                    </div>
                </div>
            </div>
    
    </div>
    </div>
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
                    { "data": "nombre" },
                    { "data": "fechaDesde" },
                    { "data": "fechaHasta" },
                    { "data": "action" },
                    
                ]
            } );
        });
    
</script>
@endsection
