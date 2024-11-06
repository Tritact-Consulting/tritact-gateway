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
                            <li class="{{ Request::routeIs('admin.home') ? 'active' : '' }}">
                                <a href="{{ route('admin.home') }}">
                                    <i class="icon-Home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Clipboard-check"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    <span>Company</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="{{ Request::routeIs('company.create') || Request::routeIs('company.edit') ? 'active' : '' }}"><a href="{{ route('company.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Company</a></li>
                                    <li class="{{ Request::routeIs('company.index') ? 'active' : '' }}"><a href="{{ route('company.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Company List</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Tags</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="{{ Request::routeIs('tag.create') || Request::routeIs('tag.edit') ? 'active' : '' }}"><a href="{{ route('tag.create') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Tags</a></li>
                                    <li class="{{ Request::routeIs('tag.index') ? 'active' : '' }}"><a href="{{ route('tag.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Tag List</a></li>
                                </ul>
                            </li>

                            <li class="treeview">
                                <a href="#">
                                <i class="icon-Dinner"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                <span>Menus</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="add_new_menu.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add New Menu</a></li>
                                    <li><a href="menu_list.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Menu List</a></li>
                                    <li><a href="menu_categories.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Categories</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="icon-Group"><span class="path1"></span><span class="path2"></span></i>
                                <span>Customer</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="add_new_menu.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Customer</a></li>
                                    <li><a href="members.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Members</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="analysis.html">
                                <i class="icon-Chart-line"><span class="path1"></span><span class="path2"></span></i>
                                <span>Analysis</span>
                                </a>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="icon-Cart"><span class="path1"></span><span class="path2"></span></i>
                                <span>Online Store</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="ecommerce_products.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products</a></li>
                                    <li><a href="ecommerce_cart.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products Cart</a></li>
                                    <li><a href="ecommerce_products_edit.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products Edit</a></li>
                                    <li><a href="ecommerce_details.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Product Details</a></li>
                                    <li><a href="ecommerce_orders.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Product Orders</a></li>
                                    <li><a href="ecommerce_checkout.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products Checkout</a></li>
                                    <li><a href="invoice.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Invoice</a></li>
                                    <li><a href="invoicelist.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Invoice List</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                                <span>Collections</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="mailbox.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Mailbox</a></li>
                                    <li class="treeview">
                                        <a href="#">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Widgets
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="widgets_blog.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Blog</a></li>
                                            <li><a href="widgets_chart.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Chart</a></li>
                                            <li><a href="widgets_list.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
                                            <li><a href="widgets_social.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Social</a></li>
                                            <li><a href="widgets_statistic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Statistic</a></li>
                                            <li><a href="widgets_weather.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Weather</a></li>
                                            <li><a href="widgets.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Widgets</a></li>
                                        </ul>
                                    </li>
                                    <li class="treeview">
                                        <a href="#">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Modals
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="component_modals.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Modals</a></li>
                                            <li><a href="component_sweatalert.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sweet Alert</a></li>
                                            <li><a href="component_notification.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Toastr</a></li>
                                        </ul>
                                    </li>
                                    <li class="treeview">
                                        <a href="#">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Apps
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="extra_calendar.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Calendar</a></li>
                                            <li><a href="contact_app.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Contact List</a></li>
                                            <li><a href="contact_app_chat.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Chat</a></li>
                                            <li><a href="extra_taskboard.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Todo</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="email_index.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Emails</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="icon-Brush"><span class="path1"></span><span class="path2"></span></i>
                                <span>UI & Components</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="treeview">
                                        <a href="#">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Components
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="component_bootstrap_switch.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Bootstrap Switch</a></li>
                                            <li><a href="component_date_paginator.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Date Paginator</a></li>
                                            <li><a href="component_media_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Advanced Medias</a></li>
                                            <li><a href="component_rangeslider.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Range Slider</a></li>
                                            <li><a href="component_rating.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Ratings</a></li>
                                            <li><a href="component_animations.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Animations</a></li>
                                            <li><a href="extension_fullscreen.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Fullscreen</a></li>
                                            <li><a href="extension_pace.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pace</a></li>
                                            <li><a href="component_nestable.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Nestable</a></li>
                                            <li><a href="component_portlet_draggable.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Draggable Portlets</a></li>
                                        </ul>
                                    </li>
                                    <li class="treeview">
                                        <a href="#">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Utilities
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="ui_grid.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Grid System</a></li>
                                            <li><a href="box_cards.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>User Card</a></li>
                                            <li><a href="box_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Advanced Card</a></li>
                                            <li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Basic Card</a></li>
                                            <li><a href="box_color.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Card Color</a></li>
                                            <li><a href="box_group.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Card Group</a></li>
                                            <li><a href="ui_badges.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Badges</a></li>
                                            <li><a href="ui_border_utilities.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Border</a></li>
                                            <li><a href="ui_buttons.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Buttons</a></li>
                                            <li><a href="ui_color_utilities.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Color</a></li>
                                            <li><a href="ui_dropdown.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dropdown</a></li>
                                            <li><a href="ui_dropdown_grid.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dropdown Grid</a></li>
                                            <li><a href="ui_progress_bars.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Progress Bars</a></li>
                                        </ul>
                                    </li>
                                    <li class="treeview">
                                        <a href="#">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Icons
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="icons_fontawesome.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Font Awesome</a></li>
                                            <li><a href="icons_glyphicons.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Glyphicons</a></li>
                                            <li><a href="icons_material.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Material Icons</a></li>
                                            <li><a href="icons_themify.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Themify Icons</a></li>
                                            <li><a href="icons_simpleline.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Simple Line Icons</a></li>
                                            <li><a href="icons_cryptocoins.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Cryptocoins Icons</a></li>
                                            <li><a href="icons_flag.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Flag Icons</a></li>
                                            <li><a href="icons_weather.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Weather Icons</a></li>
                                        </ul>
                                    </li>
                                    <li class="treeview">
                                        <a href="#">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Elements
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="ui_ribbons.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Ribbons</a></li>
                                            <li><a href="ui_sliders.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sliders</a></li>
                                            <li><a href="ui_typography.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Typography</a></li>
                                            <li><a href="ui_tab.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Tabs</a></li>
                                            <li><a href="ui_timeline.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Timeline</a></li>
                                            <li><a href="ui_timeline_horizontal.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Horizontal Timeline</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="icon-File"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                <span>Forms & Tables</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="treeview">
                                        <a href="#">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Forms
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="forms_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Form Elements</a></li>
                                            <li><a href="forms_general.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Form Layout</a></li>
                                            <li><a href="forms_wizard.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Form Wizard</a></li>
                                            <li><a href="forms_validation.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Form Validation</a></li>
                                            <li><a href="forms_mask.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Formatter</a></li>
                                            <li><a href="forms_xeditable.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Xeditable Editor</a></li>
                                            <li><a href="forms_dropzone.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dropzone</a></li>
                                            <li><a href="forms_code_editor.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Code Editor</a></li>
                                            <li><a href="forms_editors.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Editor</a></li>
                                            <li><a href="forms_editor_markdown.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Markdown</a></li>
                                        </ul>
                                    </li>
                                    <li class="treeview">
                                        <a href="#">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Tables
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="tables_simple.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Simple tables</a></li>
                                            <li><a href="tables_data.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data tables</a></li>
                                            <li><a href="tables_editable.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Editable Tables</a></li>
                                            <li><a href="tables_color.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Table Color</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="icon-Chart-pie"><span class="path1"></span><span class="path2"></span></i>
                                <span>Charts & Maps</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="treeview">
                                        <a href="#">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Charts
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="charts_chartjs.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>ChartJS</a></li>
                                            <li><a href="charts_flot.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Flot</a></li>
                                            <li><a href="charts_inline.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Inline charts</a></li>
                                            <li><a href="charts_morris.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Morris</a></li>
                                            <li><a href="charts_peity.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Peity</a></li>
                                            <li><a href="charts_chartist.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Chartist</a></li>
                                            <li><a href="charts_c3_axis.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Axis Chart</a></li>
                                            <li><a href="charts_c3_bar.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Bar Chart</a></li>
                                            <li><a href="charts_c3_data.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data Chart</a></li>
                                            <li><a href="charts_c3_line.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Line Chart</a></li>
                                            <li><a href="charts_echarts_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Basic Charts</a></li>
                                            <li><a href="charts_echarts_bar.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Bar Chart</a></li>
                                            <li><a href="charts_echarts_pie_doughnut.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pie & Doughnut Chart</a></li>
                                        </ul>
                                    </li>
                                    <li class="treeview">
                                        <a href="#">
                                        <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Maps
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="map_google.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Google Map</a></li>
                                            <li><a href="map_vector.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Vector Map</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="icon-Chat-locked"><span class="path1"></span><span class="path2"></span></i>
                                <span>Authentication</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="auth_login.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Login</a></li>
                                    <li><a href="auth_register.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Register</a></li>
                                    <li><a href="auth_lockscreen.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lockscreen</a></li>
                                    <li><a href="auth_user_pass.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Recover password</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="icon-Chat-check"><span class="path1"></span><span class="path2"></span></i>
                                <span>Miscellaneous</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="error_404.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Error 404</a></li>
                                    <li><a href="error_500.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Error 500</a></li>
                                    <li><a href="error_maintenance.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Maintenance</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                                <span>Usefull Page</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="extra_app_ticket.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Support Ticket</a></li>
                                    <li><a href="extra_profile.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>User Profile</a></li>
                                    <li><a href="contact_userlist_grid.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Userlist Grid</a></li>
                                    <li><a href="contact_userlist.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Userlist</a></li>
                                    <li><a href="sample_faq.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>FAQs</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="icon-Clipboard"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                <span>Extra Pages</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="sample_blank.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Blank</a></li>
                                    <li><a href="sample_coming_soon.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Coming Soon</a></li>
                                    <li><a href="sample_custom_scroll.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Custom Scrolls</a></li>
                                    <li><a href="sample_gallery.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Gallery</a></li>
                                    <li><a href="sample_lightbox.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lightbox Popup</a></li>
                                    <li><a href="sample_pricing.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pricing</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="sidebar-widgets">
                            <div class="mx-25 mb-30 pb-20 side-bx bg-primary bg-food-dark rounded20">
                                <div class="text-center">
                                    <img src="../images/res-menu.png" class="sideimg" alt="">
                                    <h3 class="title-bx">Add Menu</h3>
                                    <a href="#" class="text-white py-10 font-size-16 mb-0">
                                    Manage Your food and beverages menu <i class="mdi mdi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="copyright text-left m-25">
                                <p><strong class="d-block">Riday Admin Dashboard</strong> © 2021 All Rights Reserved</p>
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
                                        <div id="chart-spark1"></div>
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
                                        <div id="chart-spark2"></div>
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
                                        <div id="chart3"></div>
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
    <script src="{{ asset('js/custom.js') }}"></script>
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
</body>
</html>