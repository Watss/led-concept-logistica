<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Led Concept</title>
    @livewireStyles
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    @include('sweetalert::alert')
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle" style="color: rgba(0,0,0,0.5); !default;"> <img
                            src="https://www.ledconcept.cl/new/wp-content/uploads/2018/02/Logo-led-concept.png"
                            width="40" alt=""> Led Concept</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Administración
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/dashboard">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('clients*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('clients.index') }}">
                            <i class="fas fa-users"></i> <span class="align-middle">Clientes</span>
                        </a>
                    </li>

                    @can('user:index')
                    <li class="sidebar-item {{ Request::is('users*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('users.index') }}">
                            <i class="fas fa-users-cog"></i> <span class="align-middle">Usuarios</span>
                        </a>
                    </li>
                    @endcan


                    <li class="sidebar-item {{ Request::is('products*') ? 'active' : '' }}">
                        <a class="sidebar-link " href="{{ route('products.index') }}">
                            <i class="fas fa-boxes"></i> <span class="align-middle">Productos</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::is('budget/*') ? 'active' : '' }}">
                        <a class="sidebar-link " href="{{ route('budget.index') }}">
                            <i class="fas fa-briefcase"></i> <span class="align-middle">Cotizaciones</span>
                        </a>
                    </li>



                    <li class="sidebar-header">
                        Configuración
                    </li>

                    @can('reports:clients')
                    <li class="sidebar-item {{ Request::is('reports/client*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('reports.client') }}">
                            <i class="align-middle" data-feather="check-square"></i> <span
                                class="align-middle">Reporte Clientes</span>
                        </a>
                    </li>
                    @endcan



                    @can('budget-status:index')
                    <li class="sidebar-item {{ Request::is('budget-status*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('budget-status.index') }}">
                            <i class="align-middle" data-feather="check-square"></i> <span
                                class="align-middle">Estados de cotizaciones</span>
                        </a>
                    </li>
                    @endcan

                </ul>


            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg" style="padding: 5px 10px 5px 10px;">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">

                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?rounded=true&size=32&name={{Auth::user()->name }}"
                                    class=" img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">
                                    {{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item " href="{{ route('logout') }}" onclick="event.preventDefault();
        							document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @method('post')
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    {{ $slot }}

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Adx
                                        Technology</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <!-- <li class="list-inline-item">
         <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
        </li>
        <li class="list-inline-item">
         <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
        </li>
        <li class="list-inline-item">
         <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
        </li> -->
                                {{-- <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Ayuda</a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @stack('scripts')
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
