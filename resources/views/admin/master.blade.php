<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Adminstation</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <link href="{{ asset('admin/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('admin/assets/js/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset("admin/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("admin/assets/css/plugins.css") }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('admin/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="remember-token" content="{{ Auth::user()->remember_token }}" />

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('admin/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('admin/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css">
    <script src="https://cdn.jsdelivr.net/gh/artf/grapick@master/dist/grapick.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/artf/grapick@master/dist/grapick.min.css">
{{-- <script>
    $(document).ready(function() {
        App.init();
    });
</script> --}}

</head>

{{-- <body {{ ($has_scrollspy) ? scrollspy($scrollspy_offset) : '' }} class=" {{ ($page_name === 'alt_menu') ? 'alt-menu' : '' }} {{ ($page_name === 'error404') ? 'error404 text-center' : '' }} {{ ($page_name === 'error500') ? 'error500 text-center' : '' }} {{ ($page_name === 'error503') ? 'error503 text-center' : '' }} {{ ($page_name === 'maintenence') ? 'maintanence text-center' : '' }}"> --}}
<body>
  <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
      <div class="spinner-grow align-self-center"></div>
  </div></div></div>    
  <!--  END LOADER -->
  <!-- Sidenav -->
  @include('template.demo', ['text' => "รับทำเว็บดูหนังออนไลน์ อะนิเมะ เอวีJAPAN สนใจติดต่อ"])

  @include('admin.inc.navbar')

  <!--  BEGIN MAIN CONTAINER  -->
  <div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    @include('admin.inc.sidebar')
    
    <!--  BEGIN CONTENT PART  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
              @yield('body')
            </div>

        </div>

    </div>
    <!--  END CONTENT PART  -->

</div>
<!-- END MAIN CONTAINER -->

{{-- <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('admin/plugins/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/dashboard/dash_2.js') }}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

  <!-- Argon Scripts -->
  <!-- Core -->
    {!! Html::script('admin/vendor/jquery/dist/jquery.min.js') !!}
    {!! Html::script('admin/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') !!}
    {!! Html::script('admin/vendor/js-cookie/js.cookie.js') !!}
    {!! Html::script('admin/vendor/jquery.scrollbar/jquery.scrollbar.min.js') !!}
    {!! Html::script('admin/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') !!}
    {!! Html::script('admin/vendor/chart.js/dist/Chart.min.js') !!}
    {!! Html::script('admin/vendor/chart.js/dist/Chart.extension.js') !!}
    {!! Html::script('admin/argon.min.js') !!} --}}

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    {{-- <script src="{{ asset('admin/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('admin/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.js') }}"></script> --}}
    
    {{-- <script>
        $(document).ready(function() {
            App.init();
        });
    </script> --}}
    <script src="{{ asset('admin/plugins/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('admin/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap-touchspin/custom-bootstrap-touchspin.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>