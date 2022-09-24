@extends('layouts.auth')

@section('content')
<div class="card">
    <div class="card-body p-4">
        <div class="text-center">
            <a href="index.html" class="">
                <img src="{{ asset('images/logo-dark.png') }}" alt="" height="24" class="auth-logo logo-dark mx-auto">
                <img src="{{ asset('images/logo-light.png') }}" alt="" height="24" class="auth-logo logo-light mx-auto">
            </a>
        </div>
        
        <h4 class="font-size-18 text-muted text-center mt-2">Login</h4>
        <form class="form-horizontal" action="{{ route('login') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-4">
                        <label class="form-label" for="useremail">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="useremail" placeholder="Enter email">        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="userpassword">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="userpassword" placeholder="Enter password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="term-conditionCheck" name="remember" {{ old('remember') ? 'checked' : '' }} {{ old("remember") ? "checked" : "" }}>
                        <label class="form-check-label fw-normal" for="term-conditionCheck">Remember Me</label>
                    </div>
                    <div class="d-grid mt-4">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
    <div class="mt-5 text-center">
    <p class="text-white-50">© <script>document.write(new Date().getFullYear())</script> E-Shopper. <i class="mdi mdi-heart text-danger"></i> by Aldi Yunan Anwari</p>
    </div>
@endsection
