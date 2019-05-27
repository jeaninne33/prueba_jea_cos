@extends( 'layouts.layout' )
@section('container')
<link rel="stylesheet" href="{{URL::asset('css/my_style.css')}}">
<br>
    <div class="container">
        <h3>Galeria de la vecindad del Chavo</h3>
    <div class="col-md-8">
        <a class="btn btn-primary pull-right" 
        href="{!! route('image-gallery.create') !!}"><i class="fa fa-plus">Agregar Personaje</i></a>
    </div>
        <div class="row images">
           @include('vecindad_chavo.image')
        </div> <!-- row / end -->
    </div> <!-- container / end -->

<script type="text/javascript">
     $('body').on('click', '#nombre', function(e) {//para la busqueda con el boton de busqueda
            e.preventDefault();
            var texto=$('#texto_buscar').val();//variable que trae la buequeda
            var NomOrder='ASC';
            var ApoOrder='';
            var url='{{ route('image-gallery.index') }}';
            getImages(url, {data:texto,NomOrder:NomOrder,ApoOrder:ApoOrder});//se llama al metodo de traer la data de las ofertas via jax y se envia la url
    });
    $('body').on('click', '#apodo', function(e) {//para la busqueda con el boton de busqueda
            e.preventDefault();
            var texto=$('#texto_buscar').val();//variable que trae la buequeda
            var NomOrder='';
            var ApoOrder='ASC';
            var url='{{ route('image-gallery.index') }}';
            getImages(url, {data:texto,NomOrder:NomOrder,ApoOrder:ApoOrder})//se llama al metodo de traer la data de las ofertas via jax y se envia la url
    });
    $('body').on('click', '#search #nombre #apodo', function(e) {//para la busqueda con el boton de busqueda
            e.preventDefault();
            var texto=$('#texto_buscar').val();//variable que trae la buequeda
            var NomOrder='';
            var ApoOrder='';
            var url='{{ route('image-gallery.index') }}';
            getImages(url, {data:texto,NomOrder:NomOrder,ApoOrder:ApoOrder})//se llama al metodo de traer la data de las ofertas via jax y se envia la url
    });
    $('body').on('click', '.pagination a', function(e) {//cuando quiera cmabiar de pagina
            e.preventDefault();
            var texto=$('#texto_buscar').val();//variable que trae la buequeda
                var url = $(this).attr('href');  //se trae la url de la paginación
                getImages(url,{data:texto});//se llama al metodo de traer la data de las ofertas via ajax y se envia la url
            window.history.pushState("", "", url);
    });

    $('body').on('keypress','#texto_buscar',  function (e) {//para buscar cuando le de a la tecla enter
        if(e.which === 13){
            e.preventDefault();
            var texto=$('#texto_buscar').val();//variable que trae la buequeda
            var url='{{ route('image-gallery.index')}}';
            getImages(url, {data:texto});//se llama al metodo de traer la data de las ofertas via jax y se envia la url
        }
    });

    function getImages(url, data) {
        console.log(data);
        $.ajax({
            url : url,
            data: data,
        }).done(function (data) {
            $('.images').html(data);
        }).fail(function () {
            alert('images could not be loaded.');
        });
    }
    $(document).ready(function(){
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });
</script>
@endsection
