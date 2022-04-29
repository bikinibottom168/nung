
 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>ADMIMN</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Icons -->
    {!! Html::style('admin/vendor/nucleo/css/nucleo.css') !!}
    {!! Html::style('admin/vendor/@fortawesome/fontawesome-free/css/all.min.css') !!}
    {!! Html::style('admin/argon.min.css') !!}

</head>

<body>
    <div class="row justify-content-md-center h-100">
        <div class="col-lg-4">
            <div class="login-main">
                <h3 style="margin-bottom: 20px">สมาชิกเข้าสู่ระบบ</h3>
                <form class="" action="{{ route('login') }}" method="post">
                    {{ csrf_field() }}
                    @if(session()->has('message_login'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                           <strong style="text-align: left">Username หรือ Password ผิดพลาด</strong>
                        </div>
                    @endif
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="email" class="form-control" placeholder="อีเมล์" id="username" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <input type="password" id="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary my-4" >
                            เข้าสู่ระบบ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
  