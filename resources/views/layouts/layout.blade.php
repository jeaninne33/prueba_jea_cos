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
                                            class="ti-dashboard"></i><span>Vecindad del Chavo</span></a>
                                    <ul class="collapse">
                                        <li class="active"><a href="{{route('image-gallery.index')}}">Ver Galeria</a></li>
                                        <li><a href="{{route('image-gallery.create')}}">Agregar Personaje</a></li>
                                        <li><a href="{{url('/')}}">Inicio</a></li>
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
                                <h4 class="page-title pull-left">BIENVENIDO A LA APLICACIÓN WEB LA VECINDAD DEL CHAVO</h4>
                                <ul class="breadcrumbs pull-left">
                                {{-- <li><a href="{{route('index')}}">Inicio</a></li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 clearfix">
                            <div class="user-profile pull-right">
                                <img class="avatar user-thumb" src="{{URL::asset('images/icon/chavo_icon.png')}}" alt="avatar">
                                <h4 class="user-name " data-toggle="dropdown">Vecindad 
                                       </h4>
                                {{--<i class="fa fa-angle-down"></i> <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Message</a>
                                    <a class="dropdown-item" href="#">Settings</a>
                                    <a class="dropdown-item" href="#">Log Out</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- page title area end -->
                <div class="main-content-inner">
                    <div class="container">
                        @yield('container')
                    </div>
                    <!-- sales report area start -->
        
                    <!-- overview area end -->
                    <!-- market value area start -->
                    <!-- <div class="row mt-5 mb-5">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex justify-content-between align-items-center">
                                            <h4 class="header-title mb-0">Market Value And Trends</h4>
                                            <select class="custome-select border-0 pr-3">
                                                <option selected>Last 24 Hours</option>
                                                <option value="0">01 July 2018</option>
                                            </select>
                                        </div>
                                        <div class="market-status-table mt-4">
                                            <div class="table-responsive">
                                                <table class="dbkit-table">
                                                    <tr class="heading-td">
                                                        <td class="mv-icon">Logo</td>
                                                        <td class="coin-name">Coin Name</td>
                                                        <td class="buy">Buy</td>
                                                        <td class="sell">Sells</td>
                                                        <td class="trends">Trends</td>
                                                        <td class="attachments">Attachments</td>
                                                        <td class="stats-chart">Stats</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="mv-icon"><img src="assets/images/icon/market-value/icon1.png" alt="icon">
                                                        </td>
                                                        <td class="coin-name">Dashcoin</td>
                                                        <td class="buy">30% <img src="assets/images/icon/market-value/triangle-down.png" alt="icon"></td>
                                                        <td class="sell">20% <img src="assets/images/icon/market-value/triangle-up.png" alt="icon"></td>
                                                        <td class="trends"><img src="assets/images/icon/market-value/trends-up-icon.png" alt="icon"></td>
                                                        <td class="attachments">$ 56746,857</td>
                                                        <td class="stats-chart">
                                                            <canvas id="mvaluechart"></canvas>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="mv-icon">
                                                            <div class="mv-icon"><img src="assets/images/icon/market-value/icon2.png" alt="icon"></div>
                                                        </td>
                                                        <td class="coin-name">LiteCoin</td>
                                                        <td class="buy">30% <img src="assets/images/icon/market-value/triangle-down.png" alt="icon"></td>
                                                        <td class="sell">20% <img src="assets/images/icon/market-value/triangle-up.png" alt="icon"></td>
                                                        <td class="trends"><img src="assets/images/icon/market-value/trends-down-icon.png" alt="icon"></td>
                                                        <td class="attachments">$ 56746,857</td>
                                                        <td class="stats-chart">
                                                            <canvas id="mvaluechart2"></canvas>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="mv-icon">
                                                            <div class="mv-icon"><img src="assets/images/icon/market-value/icon3.png" alt="icon"></div>
                                                        </td>
                                                        <td class="coin-name">Euthorium</td>
                                                        <td class="buy">30% <img src="assets/images/icon/market-value/triangle-down.png" alt="icon"></td>
                                                        <td class="sell">20% <img src="assets/images/icon/market-value/triangle-up.png" alt="icon"></td>
                                                        <td class="trends"><img src="assets/images/icon/market-value/trends-up-icon.png" alt="icon"></td>
                                                        <td class="attachments">$ 56746,857</td>
                                                        <td class="stats-chart">
                                                            <canvas id="mvaluechart3"></canvas>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="mv-icon">
                                                            <div class="mv-icon"><img src="assets/images/icon/market-value/icon4.png" alt="icon"></div>
                                                        </td>
                                                        <td class="coin-name">Bitcoindash</td>
                                                        <td class="buy">30% <img src="assets/images/icon/market-value/triangle-down.png" alt="icon"></td>
                                                        <td class="sell">20% <img src="assets/images/icon/market-value/triangle-up.png" alt="icon"></td>
                                                        <td class="trends"><img src="assets/images/icon/market-value/trends-up-icon.png" alt="icon"></td>
                                                        <td class="attachments">$ 56746,857</td>
                                                        <td class="stats-chart">
                                                            <canvas id="mvaluechart4"></canvas>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <!-- market value area end -->
                    <!-- row area start -->
        
                    <!-- row area end -->
        
                    <!-- row area start-->
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