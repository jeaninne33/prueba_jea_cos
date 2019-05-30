@extends( 'home' )
@section('container')

<br>
<div class="col-lg-10 mt-9">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Listado de Emails</h4>
                <hr>
                <div id="messages"></div>
               <p> <a class="btn btn-primary pull-right" 
                href="{!! route('emails.create') !!}"><i class="fa fa-plus">Agregar Email</i></a>
                <p>
                <br>
                <hr>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center" id="lista_usuarios">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th scope="col">ID</th>
                                    <th scope="col">Destinatario</th>
                                    <th scope="col">Asunto</th>
                                    <th scope="col">Mensaje</th>
                                    <th scope="col">Usuario</th>
        
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
					"url":"<?= route('emails.datos') ?>",
					"dataType":"json",
					"type":"POST",
                    "data":function ( d ) {//se hace como una funcion para que tome el valor actualizado del filtro
                        d._token="<?= csrf_token() ?>";
                     }
                },
                "drawCallback":function(response){
                },
                "columns": [
                    { "data": "id" },
                    { "data": "destinatario" },
                    { "data": "asunto" },
                    { "data": "mensaje" },
                    { "data": "name" },
                    
                ]
            } );
        });
    
</script>
@endsection
