{!! csrf_field() !!}
<div id="messages"></div>
<div class="form-group titulo">
    <label for="exampleInputEmail1">Titulo:</label>
   {{ Form::text('titulo', old('titulo'), ['class' => 'form-control input-md', 'placeholder' => 'Titulo', 'title' => 'Titulo' ]) }}
</div>
<div class="form-group nombre">
    <label for="exampleInputPassword1">Nombre:</label>
    {{ Form::text('nombre', old('nombre'), ['class' => 'form-control input-md', 'placeholder' => 'Nombre', 'title' => 'Nombre' ]) }}
</div>
<div class="form-group apodo">
    <label for="exampleInputPassword1">Apodos:</label>
    {{ Form::text('apodo', old('apodo'), ['class' => 'form-control input-md', 'placeholder' => 'Apodo', 'title' => 'Apodo' ]) }}
</div>
<div class="form-group apartamento">
    <label for="exampleInputPassword1">Apartamento:</label>
    {{ Form::text('apartamento', old('apartamento'), ['class' => 'form-control input-md', 'placeholder' => 'Apartamento', 'title' => 'Apartamento' ]) }}
</div>
<div class="form-group descripcion">
    <label for="exampleInputPassword1">Descripción:</label>
    {{ Form::text('descripcion', old('descripcion'), ['class' => 'form-control input-md', 'placeholder' => 'Descripcion', 'title' => 'Descripcion' ]) }}
</div>
<div class="form-group image">
    <label for="exampleInputPassword1">Imagen:</label>
    @if(isset($image))
        <img class="img-responsive" alt="" src="/images/{{ $image->image }}" />
        <br>
        <label for="exampleInputPassword1">Si desea cambiar la imagen seleccione un archivo:</label>
    @endif
    <input type="file" name="image" id="image" class="form-control">
</div>
    <div class="col-auto my-1">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

<script type="text/javascript">
        $(document).on('submit', ".form-image-upload", function(e) 
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
                           window.location.href = "{{route('image-gallery.index')}}"; //se devuelde a la vista
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