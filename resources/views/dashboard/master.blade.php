<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> MY Hamama | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('cms/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.cs') }}s">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/summernote/summernote-bs4.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Bootstrap 4 RTL -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <!-- Custom style for RTL -->
    <link rel="stylesheet" href="{{ asset('cms/dist/css/custom.css') }}">

    <link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container .select2-selection--single {
            height: 38px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
    </style>

    <style>
        .phone_one {
            position: relative;
        }

        .phone_one::before {
            content: "1";
            width: 5px;
            font-size: 12px;
            font-weight: bold;
            top: 4px;
            height: 5px;
            border-radius: 50%;
            position: absolute;
        }

        .phone_two {
            position: relative;
        }

        .phone_two::before {
            content: "2";
            width: 5px;
            font-size: 12px;
            font-weight: bold;
            top: 4px;
            height: 5px;
            border-radius: 50%;
            position: absolute;
        }

        .phone_three {
            position: relative;
        }

        .phone_three::before {
            content: "3";
            width: 5px;
            font-size: 12px;
            font-weight: bold;
            top: 4px;
            height: 5px;
            border-radius: 50%;
            position: absolute;
        }

        .dropdown-menu {
            min-width: 41rem !important;
        }
    </style>
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('parent') }}" class="nav-link">الرئيسية</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="https://www.facebook.com/hamama.delivery" class="nav-link"><i
                            class="fa-brands fa-facebook-f"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="https://www.facebook.com/hamama.delivery" class="nav-link"><i
                            class="fa-brands fa-instagram"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="https://wa.link/3z0dmj" class="nav-link"><i class="fa-brands fa-whatsapp"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block ">
                    <a href="tel:0592881213" class="nav-link phone_one"><i class="fa-solid fa-phone"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block ">
                    <a href="tel:0599690190" class="nav-link phone_two"><i class="fa-solid fa-phone"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block ">
                    <a href="tel:0593558721" class="nav-link phone_three"><i class="fa-solid fa-phone"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="tel:082881213" class="nav-link"><i class="fa-solid fa-phone-rotary"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->

            @if (auth('admin')->check())

                <ul class="navbar-nav mr-auto-navbav">
                    <!-- Notifications Dropdown Menu -->
                    @php
                        $user = Auth::guard('admin')->user();
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell "></i>
                            <span style="margin-top: -10px !important; transform: translateX(7px);"
                                class="badge badge-warning navbar-badge ">{{ $user->unreadNotifications()->count() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            @foreach ($user->notifications()->take(5)->get() as $notification)
                                <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}"
                                    class="dropdown-item @if ($notification->read()) text-sm bg-dark @endif">
                                    <i class="fas fa-envelope mr-2"></i>
                                    {{ $notification->data['body'] }}
                                    <span class="float-right text-muted text-sm">
                                        {{ $notification->created_at->shortAbsoluteDiffForHumans() }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </li>
                </ul>
            @endif
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('parent') }}" class="brand-link">
                <img src="{{ asset('front/313427414_447607517496777_6429835025409110466_n.png') }}" alt="Hamama Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">حمامة ديلفري</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (Auth::guard('admin')->id())
                            {{-- @if (auth('admin')->user()->user->images != '') --}}
                            <img class="brand-image img-circle elevation-3"
                                src="{{ asset('storage/images/admin/' . auth('admin')->user()->user->image) }}"alt="User Image">
                            {{-- @else --}}
                            {{-- <img src="{{ asset('cms/dist/img/user2-160x160.jpg') }}"
                                    class="img-circle elevation-2" alt="User Image">
                            @endif --}}
                        @endif
                        @if (Auth::guard('client')->id())
                            {{-- @if (auth('client')->user()->user->images != '') --}}
                            <img class="brand-image img-circle elevation-3"
                                src="{{ asset('storage/images/admin/' . auth('client')->user()->user->image) }}"alt="User Image">
                            {{-- @else
                                <img src="{{ asset('cms/dist/img/user2-160x160.jpg') }}"
                                    class="img-circle elevation-2" alt="User Image">
                            @endif --}}
                        @endif
                    </div>
                    <div class="info">
                        <a href="{{ route('editProfile') }}" class="d-block">
                            @if (Auth::guard('admin')->id())
                                <a href="{{ route('editProfile') }}" class="d-block">
                                    {{ auth('admin')->user()->user->name }}</a>
                            @elseif (Auth::guard('client')->id())
                                <a href="{{ route('editProfile') }}" class="d-block">
                                    {{ auth('client')->user()->user->name }}</a>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        @canany(['Index-Role', 'Create-Role', 'Index-Permission', 'Create-Permission'])
                            <li class="nav-header"> الأدوار والصلاحيات</li>

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-envelope"></i>
                                    <p>
                                        الأدوار
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('Index-Role')
                                        <li class="nav-item">
                                            <a href="{{ route('roles.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>عرض الأدوار</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('Create-Role')
                                        <li class="nav-item">
                                            <a href="{{ route('roles.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>إضافة دور</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-envelope"></i>
                                    <p>
                                        الصلاحيات
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    @can('Index-Permission')
                                        <li class="nav-item">
                                            <a href="{{ route('permissions.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>عرض الصلاحيات</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('Create-Permission')
                                        <li class="nav-item">
                                            <a href="{{ route('permissions.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>إضافة صلاحية</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany

                        @canany(['index-admin', 'create-admin', 'index-captain', 'create-captain', 'index-client',
                            'create-client', 'create-bonus', 'index-bonus'])
                            <li class="nav-header">مستخدمين النظام</li>
                        @endcanany
                        <!-- القائمة  -->
                        @canany(['index-admin', 'create-admin'])
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-user"></i>
                                    <p>
                                        المشرف
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('index-admin')
                                        <li class="nav-item">
                                            <a href="{{ route('admins.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>عرض المشرفين</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('create-admin')
                                        <li class="nav-item">
                                            <a href="{{ route('admins.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>إضافة مشرف</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        <!-- نهاية القائمة  -->

                        <!-- القائمة  -->
                        @canany(['index-captain', 'create-captain'])
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-person-biking-mountain"></i>
                                    <p>
                                        الكباتن
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('index-captain')
                                        <li class="nav-item">
                                            <a href="{{ route('captains.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>عرض الكباتن</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('create-captain')
                                        <li class="nav-item">
                                            <a href="{{ route('captains.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>إضافة كابتن</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        <!-- نهاية القائمة  -->

                        <!-- القائمة  -->
                        @canany(['index-client', 'create-client'])
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-person-sign"></i>
                                    <p>
                                        العملاء
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('index-client')
                                        <li class="nav-item">
                                            <a href="{{ route('clients.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>عرض العملاء</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('create-client')
                                        <li class="nav-item">
                                            <a href="{{ route('clients.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>إضافة عميل</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        <!-- نهاية القائمة  -->
                        @canany(['index-city', 'create-city', 'index-street', 'create-street', 'index-sub_city',
                            'create-sub_city', 'index-order', 'create-order'])
                            <li class="nav-header">محتوى النظام</li>
                        @endcanany
                        @canany(['index-city', 'create-city'])
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-city"></i>
                                    <p>
                                        المدن
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('index-city')
                                        <li class="nav-item">
                                            <a href="{{ route('cities.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>عرض المدن</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('create-city')
                                        <li class="nav-item">
                                            <a href="{{ route('cities.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>إضافة مدينة</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany

                        @canany(['index-sub-city', 'create-sub-city'])
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-mountain-city"></i>
                                    <p>
                                        المحافظة الفرعية
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('index-sub-city')
                                        <li class="nav-item">
                                            <a href="{{ route('sub_cities.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p> عرض المحافظة الفرعية </p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('create-sub-city')
                                        <li class="nav-item">
                                            <a href="{{ route('sub_cities.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p> إضافة محافظة فرعية </p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        @canany(['index-bonus', 'create-bonus'])
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-duotone fa-sack-dollar"></i>
                                    <p>
                                        قائمة البونص
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('index-bonus')
                                        <li class="nav-item">
                                            <a href="{{ route('bonuses.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p> عرض قائمة البونص </p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('create-bonus')
                                        <li class="nav-item">
                                            <a href="{{ route('bonuses.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p> إضافة بونص جديد </p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        @canany(['index-envelope', 'create-envelope'])
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-envelope-open-dollar"></i>
                                    <p>
                                        قائمة المظاريف
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('index-envelope')
                                        <li class="nav-item">
                                            <a href="{{ route('envelopes.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p> عرض قائمة المظاريف </p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('create-envelope')
                                        <li class="nav-item">
                                            <a href="{{ route('envelopes.create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p> إضافة مظروف جديد </p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        @canany(['index-order', 'create-order'])
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-cart-circle-check"></i>
                                    <p>
                                        قائمة الطلبات
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (auth('admin')->check())
                                        @can('index-order')
                                            <li class="nav-item">
                                                <a href="{{ route('orders.index') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p> عرض قائمة اليوم </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('indexTomorrow') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p> عرض قائمة الغد </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('indexClientHasOrders') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p> عرض عملاء اليوم </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('index-order')
                                            <li class="nav-item">
                                                <a href="{{ route('orders_archive') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p> عرض ارشيف الطلبات </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('create-order')
                                            <li class="nav-item">
                                                <a href="{{ route('orders.create') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p> إضافة طلب جديد </p>
                                                </a>
                                            </li>
                                        @endcan
                                    @endif
                                    @if (auth('client')->check())
                                        @can('index-order')
                                            <li class="nav-item">
                                                <a href="{{ route('indexOrders', ['id' => Auth::id()]) }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p> عرض قائمة الطلبات </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('clientArchive') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p> عرض ارشيف الطلبات </p>
                                                </a>
                                            </li>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('yesterdayOrdersReport') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p> عرض تقرير طلباتك امس </p>
                                                </a>
                                            </li>

                                        @endcan
                                        @can('create-order')
                                            <li class="nav-item">
                                                <a href="{{ route('createOrder', ['id' => Auth::id()]) }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p> إضافة طلب جديد </p>
                                                </a>
                                            </li>
                                        @endcan
                                    @endif
                                </ul>
                            </li>
                        @endcanany
                        <li class="nav-header">الاعدادات</li>
                        <li class="nav-item">
                            <a href="{{ route('editProfile') }}" class="nav-link">
                                <i class="fa-solid fa-user-pen"></i>
                                <p>تعديل الملف الشخصي</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('editPassword') }}" class="nav-link">
                                <i class="fa-solid fa-key"></i>
                                <p>تعديل كلمة المرور</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout').submit()">
                                <form action="{{ route('logout') }}" id="logout" method="post">
                                    @csrf
                                </form>
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <p>تسجيل الخروج</p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('main-title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('parent') }}">الرئيسية</a></li>
                                <li class="breadcrumb-item active">@yield('sub-title')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong> {{ now()->year }} - {{ now()->year + 1 }} &copy; <a href="http://adminlte.io"> جميع الحقوق
                    محفوظة {{ env('APP_NAME') }} </a>.</strong>

            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('cms/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('cms/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 rtl -->
    <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('cms/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('cms/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('cms/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/jqvmap/maps/jquery.vmap.world.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('cms/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    {{-- <script src="{{ asset('cms/plugins/moment/moment.min.j') }}"></script> --}}
    {{-- <script src="{{ asset('cms/plugins/daterangepicker/daterangepicker.js') }}"></script> --}}
    <!-- Tempusdominus Bootstrap 4 -->
    {{-- <script src="{{ asset('cms/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}
    <!-- Summernote -->
    {{-- <script src="{{ asset('cms/plugins/summernote/summernote-bs4.min.js') }}"></script> --}}
    <!-- overlayScrollbars -->
    <script src="{{ asset('cms/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('cms/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('cms/dist/js/pages/dashboard.js') }}"></script> --}}
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('cms/dist/js/demo.js') }}"></script>

    <script src="{{ asset('cms/plugins/toastr/toastr.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{ asset('crudjs/crud.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select22').select2({
                dir: "rtl",
            });
        });
    </script>
    <script>
        const userID = {{ Auth::id() }}

        function Toastar(message, title) {
            toastr["success"](`${message}`, `${title}`, {
                "closeButton": true,
                "debug": true,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-bottom-left",
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "20000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            })
        }
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
