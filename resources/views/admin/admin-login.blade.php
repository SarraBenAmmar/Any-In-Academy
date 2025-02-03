@extends('frontend.layouts.app')
@section('title', 'Admin Login')
@section('header-attr') class="nav-shadow" @endsection

@section('content')
    <!-- Login Area Starts Here -->
    <section class="login-area signin-area p-3">
        <div class="container">
            <div class="row align-items-center justify-content-md-center">
                <div class="col-lg-5 order-2 order-lg-0">
                    <div class="login-area-textwrapper">
                        <h2 class="font-title--md mb-0">Admin Login</h2>
                        <p class="mt-2 mb-lg-4 mb-3">Don't have an account? <a href="{{ route('admin.register.form') }}" class="text-black-50">Sign Up</a></p>

                        <!-- Affichage des erreurs -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.login.store', 'dashboard') }}" method="POST">
                            @csrf
                            <div class="form-element">
                                <label for="emailAddress">Email</label>
                                <input type="email" placeholder="example@email.com" id="emailAddress" name="email" />
                                @if($errors->has('email'))
                                    <small class="d-block text-danger">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                            <div class="form-element">
                                <label for="password">Password</label>
                                <input type="password" placeholder="Enter Password" id="password" name="password" />
                                @if($errors->has('password'))
                                    <small class="d-block text-danger">{{ $errors->first('password') }}</small>
                                @endif
                            </div>
                            <div class="form-element">
                                <button type="submit" class="button button-lg button--primary w-100">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-7 order-1 order-lg-0">
                    <div class="login-area-image">
                        <img src="{{ asset('public/frontend/dist/images/login/Illustration.png') }}" alt="Illustration Image" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Area Ends Here -->

    @if(session('success'))
        <script>
            window.onload = function() {
                alert('{{ session('success') }}');
            }
        </script>
    @endif
@endsection
