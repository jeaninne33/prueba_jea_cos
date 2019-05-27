
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
            <h4 class="header-title">Editar Personaje</h4>
              {!! Form::model($image, ['route' => ['image-gallery.update', $image->id],
                'method' => 'put', 'id'=>'chavo','class'=>"form-image-upload",'enctype'=>"multipart/form-data"])
                  !!}
                  @include('vecindad_chavo.fields')
              {!! Form::close() !!}
      </div>
      </div>
      </div>

      </div>
      </div>
      </div>
      @endsection