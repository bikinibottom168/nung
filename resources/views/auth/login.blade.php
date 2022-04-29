<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{asset('admin/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('admin/assets/css/main.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/forms/switches.css')}}">
    <style>
        .form-form .form-form-wrap form .field-wrapper svg.feather-eye {
            top: 46px;
        }
    </style>

    {!! NoCaptcha::renderJs() !!}
</head>

<body>
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Sign In</h1>
                        <p class="">Log in to Admin Dashboard</p>
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                <strong class="text-danger">โปรดยืนยัน reCAPTCHA</strong>
                            </span>
                        @endif
                        <form method="POST" action="{{ route('login') }}" class="text-left">

                            @csrf

                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">Adminstation</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="email" type="text" placeholder="Staff" class="form-control " name="email" required autocomplete="email" autofocus>
                                    
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" placeholder="Password"  class="form-control " name="password" required autocomplete="current-password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">{{ __('Login') }}</button>
                                    </div>
                                </div>
                                <br>
                                @if(option_get('recaptcha.status') == "1")
                                <div class="d-sm-flex justify-content-between">
                                    {!! NoCaptcha::display() !!}
                                </div>
                                @endif
                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{asset('admin/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('admin/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/authentication/form-2.js')}}"></script>
</body>

</html>
  