@extends('master')

@section("title", "Login")

@section("content")
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('signIn') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('signIn') }}">
                        {{-- @method('POST') --}}
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="container-fluid w-50 my-auto">

    <div class="row">
        <div class="col text-center">
        <img src="/Assets/Logo.png" class="w-50 justify-content-center" alt="">
        </div>
    </div>

    <h3>Login page</h3>

    <form method="POST" action="{{ route('signIn') }}" class="justify-content-center">
        {{-- @method('POST') --}}
        @csrf
        <div class="form-group pb-3">
            <label for="email" class="">{{ __('E-Mail Address') }}</label>

            <div class="">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Cookie::get('remember_email') }}" autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group pb-2">
            <label for="password" class="">{{ __('Password') }}</label>

            <div class="">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group pb-3">
            <div class="">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group ">
            <div class="pb-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
                <a href="/register" class="btn btn-primary mx-4">Register</a>

            </div>
            @if ($errors->any())
                @if ($errors->first() == "Wrong Credentials")
                    <p style="color: red">{{ $errors->first() }}</p>
                @endif
            @endif
        </div>
    </form>
</div>

@if (session('alert'))
    <script>
        alert('Please Log In To Add To Cart');
    </script>
@elseif (session('profile'))
    <script>
        alert('Please Sign In to access profile page!');
    </script>
@endif
@endsection
