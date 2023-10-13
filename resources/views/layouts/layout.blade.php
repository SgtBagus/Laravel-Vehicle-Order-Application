<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $titlePages }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
    @stack('css')
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        @include('layouts.components.header')
        <div class="content-wrapper">
            <div class="content-header">
              <div class="container">
                <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0"> {{ $titlePages }} </h1>
                  </div>
                  <div class="col-sm-6">
                      @yield('buttonHeader')
                  </div>
                </div>
              </div>
            </div>
            <section class="content">
                <div class="container">
                    @yield('content')
                </div>
            </section>
        </div>
        @include('layouts.components.footer')
    </div>
</body>
<script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>
@stack('js')

</html>
