
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Admin Dashboard</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Icons -->
    {!! Html::style('admin/vendor/nucleo/css/nucleo.css') !!}
    {!! Html::style('admin/vendor/@fortawesome/fontawesome-free/css/all.min.css') !!}
    {!! Html::style('admin/argon.min.css') !!}

</head>

<body>
  <!-- Sidenav -->
  @include('template.demo', ['text' => "รับทำเว็บดูหนังออนไลน์ อะนิเมะ เอวีJAPAN สนใจติดต่อ"])
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="{{ asset($infosetting->logo) }}" class="navbar-brand-img" alt="{{ $infosetting->title }}">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('admin.home') }}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-shop">หน้าแรก</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.movie') }}">
                <i class="ni ni-tv-2 text-orange"></i>
                <span class="nav-link-text">หนังทั้งหมด</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.category') }}">
                <i class="ni ni-tag text-primary"></i>
                <span class="nav-link-text">หมวดหมู่</span>
              </a>
            </li>
            @if(env('SCRIPT_TYPE', '') == "movie" || env('SCRIPT_TYPE', '') == "anime")
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.playlist') }}">
                <i class="ni ni-collection text-danger"></i>
                <span class="nav-link-text">Playlist</span>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.about') }}">
                <i class="ni ni-bullet-list-67 text-primary"></i>
                <span class="nav-link-text">เมนู</span>
              </a>
            </li>
            @if(env('enable_aricle', '0') == '1')
            <li class="nav-item">
              <a href="{{ route('admin.article') }}" class="nav-link">
                <i class="ni ni-book-bookmark text-green"></i>
                <span class="nav-link-text">บทความ</span>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.member') }}">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">รายชื่อผู้ดูแลระบบ</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.banner') }}">
                <i class="ni ni-notification-70 text-default"></i>
                <span class="nav-link-text">โฆษณา</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.seo') }}">
                <i class="ni ni-spaceship text-info"></i>
                <span class="nav-link-text">SEO</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.setting') }}">
                <i class="ni ni-settings text-pink"></i>
                <span class="nav-link-text">ตั้งค่าเว็บ</span>
              </a>
            </li>
            <li class="nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <a class="nav-link" href="{{ route('logout') }}">
                <i class="ni ni-button-powser text-dark"></i>
                <span class="nav-link-text">ออกจากระบบ</span>
                <form action="{{ route('logout') }}" id="logout-form" method="post" style="display:none">
                    {{ csrf_field() }}
                </form>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" action="{{ route('admin.movie.movies_search') }}" method="get" id="navbar-search-main">
            {{ csrf_field() }}
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text" name="title">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>

            <li class="nav-item dropdown">
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">
                <div class="row shortcuts px-4">
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                      <i class="ni ni-calendar-grid-58"></i>
                    </span>
                    <small>Calendar</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                      <i class="ni ni-email-83"></i>
                    </span>
                    <small>Email</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                      <i class="ni ni-credit-card"></i>
                    </span>
                    <small>Payments</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                      <i class="ni ni-books"></i>
                    </span>
                    <small>Reports</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                      <i class="ni ni-pin-3"></i>
                    </span>
                    <small>Maps</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                      <i class="ni ni-basket"></i>
                    </span>
                    <small>Shop</small>
                  </a>
                </div>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->email }}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">

              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0"></h6>
            </div>
          </div>
          <!-- Card stats -->
          
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
            @yield('body')

        </div>
      </div>
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
            </div>
          </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
    {!! Html::script('admin/vendor/jquery/dist/jquery.min.js') !!}
    {!! Html::script('admin/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') !!}
    {!! Html::script('admin/vendor/js-cookie/js.cookie.js') !!}
    {!! Html::script('admin/vendor/jquery.scrollbar/jquery.scrollbar.min.js') !!}
    {!! Html::script('admin/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') !!}
    {!! Html::script('admin/vendor/chart.js/dist/Chart.min.js') !!}
    {!! Html::script('admin/vendor/chart.js/dist/Chart.extension.js') !!}
    {!! Html::script('admin/argon.min.js') !!}
</body>

</html>