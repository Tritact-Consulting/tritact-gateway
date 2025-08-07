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
    <title>@yield('title') | {!! config('app.name', 'Laravel') !!}</title>
    @stack('style')
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
                <a href="{{ route('admin.home') }}" class="logo">
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
                                            <!--<input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">-->
                                            <div class="input-group-append">
                                                <!--<button class="btn" type="submit" id="button-addon3"><i class="ti-search"></i></button>-->
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
                            <span class="label label-danger">{{auth()->user()->unreadNotifications->count()}}</span>
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
                                                <a href="{{route('admin.mark-as-read')}}" class="text-danger">Clear All</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu sm-scrol">
                                        @foreach (auth()->user()->unreadNotifications as $notification)
                                        <li>
                                            <a href="javascript:;" title="{{ $notification->data['data'] }}">
                                                @if($notification->type == 'App\Notifications\UserCreationSuccessful')
                                                <i class="fa fa-user-plus text-info"></i>
                                                @elseif($notification->type == 'App\Notifications\DocumentDownloadSuccessful')
                                                <i class="fa fa-download text-success" aria-hidden="true"></i>
                                                @elseif($notification->type == 'App\Notifications\AssignAuditNotification')
                                                <i class="fa fa-list text-success" aria-hidden="true"></i>
                                                @endif
                                                {{ $notification->data['data'] }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
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
                            <li class="{{ Request::routeIs('admin.home') ? 'active' : '' }}">
                                <a href="{{ route('admin.home') }}">
                                    <i class="icon-Home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            @can('view company')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Clipboard-check"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    <span>Company</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create company')
                                    <li class="{{ Request::routeIs('company.create') || Request::routeIs('company.edit') || Request::routeIs('company.user') ? 'active' : '' }}"><a href="{{ route('company.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Company</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('company.index') ? 'active' : '' }}"><a href="{{ route('company.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Company List</a></li>
                                </ul>
                            </li>
                            @endcan
                            @can('view tag')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Tags</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create tag')
                                    <li class="{{ Request::routeIs('tag.create') || Request::routeIs('tag.edit') ? 'active' : '' }}"><a href="{{ route('tag.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Tags</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('tag.index') ? 'active' : '' }}"><a href="{{ route('tag.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Tag List</a></li>
                                </ul>
                            </li>
                            @endcan
                            @can('view doc')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-File"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    <span>Documents</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create doc')
                                    <li class="{{ Request::routeIs('document.create') || Request::routeIs('document.edit') ? 'active' : '' }}"><a href="{{ route('document.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Document</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('document.index') ? 'active' : '' }}"><a href="{{ route('document.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Document List</a></li>
                                </ul>
                            </li>
                            @endcan
                            @can('view category')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Cart"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Category</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create category')
                                    <li class="{{ Request::routeIs('category.create') || Request::routeIs('category.edit') ? 'active' : '' }}"><a href="{{ route('category.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Type</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('category.index') ? 'active' : '' }}"><a href="{{ route('category.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Type List</a></li>
                                </ul>
                            </li>
                            @endcan
                            @can('view guide')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Chat-check"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Guide</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create guide')
                                    <li class="{{ Request::routeIs('guide.create') || Request::routeIs('guide.edit') ? 'active' : '' }}"><a href="{{ route('guide.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Guide</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('guide.index') ? 'active' : '' }}"><a href="{{ route('guide.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Guide List</a></li>
                                </ul>
                            </li>
                            @endcan
                            <!--<li class="{{ Request::routeIs('version.create') || Request::routeIs('version.edit') || Request::routeIs('version.index') ? 'active' : '' }}">-->
                            <!--    <a href="{{ route('version.index') }}">-->
                            <!--        <i class="icon-Chat-check"><span class="path1"></span><span class="path2"></span></i>-->
                            <!--        <span>Version</span>-->
                            <!--    </a>-->
                            <!--</li>-->
                            @can('view certification category')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Cart"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Certification Type</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create certification category')
                                    <li class="{{ Request::routeIs('certification-category.create') || Request::routeIs('certification-category.edit') ? 'active' : '' }}"><a href="{{ route('certification-category.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Category</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('certification-category.index') ? 'active' : '' }}"><a href="{{ route('certification-category.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Category List</a></li>
                                </ul>
                            </li>
                            @endcan
                            @can('view certification body')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Chart-line"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Certification Body</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create certification body')
                                    <li class="{{ Request::routeIs('certification-body.create') || Request::routeIs('certification-body.edit') ? 'active' : '' }}"><a href="{{ route('certification-body.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Body</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('certification-body.index') ? 'active' : '' }}"><a href="{{ route('certification-body.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Body List</a></li>
                                </ul>
                            </li>
                            @endcan
                            @can('view auditor')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Auditor</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create auditor')
                                    <li class="{{ Request::routeIs('auditor.create') || Request::routeIs('auditor.edit') ? 'active' : '' }}"><a href="{{ route('auditor.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Auditor</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('auditor.index') ? 'active' : '' }}"><a href="{{ route('auditor.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Auditor List</a></li>
                                </ul>
                            </li>
                            @endcan
                            @can('view assign certification')
                            <li class="{{ Request::routeIs('company.certification.assign') || Request::routeIs('company.certification.edit') ? 'active' : '' }}">
                                <a href="{{ route('company.certification.assign') }}">
                                    <i class="icon-Share1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                    <span>Certification Summary</span>
                                </a>
                            </li>
                            @endcan
                            @can('view assign audit')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Chart-pie"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Live Audit</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create assign audit')
                                    <li class="{{ Request::routeIs('assign-audit.create') || Request::routeIs('assign-audit.edit') ? 'active' : '' }}"><a href="{{ route('assign-audit.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Assign Audit</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('assign-audit.index') ? 'active' : '' }}"><a href="{{ route('assign-audit.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Assign Audit List</a></li>
                                </ul>
                            </li>
                            @endcan
                            @can('view keyword')
                            <li class="{{ Request::routeIs('keyword.create') || Request::routeIs('keyword.edit') || Request::routeIs('keyword.index') ? 'active' : '' }}">
                                <a href="{{ route('keyword.index') }}">
                                    <i class="icon-Clipboard"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                    <span>Document Keyword</span>
                                </a>
                            </li>
                            @endcan
                            @can('view partner')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Add-user"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Partners</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create partner')
                                    <li class="{{ Request::routeIs('partner.create') || Request::routeIs('partner.edit') ? 'active' : '' }}"><a href="{{ route('partner.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Partner</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('partner.index') ? 'active' : '' }}"><a href="{{ route('partner.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Partners List</a></li>
                                </ul>
                            </li>
                            @endcan
                            @canany(['view consultation body', 'create consultation body', 'view consultant', 'create consultant', 'view consultation summary', 'create consultation summary'])
                            <li class="header">Consultation</li>
                            @endcan
                            @can('view consultation body')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Chart-line"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Consultation Body</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create consultation body')
                                    <li class="{{ Request::routeIs('consultation-body.create') || Request::routeIs('consultation-body.edit') ? 'active' : '' }}"><a href="{{ route('consultation-body.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Body</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('consultation-body.index') ? 'active' : '' }}"><a href="{{ route('consultation-body.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Body List</a></li>
                                </ul>
                            </li>
                            @endcan
                            @can('view consultant')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Consultants</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create consultant')
                                    <li class="{{ Request::routeIs('consultant.create') || Request::routeIs('consultant.edit') ? 'active' : '' }}"><a href="{{ route('consultant.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Consultant</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('consultant.index') ? 'active' : '' }}"><a href="{{ route('consultant.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Consultant List</a></li>
                                </ul>
                            </li>
                            @endcan
                            @can('view consultation summary')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Chart-pie"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Consultation Summary</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create consultation summary')
                                    <li class="{{ Request::routeIs('consultation-summary.create') || Request::routeIs('consultation-summary.edit') ? 'active' : '' }}"><a href="{{ route('consultation-summary.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Summary</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('consultation-summary.index') ? 'active' : '' }}"><a href="{{ route('consultation-summary.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Summary List</a></li>
                                </ul>
                            </li>
                            @endcan
                            @canany(['all attendance', 'view attendance'])
                            <li class="header">Attendances</li>
                            @endcan
                            @can('view attendance')
                            <li class="{{ Request::routeIs('attendance.index') ? 'active' : '' }}">
                                <a href="{{ route('attendance.index') }}">
                                    <i class="icon-Tablet"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                    <span>Attendance</span>
                                </a>
                            </li>
                            @endcan
                            @can('all attendance')
                            <li class="{{ Request::routeIs('all-attendance.index') ? 'active' : '' }}">
                                <a href="{{ route('all-attendance.index') }}">
                                    <i class="icon-Tablet"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                    <span>All Attendance</span>
                                </a>
                            </li>
                            @endcan
                            <li class="header">Notifications</li>
                            <li class="{{ Request::routeIs('all-attendance.index') ? 'active' : '' }}">
                                <a href="{{ route('all-attendance.index') }}">
                                    <i class="icon-Speaker"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                    <span>All Notifications</span>
                                </a>
                            </li>

                            @canany(['role', 'view user'])
                            <li class="header">Roles & Permissions</li>
                            @endcan
                            @can('role')
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Brush"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Roles</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('create role')
                                    <li class="{{ Request::routeIs('roles.create') || Request::routeIs('roles.edit') ? 'active' : '' }}"><a href="{{ route('roles.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Role</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('roles.index') ? 'active' : '' }}"><a href="{{ route('roles.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Role List</a></li>
                                </ul>
                            </li>
                            @endcan
                            @can('view user')
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
                                    <li class="{{ Request::routeIs('users.create') || Request::routeIs('users.edit') ? 'active' : '' }}"><a href="{{ route('users.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Users</a></li>
                                    @endcan
                                    <li class="{{ Request::routeIs('users.index') ? 'active' : '' }}"><a href="{{ route('users.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>User List</a></li>
                                </ul>
                            </li>
                            @endcan
                        </ul>
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
                            <div class="box-header">
                                <h4 class="box-title">Recent Activity</h4>
                            </div>
                            <div class="box-body p-5">
                                <div class="media-list media-list-hover sidebar-notification">
                                    @php
                                    $class_array = ['border-primary', 'border-success', 'border-info', 'border-danger', 'border-warning']; 
                                    $count = 0;
                                    @endphp
                                    @foreach (auth()->user()->unreadNotifications as $notification)
                                    <a class="media-single mb-10 p-0 rounded-0" title="{{ $notification->data['data'] }}" href="{{ array_key_exists('url', $notification->data) ? route('assigned-audit.show', $notification->data['url']) : 'javascript:;' }}">
                                        <div class="media-body pl-15 bl-5 rounded {{ $class_array[$count] }}">
                                            <p>{{ $notification->data['data'] }}</p>
                                            <span class="text-fade">by {{ $notification->data['name'] }}</span>
                                            <h4 class="w-50 text-gray font-weight-500">{{ $notification->created_at->diffForHumans() }}</h4>
                                        </div>
                                    </a>
                                    @php
                                    $count++;
                                    @endphp
                                    @if($count == 5)
                                    @php
                                    $count = 0;
                                    @endphp
                                    @endif
                                    @endforeach
                                    @if (auth()->user()->unreadNotifications)
                                    <li class="d-flex justify-content-end">
                                        <a href="{{route('admin.mark-as-read')}}" class="btn btn-success btn-sm btn-block mt-2 mb-2">Mark All as Read</a>
                                    </li>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.Content Right Sidebar -->
        <footer class="main-footer d-flex justify-content-between" style="padding-right: 30px;">
            <div>
                &copy; {{ date('Y') }} <a href="#">{!! config('app.name', 'Laravel') !!}</a>. All Rights Reserved.
            </div>
            <div class="text-right">
                <a href="mailto:support@tritact.co.uk" target="_blank">support@tritact.co.uk</a>
            </div>
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
            $('.select2').on("select2:select", function (e) { 
                var data = e.params.data.text;
                if(data=='All'){
                    $(".select2 > option").prop("selected","selected");
                    $(".select2").trigger("change");
                }
            });
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $('.show_confirm').click(function(event) {
                var set_heading = 'document';
                var heading = $(this).data('heading');
                if(heading != undefined){
                    set_heading = heading;
                }
                var form =  $(this).closest("form");
                event.preventDefault();
                swal({
                    title: 'Are you sure you want to delete this '+ set_heading +'?',
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        setInterval(() => {
            $.ajax({
                type: 'POST',
                url: "{{ url('keep-alive') }}",
                success: function(data) {
                    console.log(data);
                }
            });
        }, 1200000)
    </script>
    @stack('script')
</body>
</html>