@extends('layouts.app')
@section('title', 'Login ')
@section('content')
<style>
    body{
        background-image: url({{ asset('images/login-bg.png') }});
    }
    .login-logo img {
        width: 250px;
        margin: 0 auto;
        display: block;
    }

    .login-logo {
        margin-top: 20px;
    }
    button.btn.btn-success:hover {
        background-color: #85d763bf !important;
        color: black !important;
    }
</style>
<div class="row justify-content-center no-gutters">
    <div class="col-lg-8">
        <div class="login-left">
            <h1>Tritact<span>&#174;</span> Gateway</h1>
            <h6>Smart ISO management in one platform</h6>
            <div class="login-content-wrapper">
                <div class="login-content">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-5 col-12" style="
    background: rgba(255, 255, 255, 0.2);
    border-radius: 0;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    height: 100vh;
/* From https://css.glass */
    background: rgba(255, 255, 255, 0.5);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    
">
    <div class="login-form-wrapper">
        <div class="">
            <div class="login-logo">
                <img src="{{ asset('images/login-logo.png') }}" alt="logo">
            </div>
            <div class="content-top-agile p-20 pb-0">
                <h2 style="color: #000000;">Let's Get Started</h2>
                <p class="mb-0">Sign in to {!! config('app.name', 'Laravel') !!}</p>
            </div>
            <div class="p-20">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="input-group mb-4" style="height: 45px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent" style="border-color: #000000;">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input style="border-color: #000000;" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address" autofocus> 
                        </div>
                        @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-4" style="height: 45px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent" style="border-color: #000000;">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input style="border-color: #000000;" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        </div>
                        @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="checkbox">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">Remember Me</label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-12 text-center" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-success mt-10" style="height: 50px;width: 140px;border-radius: 10px;background-color: #000000;border: #000000">SIGN IN</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
