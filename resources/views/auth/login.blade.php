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
    <div class="col-lg-8 pl-0">
        <div class="login-left">
            <div class="login-left-wrapper">
                <div class="top-login">
                    <h1 class="wow bounceInDown" data-wow-delay="0.2s">Tritact<span>&#174;</span> Gateway™</h1>
                    <h6 class="wow bounceInDown" data-wow-delay="0.3s">Smart ISO management in one platform</h6>
                    <img class="wow bounceInRight" src="{{ asset('images/tritact-intelligent.png') }}" alt="Tritact Intelligent Agent">
                </div>
                <div class="login-content-wrapper">
                    <div class="login-content">
                        <div class="wow bounceInLeft" data-wow-delay="0.1s">
                            <img src="{{ asset('images/login-img-1.png') }}" alt="">
                            <div>
                                <h5>Complete ISO Management System Library</h5>
                                <p>Preloaded templates for ISO 9001, 14001, 45001, 50001 & 27001.</p>
                            </div>
                        </div>
                        <div class="wow bounceInLeft" data-wow-delay="0.5s">
                            <img src="{{ asset('images/login-img-2.png') }}" alt="">
                            <div>
                                <h5>Audit Planner <br>& Tracker</h5>
                                <p>Schedule audits, set reminders, and track findings and actions.</p>
                            </div>
                        </div>
                        <div class="wow bounceInLeft" data-wow-delay="1s">
                            <img src="{{ asset('images/login-img-3.png') }}" alt="">
                            <div>
                                <h5>Tritact® <br>Intellligent Agent™</h5>
                                <p>Al assistant to guide implementation, reviews, and improvements.</p>
                            </div>
                        </div>
                        <div class="wow bounceInLeft" data-wow-delay="0.1s">
                            <img src="{{ asset('images/login-img-4.png') }}" alt="">
                            <div>
                                <h5>All-in-One ISO<br>Compliance Hub</h5>
                                <p>Centralise documents, risks, actions, and ISO records.</p>
                            </div>
                        </div>
                        <div class="wow bounceInLeft" data-wow-delay="0.5s">
                            <img src="{{ asset('images/login-img-5.png') }}" alt="">
                            <div>
                                <h5>Business Planning<br>& Strategic Tools</h5>
                                <p>Generate SWOT, PESTLE, and ISO-aligned business plans.</p>
                            </div>
                        </div>
                        <div class="wow bounceInLeft" data-wow-delay="1s">
                            <img src="{{ asset('images/login-img-6.png') }}" alt="">
                            <div>
                                <h5>Evidence Pack<br>Generator</h5>
                                <p>Build clauses, approvals, and control access easily.</p>
                            </div>
                        </div>
                        <div class="wow bounceInLeft" data-wow-delay="0.1s">
                            <img src="{{ asset('images/login-img-7.png') }}" alt="">
                            <div>
                                <h5>Secure, Scalable &<br>Consultant-Ready</h5>
                            </div>
                        </div>
                        <div class="wow bounceInLeft" data-wow-delay="0.5s">
                            <img src="{{ asset('images/login-img-7.png') }}" alt="">
                            <div>
                                <h5>GDPR-compliant,<br>UK-hosted</h5>
                                <p>Multi-user & whitelabel capable.</p>
                            </div>
                        </div>
                    </div>
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
        <div class="col-8">
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
                        <p class="mb-0" style="color: #000000">
                            To register, email <a href="mailto:support@tritact.co.uk">support@tritact.co.uk</a> or call <a href="tel:+02080773222">02080773222</a>.
                        </p>
                        <!-- /.col -->
                        <div class="col-12 text-center" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-success mt-10" style="height: 50px;width: 140px;border-radius: 10px;background-color: #000000;border: #000000">SIGN IN</button>
                            <div style="margin-top: 15px;">
                                <a href="https://tritact.co.uk" target="_blank">
                                    Visit Tritact Website
                                </a>
                            </div>
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
