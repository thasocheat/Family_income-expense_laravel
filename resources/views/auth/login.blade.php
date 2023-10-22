@extends('layouts.login')
@section('page_title', 'Log In')

@section('log_in')

	<div class="limiter">
		<div class="container-login100">

			<div class="wrap-login100">

				<div class="login100-pic js-tilt" data-tilt >
					<img src="{{asset('logins/images/img-01.png')}}" alt="IMG" >
				</div>

				<form class="login100-form validate-form"  method="POST" action="{{ route('login') }}">
                    @csrf

					<span class="login100-form-title">
						Login to Access
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100 @error('email')
                        is-invalid @enderror"
                            name="email"
                            type="email"
                            required=""
                            placeholder="Email"
                            value="{{ old('email') }}"
                            required autocomplete="email"
                            autofocus>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>



                        @error('email')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                           @enderror
					</div>

					<div class="wrap-input100 validate-input " data-validate = "Password is required">
						<input class="input100 @error('password') is-invalid @enderror"
                            placeholder="Password"
                            type="password"
                            name="password"
                            required="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							{{trans('test.Sign in')}}
						</button>
					</div>

					<div class="text-center p-t-12">

                          <div class="checkbox">

                              @if (Route::has('password.request'))
                                  <a class="link" href="{{ route('password.request') }}">Forgot password?</a>
                              @endif

                          </div>

					</div>



					<div class="text-center p-t-136">
                        <a href="{{ url('frontpage') }}" class="btn text-success btn-warning btn-sm mr-2 ">Home</a>

						<a class="txt2" href="{{ route('register') }}">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection





