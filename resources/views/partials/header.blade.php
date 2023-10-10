<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('frontpage.index')}}" class="nav-link">{{trans('test.Home')}}</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">{{trans('test.Contact')}}</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <?php  $flag = app()->getlocale(); ?>
              <img src="{{asset('images/flags/'.$flag.'.png')}}" class="img-flag" alt="" width="32" height="18">
              &nbsp;{{ strtoupper($flag) }}
        </a>
        <div class="dropdown-menu dropdown-menu-right p-0" style="left: inherit; right: 0px;">
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

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#">

          @if(!empty(Auth::user()->photo) && file_exists(public_path(Auth::user()->photo)))

              <img src="{{  asset(Auth::user()->photo) }}" alt="" srcset="" width="30" height="auto">
              
          @else
              <img src="{{ asset('storage/uploads/default-photo.png') }}" alt="" srcset="" width="30" height="auto">

          @endif

          {{-- <img class="img-circle" width="30" height="auto" src="{{ asset(Auth::user()->photo) }}" alt="{{ Auth::user()->name }}"> --}}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Profile
                </h3>
              </div>
            </div>
            <!-- Message End -->
          </a>

          <div class="dropdown-divider"></div>

          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Setting
                </h3>
              </div>
            </div>
            <!-- Message End -->
          </a>

          <div class="dropdown-divider"></div>

          <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="dropdown-item">
            <!-- Message Start -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>

            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Log Out
                </h3>
              </div>
            </div>
            <!-- Message End -->
          </a>

        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      {{-- <li class="nav-item">
        <a class="nav-link btn btn-info" href="{{route('frontpage.index')}}" role="button">{{ trans('test.Home') }}</a>
      </li> --}}

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>
  </nav>


  {{-- @guest
  @if (Route::has('login'))
  <li class="onhover-dropdown p-0">
      <a class="btn btn-primary-light" href="{{ route('login') }}">Log in
   </a>
  </li>
  @endif

  @if (Route::has('register'))
  <li class="onhover-dropdown p-0">
      <a class="btn btn-primary-light" href="{{ route('register') }}">Register
   </a>
  </li>
  @endif
@else
  <li class="onhover-dropdown p-0">
      <a class="btn btn-primary-light" href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
          <i data-feather="log-out"></i>Log out
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST">
          @csrf
      </form>


  </li>
@endguest --}}
