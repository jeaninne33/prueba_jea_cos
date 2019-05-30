<!doctype html>
<html class="no-js" lang="es">

<head>
@include('layouts.header')
</head>
<body>
    
   
    <div id="preloader">
            <div class="loader"></div>
        </div>
        <!-- preloader area end -->
        <!-- page container area start -->
        <div class="page-container">
            <!-- sidebar menu area start -->
            <div class="sidebar-menu">
                <div class="sidebar-header">
                    <div class="logo">
                        <a href="index.html"><img src="{{URL::asset('images/icon/chavo_icon.png')}}" alt="logo"></a>
                    </div>
                </div>
                <div class="main-menu">
                    <div class="menu-inner">
                        <nav>
                            <ul class="metismenu" id="menu">
                                <li class="active">
                                    <a href="javascript:void(0)" aria-expanded="true"><i
                                            class="ti-dashboard"></i><span>PRUEBA TÉCNICA</span></a>
                                    <ul class="collapse">
                                        <li class="active"><a href="{{url('/')}}">Inicio</a></li>
                                        <li ><a href="{{route('users.index')}}">Ver Listado de Usuarios</a></li>
                                        <li><a href="{{route('users.create')}}">Agregar Usuario</a></li>
                                        <li><a href="{{ route('login') }}">Iniciar Sesion</a></li>
                                    </ul>
                                </li>
        
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- sidebar menu area end -->
            <!-- main content area start -->
            <div class="main-content">
                <!-- header area start -->
                <div class="header-area">
                    <div class="row align-items-center">
                        <!-- nav and search button -->
                        <div class="col-md-6 col-sm-8 clearfix">
                            <div class="nav-btn pull-left">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="search-box pull-left">
                                <!-- <form action="#">
                                        <input type="text" name="search" placeholder="Search..." required>
                                        <i class="ti-search"></i>
                                    </form> -->
                            </div>
                        </div>
                        <!-- profile info & task notification -->
        
                    </div>
                </div>
                <!-- header area end -->
                <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">PRUEBA TÉCNICA</h4>
                                <ul class="breadcrumbs pull-left">
                                {{-- <li><a href="{{route('index')}}">Inicio</a></li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 clearfix">
                            <div class="user-profile pull-right">
                                <img class="avatar user-thumb" src="{{URL::asset('images/icon/chavo_icon.png')}}" alt="avatar">
                                @if (isset(Auth::user()->name))
                                   <h4 class="user-name " data-toggle="dropdown">
                                    {{ Auth::user()->name }}</h4>
                                      
                                       <i class="fa fa-angle-down"></i> <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                        Cerrar Sesion</a>
                                    </div>
                                @endif
                                {{-- --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- page title area end -->
                <div class="main-content-inner">
                    <div class="container">
                        @yield('container')
                    </div>
                  
                </div>
            </div>
            <!-- main content area end -->
            <!-- footer area start-->
            @include('layouts.footer')
            <!-- footer area end-->
        </div>
  
    <!-- jquery latest version -->
   
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> --}}
    <!-- bootstrap 4 js -->
    {{ Html::script('/js/popper.min.js') }}
    {{-- <script src="assets/js/popper.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    {{ Html::script('/js/owl.carousel.min.js') }}
    {{ Html::script('/js/metisMenu.min.js') }}
    {{ Html::script('/js/jquery.slimscroll.min.js') }}
    {{ Html::script('/js/jquery.slicknav.min.js') }}
    
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    {{ Html::script('/js/line-chart.js') }}
    {{ Html::script('/js/pie-chart.js') }}
    {{ Html::script('/js/plugins.js') }}
    {{ Html::script('/js/scripts.js') }}
    
   
    </body>
    
    </html>