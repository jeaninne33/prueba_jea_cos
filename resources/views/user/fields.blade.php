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
     
</script>