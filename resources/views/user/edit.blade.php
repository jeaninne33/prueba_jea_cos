
 @extends( 'layouts.layout' )
@section('container')
<br>
<hr>
<div class="row">
  <div class="col-lg-6 col-ml-12">
    <div class="row">
      <!-- basic form start -->
      <div class="col-12 mt-5">
        <div class="card">
          <div class="card-body">
            <h4 class="header-title">Editar Usuario</h4>
              {!! Form::model($user, ['route' => ['users.update', $user->id],
                'method' => 'put', 'id'=>'form','class'=>"form",'enctype'=>"multipart/form-data"])
                  !!}
                  @include('user.fields')
              {!! Form::close() !!}
      </div>
      </div>
      </div>

      </div>
      </div>
      </div>
      @endsection