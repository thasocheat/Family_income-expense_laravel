<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img class="img-circle elevation-2" src="{{ asset(Auth::user()->photo) }}" alt="{{ Auth::user()->name }}">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
{{-- userIsAdmin
userIsParent
userIsChild --}}
        {{-- @if(Qs::userIsAdmin())
            <li class="nav-item menu-open">
                <a href="{{ route('dashboard') }}" class="nav-link {{ (Route::is('dashboard')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
                </a>

            </li>
        @elseif(Qs::userIsParent())
            <li class="nav-item menu-open">
                <a href="{{ route('parent_dashboard') }}" class="nav-link {{ (Route::is('parent_dashboard')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
                </a>

            </li>
        @elseif(Qs::userIsChild())
            <li class="nav-item menu-open">
                <a href="{{ route('child_dashboard') }}" class="nav-link {{ (Route::is('child_dashboard')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
                </a>

            </li>
        @endif --}}

        @if(auth()->user()->user_type === 'admin')
            <li class="nav-item menu-open">
                <a href="{{ route('dashboard') }}" class="nav-link {{ (Route::is('dashboard')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
                </a>
            </li>
        @elseif(auth()->user()->user_type === 'parent')
            <li class="nav-item menu-open">
                <a href="{{ route('parent_dashboard') }}" class="nav-link {{ (Route::is('parent_dashboard')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
                </a>
            </li>
        @elseif(auth()->user()->user_type === 'child')
            <li class="nav-item menu-open">
                <a href="{{ route('child_dashboard') }}" class="nav-link {{ (Route::is('child_dashboard')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
                </a>
            </li>
        @endif



        <li class="nav-item">
          <a href="{{ route('account_user') }}" class="nav-link {{ (Route::is('account_user')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Profile
            </p>
          </a>
        </li>

        {{-- User --}}

        @if(Qs::userIsTeamPAT())
        <li class="nav-item">
            {{-- <a href="{{ route('users.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['users.index', 'users.show', 'users.edit']) ? 'active' : '' }}">
                <i class="icon-users4"></i> <span> Users</span>
            </a> --}}

            <a href="{{ route('users.create') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['users.create', 'users.show', 'users.edit']) ? 'active' : '' }}">

            <i class="nav-icon fas fa-copy"></i>
            <p>
              Users
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('users.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>View User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('users.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create User</p>
              </a>
            </li>

          </ul>
        </li>
        @endif

        {{-- Child --}}
        @if(Qs::userIsTeamPA())

            <li class="nav-item">


                {{-- <a href="{{ route('childs.create') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['childs.create', 'childs.show', 'childs.edit']) ? 'active' : '' }}"> --}}
                <a href="#" class="nav-link">

                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                    Child

                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{ route('childs.create') }}" class="nav-link {{ (Route::is('childs.create')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create Child</p>
                    </a>
                    </li>
                    <li class="nav-item">
                        {{-- <a href="{{$url}}" class="nav-link"> --}}

                    <a href="{{ route('my_children') }}" class="nav-link {{ (Route::is('my_children')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View My Child</p>
                    </a>

                    </li>

                </ul>

            </li>

        @endif



        {{-- Income --}}
        <li class="nav-item">
          <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['incomes.index','incomes.create']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Income
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('incomes.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>View Income</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('incomes.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Income</p>
              </a>
            </li>
           

          </ul>
        </li>

         {{-- Expense --}}
         <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Expense
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('income_view')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Expense</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Expense</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Expense Category</p>
                </a>
              </li>

            </ul>
        </li>

        {{-- Income Category --}}
        <li class="nav-item">
            <a href="{{ route('in_category.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['in_category.index','in_category.create']) ? 'active' : '' }}" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Income Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('in_category.index')}}" class="nav-link {{ (Route::is('in_category.index')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('in_category.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Category</p>
                </a>
              </li>


            </ul>
        </li>

         {{-- Expense Category --}}
        <li class="nav-item">
            <a href="{{ route('ex_category.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['ex_category.index','ex_category.create']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Expense Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ex_category.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('ex_category.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Category</p>
                </a>
              </li>
             

            </ul>
        </li>


        {{-- Report --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
            <p>
              Report
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="pages/UI/general.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>General</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/UI/icons.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Icons</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/UI/buttons.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Buttons</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/UI/sliders.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sliders</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/UI/modals.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Modals & Alerts</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/UI/navbar.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Navbar & Tabs</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/UI/timeline.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Timeline</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/UI/ribbons.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ribbons</p>
              </a>
            </li>
          </ul>

        </li>

      

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>










