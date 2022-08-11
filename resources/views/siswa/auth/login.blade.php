<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Siswa</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/styles/css/themes/lite-purple.min.css')}}">
</head>

<body>
<div class="auth-layout-wrap" style="background-color: #639">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4">
                            <img src="{{asset('images/logo-smp.png')}}" alt="">
                        </div>
                        <h1 class="mb-3 text-18">Siswa Login</h1>
                        <form method="POST" action="{{route('siswa.login')}}">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username"
                                       class="form-control form-control-rounded @error('username') is-invalid @enderror"
                                       name="username" value="{{ old('username') }}" required autocomplete="username"
                                       autofocus>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password"
                                       class="form-control form-control-rounded @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <div class="">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-rounded btn-primary btn-block mt-2">Sign In</button>

                        </form>
                        @if (Route::has('password.request'))

                            <div class="mt-3 text-center">

                                <a href="{{ route('password.request') }}" class="text-muted"><u>Forgot
                                        Password?</u></a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/common-bundle-script.js')}}"></script>

<script src="{{asset('assets/js/script.js')}}"></script>
</body>

</html>
