<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MEHROMAH</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <!-- Pignose Calender -->
    <link href="{{asset('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{asset('assets/plugins/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css')}}">
    <link href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="{{asset('assets/plugins/clockpicker/dist/jquery-clockpicker.min.css')}}" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="{{asset('assets/plugins/jquery-asColorPicker-master/css/asColorPicker.css')}}" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="{{asset('assets/plugins/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/jquery-steps/css/jquery.steps.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/summernote/dist/summernote.css')}}" rel="stylesheet">
    
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header" style="position: fixed;">
            <div class="brand-logo">
                <a href="{{route('admin_dashboard')}}">
                    <b class="logo-abbr"><img src="{{asset('assets/images/logo.png')}}" alt=""> </b>
                    <span class="logo-compact"><img src="{{asset('assets/images/logo-compact.png')}}" alt=""></span>
                    <span class="brand-title" style="color:#fff">
                    MEHROMAH
                        <!-- <img src="{{asset('assets/images/logo-text.png')}}" alt=""> -->
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
               
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{asset('assets/images/user/1.png')}}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <hr class="my-2">
                                        <li>
                                            <a href="{{route('admin_lock_screen')}}"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                                        </li>
                                        <li><a href="{{route('admin_logout')}}"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar" style="position: fixed;">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="{{route('admin_dashboard')}}" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-shopping-cart"></i><span class="nav-text">Products</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('admin_product_brand')}}" aria-expanded="false">Brand</a></li>
                            <li><a href="{{route('admin_product_category')}}" aria-expanded="false">Category</a></li>
                            <li><a href="{{route('admin_product')}}" aria-expanded="false">Our Products</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('customers_list')}}" aria-expanded="false">
                            <i class="fa fa-user-plus"></i><span class="nav-text">Customers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('flash_show')}}" aria-expanded="false">
                            <i class="fa fa-bolt"></i><span class="nav-text">Flash Deal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('all_order')}}" aria-expanded="false">
                            <i class="fa fa-shopping-basket"></i><span class="nav-text">Order</span>
                            @php
                                $order_notifys=App\Models\Checkout::where('notify',0)->get();
                                $order_notify=count($order_notifys)
                            @endphp
                            @if (!empty($order_notify))
                                <span class="badge gradient-1 badge-pill badge-primary">{{$order_notify}}</span>
                            @endif
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{route('pick_up_order')}}" aria-expanded="false">
                            <i class="fa fa-credit-card"></i><span class="nav-text">Pick-up point order </span>
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{route('totalsales_history')}}" aria-expanded="false">
                            <i class="fa fa-handshake-o"></i><span class="nav-text">Total sales</span>
                        </a>
                    </li>
                     <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-bar-chart"></i><span class="nav-text">Report</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('stock_report')}}" aria-expanded="false">Stock Report</a></li>
                            <li><a href="{{route('sale_report')}}" aria-expanded="false">Sales Report</a></li>
                            <li><a href="{{route('wish_report')}}" aria-expanded="false">Product Wish Report</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-desktop"></i><span class="nav-text">Frontend Settings</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('frontend_home')}}" aria-expanded="false">Home</a></li>
                            <li><a href="{{route('about_us')}}" aria-expanded="false">About Us</a></li>
                            <li><a href="{{route('size_guide')}}" aria-expanded="false">Size Guide</a></li>
                            <li><a href="{{route('return_policy')}}" aria-expanded="false">Return Policy</a></li>
                            <li><a href="{{route('faq')}}" aria-expanded="false">Faq</a></li>
                            <li><a href="{{route('contact')}}" aria-expanded="false">Support Policy</a></li>
                            <li><a href="{{route('terms_condition')}}" aria-expanded="false">Terms & Conditions</a></li>
                            <li><a href="{{route('usefullinks')}}" aria-expanded="false">Useful Links</a></li>
                            <li><a href="{{route('general_setting')}}" aria-expanded="false">General Settings</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('admin_support_ticket')}}" aria-expanded="false">
                            <i class="fa fa-support"></i><span class="nav-text">Support Ticket</span>
                            @php
                                $order_notifys=App\Models\Supportticket::where('viewed',0)->get();
                                $order_notify=count($order_notifys)
                            @endphp
                            @if (!empty($order_notify))
                                <span class="badge gradient-1 badge-pill badge-primary">{{$order_notify}}</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-envelope"></i><span class="nav-text">Messaging</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('newslater')}}" aria-expanded="false">Email Notification</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('home_seo')}}" aria-expanded="false">
                            <i class="fa fa-search"></i><span class="nav-text">SEO Settings</span>
                        </a>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-user"></i><span class="nav-text">Staffs</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('allstaffs')}}" aria-expanded="false">All staffs</a></li>
                            <li><a href="{{route('allstaffs_role')}}" aria-expanded="false">Staff permissions</a></li>
                        </ul>
                    </li>
                    {{-- <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-gear"></i><span class="nav-text">System Setting</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('header_setting')}}" aria-expanded="false">Header</a></li>
                            <li><a href="{{route('sidebar_setting')}}" aria-expanded="false">Sidebar</a></li>
                            <li><a href="{{route('body_setting')}}" aria-expanded="false">Body</a></li>
                            <li><a href="{{route('footer_setting')}}" aria-expanded="false">Footer</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li>
                        <a href="{{route('admin_blog')}}" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Blog</span>
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{route('payment_i')}}" aria-expanded="false">
                            <i class="fa fa-exclamation-triangle"></i><span class="nav-text">Payment Method Info</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('who')}}" aria-expanded="false">
                            <i class="fa fa-exclamation-triangle"></i><span class="nav-text">Who ?</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
        @yield('content')
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy;Developed by <a href="">Dewan ICT Institue</a> <script>document.write(new Date().getFullYear());</script></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{asset('assets/plugins/common/common.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/gleek.js')}}"></script>
    <script src="{{asset('assets/js/styleSwitcher.js')}}"></script>

    <!-- Chartjs -->
    <script src="{{asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <!-- Circle progress -->
    <script src="{{asset('assets/plugins/circle-progress/circle-progress.min.js')}}"></script>
    <!-- Datamap -->
    <script src="{{asset('assets/plugins/d3v3/index.js')}}"></script>
    <script src="{{asset('assets/plugins/topojson/topojson.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datamaps/datamaps.world.min.js')}}"></script>
    <!-- Morrisjs -->
    <script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
    <!-- Pignose Calender -->
    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pg-calendar/js/pignose.calendar.min.js')}}"></script>
    <!-- ChartistJS -->
    <script src="{{asset('assets/plugins/chartist/js/chartist.min.js')}}"></script>
    <script src="{{asset('assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{asset('assets/js/dashboard/dashboard-1.js')}}"></script>
    <script src="{{asset('assets/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/tables/js/datatable-init/datatable-basic.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="{{asset('assets/plugins/clockpicker/dist/jquery-clockpicker.min.js')}}"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{asset('assets/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')}}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="{{asset('assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <script src="{{asset('assets/js/plugins-init/form-pickers-init.js')}}"></script>
    <script src="{{asset('assets/plugins/validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/plugins/validation/jquery.validate-init.js')}}"></script>
    <script src="{{asset('assets/plugins/toastr/js/toastr.min.js')}}"></script>
    <script src="{{asset('assets/plugins/toastr/js/toastr.init.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins-init/jquery-steps-init.js')}}"></script>
    <script src="{{asset('assets/js/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('assets/js/jquery.fileupload.js')}}"></script>
    <script src="{{asset('assets/plugins/summernote/dist/summernote.min.js')}}"></script>
    <script src="{{asset('assets/plugins/summernote/dist/summernote-init.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins-init/select2-init.js')}}"></script>
    <script src="{{asset('assets/js/myjs.js')}}"></script>
    @include('message')
</body>

</html>