{!! csrf_field() !!}
<div id="messages"></div>
<div><h5><span style="color: red"> campos con (*) son obligatorios </span></h5></div>
<div class="form-group name">
    <label for="exampleInputEmail1">* Nombre:</label>
   {{ Form::text('name', old('name'), ['class' => 'form-control input-md', 'placeholder' => 'Nombre', 'title' => 'Nombre' ]) }}
</div>
<div class="form-group email">
    <label for="exampleInputPassword1">* Email:</label>
    {{ Form::email('email', old('email'), ['class' => 'form-control input-md', 'placeholder' => 'Email', 'title' => 'Email' ]) }}
</div>
<div class="form-gp  password">
    <label for="exampleInputPassword1">* Password:</label>
    {{ Form::password('password',null, [ 'id'=>'password','class' => 'form-control input-md', 'placeholder' => 'Password', 'title' => 'Password' ]) }}
</div>
<div class="form-group direccion">
    <label for="exampleInputPassword1">* Dirección:</label>
    {{ Form::text('direccion', old('direccion'), ['class' => 'form-control input-md', 'placeholder' => 'Dirección', 'title' => 'Dirección' ]) }}
</div>
<div class="form-group telefono">
    <label for="exampleInputPassword1">Teléfono:</label>
    {{ Form::text('telefono', old('telefono'), ['class' => 'form-control input-md', 'placeholder' => 'Teléfono', 'title' => 'Teléfono' ]) }}
</div>
<div class="form-group pais_id">
        <label for="exampleInputPassword1">* País:</label>
        {{ Form::select('pais_id', $pais->prepend('Seleccione el Pais',''), old('pais_id'), ['required' => 'required', 'class' => 'dinamico form-control input-md select2', 'id'=>'pais_id', 'title' => 'Pais', 'target' => 'departamento_id', 'url' =>route('users.departamentos')]) }}    
    
    </div>
    <div class="form-group departamento_id">
            <label for="exampleInputPassword1">* Departamento:</label>
            {{ Form::select('departamento_id', $departamento->prepend('Seleccione el departamento',''), old('departamento_id'), ['required' => 'required', 'class' => ' dinamico form-control input-md select2', 'id'=>'departamento_id', 'target' => 'municipio_id', 'url' =>route('users.municipios')]) }}    
        
        </div>
        <div class="form-group municipio_id">
                <label for="exampleInputPassword1">* Municipio:</label>
                {{ Form::select('municipio_id', $municipio->prepend('Seleccione el departamento',''), old('municipio_id'), ['required' => 'required', 'class' => 'form-control input-md select2', 'id'=>'municipio_id', 'title' => 'Pais', 'data-toggle'=> 'tooltip']) }}    
            
            </div>
    <div class="col-auto my-1">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

<script type="text/javascript">
        $(".dinamico").change(function(){
            var id=$(this).val();//id del valor a buscar
            var target=$(this).attr('target');//nombre del elemento a llenar
            var url = $(this).attr('url');//ruta donde se va a buscar la data
            
            var token = $(form).find('input[name="_token"]').val();
            console.log(target,id,url, token);
            $.ajax({
                data:  {
                    'id':id,'_token':token}, //datos que se envian a traves de ajax
                url:   url,
                type:  'post', //método de envio
                success:  function (data) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    $("#"+target).empty();
                    $("#"+target).append(data);
                    if(target=='departamento_id'){
                        $("#municipio_id").empty();
                        $("#municipio_id").append('<option>Seleccione una Opción</option>');
                    }
                }
            });
        });
        $(document).on('submit', ".form", function(e) 
            {
                // Stop form from submitting normally
                e.preventDefault();
                var token = $(form).find('input[name="_token"]').val();
                var form = '#' + $(this).attr('id');
              ///  var data = $(form).serialize();
                var route = $(this).attr('action');
                var form = $(this)[0];
                var data = new FormData(form);
                $.ajax({
                    url:route,
                    type:'post',
                    data: data,
                    enctype: 'multipart/form-data',
                    processData: false,  // Important!
                    contentType: false,
                    cache: false,
                    headers: {'X-CSRF-TOKEN': token},
                    success:function(data){
                        $('#messages').removeClass("alert alert-danger");
                        $('#messages').addClass("alert alert-success");
                        $('#messages').html(data.msj);
                        setTimeout(function() {
                           window.location.href = data.route; //se devuelde a la vista
                        }, 1000);
                      
                    },
                    error:function(data){
                        $('#messages').removeClass("alert alert-success");
                        $('#messages').addClass("alert alert-danger");
                        $('#messages').html("");
                        $(".has-error").removeClass("has-error");
                        $.each(data.responseJSON.errors, function(key, value){
                            jQuery('#messages').append('<p>' + value + '</p>');
                            $("." + key).addClass("has-error");
                        });
                    }
                    });
            });
</script>