<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $titlePages }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('/') }}dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            @include('dashboard.layouts.components.header')
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            @include('dashboard.layouts.components.sidebar')
        </aside>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> {{ $titlePages }} </h1>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
        @include('dashboard.layouts.components.footer')
    </div>
</body>
<script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/') }}dist/js/adminlte.js"></script>
@stack('js')

</html>
