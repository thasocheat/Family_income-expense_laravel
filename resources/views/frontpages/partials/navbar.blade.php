  <header class="navigation bg-tertiary">
	<nav class="navbar navbar-expand-xl navbar-light text-center py-3">
		<div class="container">
			<a class="navbar-brand" href="{{route('frontpage.index')}}">
				<img loading="prelaod" decoding="async" class="img-fluid" width="100" src="/logo.png" alt="Wallet">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mx-auto mb-2 mb-lg-0">
					<li class="nav-item"> <a class="nav-link" href="{{route('frontpage.index')}}">{{trans('test.Home')}}</a>
					</li>
					<li class="nav-item "> <a class="nav-link" href="{{route('frontpage.about')}}">{{trans('test.About')}}</a>
					</li>
					</li>
					<li class="nav-item "> <a class="nav-link" href="{{route('frontpage.contact')}}">{{trans('test.Contact')}}</a>
					</li>

                    <li class="nav-item dropdown">

                        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                            <?php  $flag = app()->getlocale(); ?>
                              <img src="{{asset('images/flags/'.$flag.'.png')}}" class="img-flag" alt="" width="32" height="18">
                              &nbsp;{{ strtoupper($flag) }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-2" style="left: inherit; right: 0px;">
                          <a href="{{url('lang/en')}}" class="dropdown-item {{ App::getLocale() == 'en' ? 'active' : ''}}">
                            <img src="{{asset('images/flags/en.png')}}" class="img-flag" alt="" width="32" height="18">
                            English
                          </a>
                          <a href="{{url('lang/kh')}}" class="dropdown-item {{ App::getLocale() == 'kh' ? 'active' : ''}}">
                            <img src="{{asset('images/flags/kh.png')}}" class="img-flag" alt="" width="32" height="18">

                            Khmer
                          </a>
                        </div>
                      </li>

				</ul>

                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">{{trans('test.Log in')}}</a>

                    <a href="{{ route('register') }}" class="btn btn-primary ms-2 ms-lg-3">{{trans('test.Sign up')}}</a>
                @endguest

                @auth
                    <a href="{{ route('home') }}" class="btn btn-primary ms-2 ms-lg-3">{{trans('test.Dashboard')}}</a>
                @endauth

			</div>
		</div>
	</nav>
</header>
