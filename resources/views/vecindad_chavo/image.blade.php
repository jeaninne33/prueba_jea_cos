<div class="row" id="load_image">
        <br>
        <hr>
    <div class="container">
            <div class="row">
                    <div class="col-lg-8 col-ml-12">
                        <div class="row">
                            <!-- basic form start -->
                            <div class="col-12 mt-5">
                            <div class="input-group ">
                                <input type="text" class="form-control" title="Buscar"
                                    placeholder="Busqueda por Titulo, Nombre, Apodo" id="texto_buscar"  value="{{$search}}">
                                <span class="input-group-btn">
                                    <button class="btn btn-search" id="search" type="button"><i class="fa fa-search fa-fw"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                      </div>
                    </div>
                   
                    <div class="col-lg-12 col-ml-12">
                        <br>
                            <div class="row">
                                <!-- basic form start -->
                                <div class="col-3">
                                <div class="input-group "> 
                                       <span class="input-group-btn">
                                        <button class="btn btn-default" id="nombre" type="button" title="Ordenar por Nombre"><i class="fas fa-sort-alpha-down"></i>
                                        Nombre</button>
                                        <button class="btn btn-default" id="apodo" type="button" title="Ordenar por Apodo"><i class="fas fa-sort-alpha-down"></i>
                                            Apodo</button>
                                    </span>
                                </div>
                                <div class="input-group ">
                                       
                                    </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    <br>
     <div class='list-group gallery'>
                @if($images->count())
                @foreach($images as $image)
                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                    <a class="thumbnail fancybox" rel="ligthbox" href="/images/{{ $image->image }}">
                        
                        <img class="img-responsive" alt="" src="/images/{{ $image->image }}" />
                        <div class='text-center'>
                            <span class='text-muted'>{{ $image->nombre }}</span><br/>
                            <small class='text-muted'>{{ $image->apodo }}</small>
                        </div> <!-- text-center / end -->
                    </a>
                    <a href="{{ route('image-gallery.edit',$image->id) }}" class="edit-icon btn btn-primary glyphicon glyphicon-pencil" title="Editar"> </a>
                    <br/>
                    <form action="{{ url('image-gallery',$image->id) }}" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        {!! csrf_field() !!}
                        <button type="submit" class="close-icon btn btn-danger" title="Eliminar"><i
                                class="glyphicon glyphicon-remove"> </i></button>
                    </form>
                </div> <!-- col-6 / end -->
                @endforeach
                @else
                        <h3>No se encontraron personajes</h3>
                @endif
            </div> <!-- list-group / end -->
    <div class="col-sm-12 text-center">
        {{ $images->links() }}
    </div>
</div>