@extends( 'home' )
@section('container')
<br>
<hr>
<div class="row">
<div class="col-lg-8 col-ml-12">
    <div class="row">
        <!-- basic form start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Agregar Email</h4>
                   {!! Form::open(['route' => 'emails.store','id'=>'form',
                'class'=>"form",'enctype'=>"multipart/form-data", 'novalidate' => 'novalidate']) !!}
                     @include('email.fields')
                {!! Form::close() !!}
                        
                   
                </div>
            </div>
        </div>

</div>
</div>
</div>
@endsection