{!! csrf_field() !!}
<div id="messages"></div>
<div><h5><span style="color: red"> Todos los campos son obligatorios </span></h5></div>
<div class="form-group destinatario">
    <label for="exampleInputPassword1"> Destinatario:</label>
    {{ Form::email('destinatario', old('destinatario'), ['class' => 'form-control input-md', 'placeholder' => 'Destinatario' ]) }}
</div>
<div class="form-group asunto">
    <label for="exampleInputPassword1">Asunto:</label>
    {{ Form::text('asunto', old('asunto'), ['class' => 'form-control input-md', 'placeholder' => 'Asunto' ]) }}
</div>
<div class="form-group mensaje">
    <label for="exampleInputPassword1">Mensaje:</label>
    {{ Form::text('mensaje', old('mensaje'), ['class' => 'form-control input-md', 'placeholder' => 'Mensaje' ]) }}
</div>
<div class="form-group">
        {{ Form::hidden('user_id',Auth::user()->id, ['id'=>'user_id']) }}    
    
    </div>
    <div class="col-auto my-1">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

<script type="text/javascript">
     
</script>