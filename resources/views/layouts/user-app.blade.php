<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.min.css" integrity="sha512-Xxs33QtURTKyRJi+DQ7EKwWzxpDlLSqjC7VYwbdWW9zdhrewgsHoim8DclqjqMlsMeiqgAi51+zuamxdEP2v1Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skin_color.css') }}">
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
</head>
<body class="hold-transition light-skin sidebar-mini theme-danger fixed">
    <div class="wrapper">
        <div id="loader"></div>
        <header class="main-header">
            <div class="d-flex align-items-center logo-box justify-content-start">
                <a href="#" class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent hover-primary" data-toggle="push-menu" role="button">
                <span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                </a>	
                <!-- Logo -->
                <a href="index.html" class="logo">
                    <!-- logo-->
                    <div class="logo-lg">
                        <span class="light-logo">
                            <img src="{{ asset('images/logo_dark.png') }}" alt="logo">
                        </span>
                        <span class="dark-logo">
                            <img src="{{ asset('images/logo_dark.png') }}" alt="logo">
                        </span>
                    </div>
                </a>
            </div>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <div class="app-menu">
                    <ul class="header-megamenu nav">
                        <li class="btn-group nav-item d-md-none">
                            <a href="#" class="waves-effect waves-light nav-link push-btn btn-info-light" data-toggle="push-menu" role="button">
                            <span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                            </a>
                        </li>
                        <li class="btn-group nav-item d-none d-xl-inline-block">
                            <div class="app-menu">
                                <div class="search-bx mx-5">
                                    <form>
                                        <div class="input-group">
                                            <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                            <div class="input-group-append">
                                                <button class="btn" type="submit" id="button-addon3"><i class="ti-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="navbar-custom-menu r-side">
                    <ul class="nav navbar-nav">
                        <li class="btn-group nav-item d-lg-inline-flex d-none">
                            <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen btn-info-light" title="Full Screen">
                            <i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
                            </a>
                        </li>
                        <!-- Notifications -->
                        <li class="dropdown notifications-menu">
                            <span class="label label-danger">5</span>
                            <a href="#" class="waves-effect waves-light dropdown-toggle btn-danger-light" data-toggle="dropdown" title="Notifications">
                            <i class="icon-Notifications"><span class="path1"></span><span class="path2"></span></i>
                            </a>
                            <ul class="dropdown-menu animated bounceIn">
                                <li class="header">
                                    <div class="p-20">
                                        <div class="flexbox">
                                            <div>
                                                <h4 class="mb-0 mt-0">Notifications</h4>
                                            </div>
                                            <div>
                                                <a href="#" class="text-danger">Clear All</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu sm-scrol">
                                        <li>
                                            <a href="#">
                                            <i class="fa fa-users text-info"></i> Curabitur id eros quis nunc suscipit blandit.
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                            <i class="fa fa-warning text-warning"></i> Duis malesuada justo eu sapien elementum, in semper diam posuere.
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                            <i class="fa fa-users text-danger"></i> Donec at nisi sit amet tortor commodo porttitor pretium a erat.
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                            <i class="fa fa-shopping-cart text-success"></i> In gravida mauris et nisi
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                            <i class="fa fa-user text-danger"></i> Praesent eu lacus in libero dictum fermentum.
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                            <i class="fa fa-user text-primary"></i> Nunc fringilla lorem 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                            <i class="fa fa-user text-success"></i> Nullam euismod dolor ut quam interdum, at scelerisque ipsum imperdiet.
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all</a>
                                </li>
                            </ul>
                        </li>
                        <!-- Right Sidebar Toggle Button -->
                        <li class="btn-group nav-item d-xl-none d-inline-flex">
                            <a href="#" class="push-btn right-bar-btn waves-effect waves-light nav-link full-screen btn-info-light">
                            <span class="icon-Layout-left-panel-1"><span class="path1"></span><span class="path2"></span></span>
                            </a>
                        </li>
                        <!-- User Account-->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle p-0 text-dark hover-primary ml-md-30 ml-10" data-toggle="dropdown" title="User">
                            <span class="pl-30 d-md-inline-block d-none">Hello,</span> <strong class="d-md-inline-block d-none">{{ Auth::user()->name }}</strong>
                                <img src="{{ asset('images/avatar.png') }}" class="user-image rounded-circle avatar bg-white mx-10" alt="{{ Auth::user()->name }}">
                            </a>
                            <ul class="dropdown-menu animated flipInX">
                                <li class="user-body">
                                    <a class="dropdown-item" href="#"><i class="ti-user text-muted mr-2"></i> Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ti-lock text-muted mr-2"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <!-- sidebar-->
            <section class="sidebar position-relative">
                <div class="multinav">
                    <div class="multinav-scroll" style="height: 100%;">
                        <!-- sidebar menu-->
                        <ul class="sidebar-menu" data-widget="tree">
                            <li class="{{ Request::routeIs('home') ? 'active' : '' }}">
                                <a href="{{ route('home') }}">
                                    <i class="icon-Home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            @canany(['view user', 'create user', 'update user', 'delete user'])
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Group"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Users</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create user')
                                    <li class="{{ Request::routeIs('user.create') || Request::routeIs('user.edit') || Request::routeIs('user.user') ? 'active' : '' }}"><a href="{{ route('user.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add User</a></li>
                                    @endcan
                                    @can('view user')
                                    <li class="{{ Request::routeIs('user.index') ? 'active' : '' }}"><a href="{{ route('user.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Users List</a></li>
                                    @endcan
                                </ul>
                            </li>
                            @endcanany
                        </ul>
                        <div class="sidebar-widgets">
                            <div class="copyright text-left m-25">
                                <p><strong class="d-block">Tritact Gateway</strong> © 2024 All Rights Reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">
                @yield('content')
            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- Content Right Sidebar -->
        <div class="right-bar">
            <div id="sidebarRight">
                <div class="right-bar-inner">
                    <div class="text-end position-relative">
                        <a href="#" class="d-inline-block d-xl-none btn right-bar-btn waves-effect waves-circle btn btn-circle btn-danger btn-sm">
                        <i class="mdi mdi-close"></i>
                        </a>
                    </div>
                    <div class="right-bar-content">
                        <div class="box no-shadow box-bordered border-light">
                            <div class="box-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Total Sale</h5>
                                        <h2 class="mb-0">$254.90</h2>
                                    </div>
                                    <div class="p-10">
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="my-0">6 total orders</h5>
                                    <a href="#" class="mb-0">View Report</a>
                                </div>
                            </div>
                        </div>
                        <div class="box no-shadow box-bordered border-light">
                            <div class="box-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Total Sessions</h5>
                                        <h2 class="mb-0">845</h2>
                                    </div>
                                    <div class="p-10">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="d-flex align-items-center justify-content-between">						  	  
                                    <a href="#" class="btn btn-primary-light btn-sm">Live</a>						  	  
                                    <a href="#" class="btn btn-info-light btn-sm">4 Visitors</a>						  	  
                                    <a href="#" class="btn btn-success-light btn-sm">See Live View</a>
                                </div>
                            </div>
                        </div>
                        <div class="box no-shadow box-bordered border-light">
                            <div class="box-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Customer rate</h5>
                                        <h2 class="mb-0">5.12%</h2>
                                    </div>
                                    <div class="p-10">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="my-0"><span class="badge badge-xl badge-dot badge-primary mr-10"></span>First Time</h5>
                                    <h5 class="my-0"><span class="badge badge-xl badge-dot badge-danger mr-10"></span>Returning</h5>
                                </div>
                            </div>
                        </div>
                        <div class="box no-shadow box-bordered border-light">
                            <div class="box-header">
                                <h4 class="box-title">Resent Activity</h4>
                            </div>
                            <div class="box-body p-5">
                                <div class="media-list media-list-hover">
                                    <a class="media media-single mb-10 p-0 rounded-0" href="#">
                                        <h4 class="w-50 text-gray font-weight-500">10:10</h4>
                                        <div class="media-body pl-15 bl-5 rounded border-primary">
                                            <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                            <span class="text-fade">by Johne</span>
                                        </div>
                                    </a>
                                    <a class="media media-single mb-10 p-0 rounded-0" href="#">
                                        <h4 class="w-50 text-gray font-weight-500">08:40</h4>
                                        <div class="media-body pl-15 bl-5 rounded border-success">
                                            <p>Proin iaculis eros non odio ornare efficitur.</p>
                                            <span class="text-fade">by Amla</span>
                                        </div>
                                    </a>
                                    <a class="media media-single mb-10 p-0 rounded-0" href="#">
                                        <h4 class="w-50 text-gray font-weight-500">07:10</h4>
                                        <div class="media-body pl-15 bl-5 rounded border-info">
                                            <p>In mattis mi ut posuere consectetur.</p>
                                            <span class="text-fade">by Josef</span>
                                        </div>
                                    </a>
                                    <a class="media media-single mb-10 p-0 rounded-0" href="#">
                                        <h4 class="w-50 text-gray font-weight-500">01:15</h4>
                                        <div class="media-body pl-15 bl-5 rounded border-danger">
                                            <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                            <span class="text-fade">by Rima</span>
                                        </div>
                                    </a>
                                    <a class="media media-single mb-10 p-0 rounded-0" href="#">
                                        <h4 class="w-50 text-gray font-weight-500">23:12</h4>
                                        <div class="media-body pl-15 bl-5 rounded border-warning">
                                            <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                            <span class="text-fade">by Alaxa</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="text-center">						  	  
                                    <a href="#" class="mb-0">Load More</a>					  	  		
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.Content Right Sidebar -->
        <footer class="main-footer">
            &copy; 2024 <a href="#">Custom Themes</a>. All Rights Reserved.
        </footer>
        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <script src="{{ asset('js/vendors.min.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.min.js" integrity="sha512-JCDnPKShC1tVU4pNu5mhCEt6KWmHf0XPojB0OILRMkr89Eq9BHeBP+54oUlsmj8R5oWqmJstG1QoY6HkkKeUAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        if($('.select2').length != 0){
            $('.select2').select2();
        }
        if($('.datatables').length != 0){
            $('.datatables').DataTable();
        }
    </script>
    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "Successfully",
            text: "{{ session()->get('success') }}",
            showConfirmButton: true,
            timer: 2500
        });
    </script>
    @endif
    @if(session()->has('warning'))
    <script>
        Swal.fire({
            icon: "warning",
            title: "Warning",
            text: "{{ session()->get('warning') }}",
            showConfirmButton: true,
            timer: 2500
        });
    </script>
    @endif
    @stack('script')
</body>
</html>