@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('adminlogin') }}">
                        @csrf

                        <div class="form-group row">
                        	<label for="login_id" class="col-md-4 col-form-label text-md-right">{{ __('아이디') }}</label>
                        	<div class="col-md-6">
                        		<input id="login_id" type="text" class="form-control @error('login_id') is-invalid @enderror"
                                       		name="login_id" value="{{ old('login_id') }}" required autocomplete="login_id" autofocus>

                        		@error('login_id')
                        		<span class="invalid-feedback" role="alert">
                        			<strong>{{ $message }}</strong>
                        		</span>
                        		@enderror
                        	</div>
                        </div>

                        <div class="form-group row">
                            <label for="login_pw" class="col-md-4 col-form-label text-md-right">{{ __('패스워드') }}</label>

                            <div class="col-md-6">
                                <input id="login_pw" type="password" class="form-control @error('login_pw') is-invalid @enderror" name="login_pw" required autocomplete="current-password">

                                @error('login_pw')
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

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
