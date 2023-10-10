@extends('layouts.login')
@section('page_title', 'Log In')

@section('log_in')

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt >
					<img src="{{asset('logins/images/img-01.png')}}" alt="IMG" >
				</div>

				<form class="login100-form validate-form"  method="POST" action="{{ route('register') }}">
                    @csrf

					<span class="login100-form-title">
						{{trans('test.Register')}}
					</span>

                    {{--  name--}}
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input
                            id="name" type="text" class="input100 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus  placeholder="Username"
                            >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>

                        @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror

					</div>
                    {{-- email --}}
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input
                            id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email address"
                        >
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
                    {{-- password --}}
					<div class="wrap-input100 validate-input @error('password') is-invalid @enderror" data-validate = "Password is required">
						<input
                            id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
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
                    {{-- confirm password --}}
                    <div class="wrap-input100 validate-input @error('password') is-invalid @enderror" data-validate = "Password is required">
						<input
                            id="password-confirm" type="password" class="input100" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm-Password">
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
                    {{-- sign in btn --}}
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							{{trans('test.Sign up')}}
						</button>
					</div>


					<div class="text-center p-t-50">

                        <a href="{{ url('frontpage') }}" class="btn text-success btn-warning btn-sm mr-2 ">Home</a>

						<a class="txt2" href="{{ route('login') }}">
							Already Logged In
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection
