@extends('frontend.layouts.app')
@section('title', 'Sign Up')
@section('header-attr') class="nav-shadow" @endsection

@section('content')
    <!-- SignUp Area Starts Here -->
    <section class="signup-area signin-area p-3">
        <div class="container">
            <div class="row align-items-center justify-content-md-center">
                <div class="col-lg-5 order-2 order-lg-0">
                    <div class="signup-area-textwrapper">
                        <h2 class="font-title--md mb-0">Sign Up</h2>
                        <p class="mt-2 mb-lg-4 mb-3">Already have an account? <a href="{{ route('studentLogin') }}" class="text-black-50">Sign In</a></p>

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

                        <form action="{{ route('studentRegister.store', 'studentdashboard') }}" method="POST">
                            @csrf
                            <div class="form-element">
                                <label for="name">Full Name</label>
                                <input type="text" placeholder="Enter Your Name" id="name" value="{{ old('name') }}" name="name" />
                                @if($errors->has('name'))
                                    <small class="d-block text-danger">{{ $errors->first('name') }}</small>
                                @endif
                            </div>
                            <div class="form-element">
                                <label for="email">Email</label>
                                <input type="email" placeholder="example@email.com" id="email" value="{{ old('email') }}" name="email" />
                                @if($errors->has('email'))
                                    <small class="d-block text-danger">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                            <div class="form-element">
                                <label for="password" class="w-100" style="text-align: left;">Password</label>
                                <div class="form-alert-input">
                                    <input type="password" placeholder="Type here..." id="password" name="password"/>
                                    @if($errors->has('password'))
                                        <small class="d-block text-danger">{{ $errors->first('password') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-element">
                                <label for="password_confirmation" class="w-100" style="text-align: left;">Confirm Password</label>
                                <div class="form-alert-input">
                                    <input type="password" placeholder="Type here..." name="password_confirmation" id="password_confirmation" />
                                </div>
                            </div>
                            <div class="form-element d-flex align-items-center terms">
                                <input class="checkbox-primary me-1" type="checkbox" id="agree" />
                                <label for="agree" class="text-secondary mb-0">Accept the <a href="#" style="text-decoration: underline;">Terms</a> and <a href="#" style="text-decoration: underline;">Privacy Policy</a></label>
                            </div>
                            <div class="form-element">
                                <button type="submit" class="button button-lg button--primary w-100">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-7 order-1 order-lg-0">
                    <div class="signup-area-image">
                        <img src="{{ asset('public/frontend/dist/images/signup/Illustration.png') }}" alt="Illustration Image" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SignUp Area Ends Here -->
@endsection
