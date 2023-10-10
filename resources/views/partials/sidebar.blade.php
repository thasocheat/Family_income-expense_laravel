<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @if(!empty(Auth::user()->photo) && file_exists(public_path(Auth::user()->photo)))


          <img src="{{  asset(Auth::user()->photo) }}" alt="" srcset="" width="30" height="auto">
        @else
          <img src="{{ asset('storage/uploads/default-photo.png') }}" alt="" srcset="" width="30" height="auto">

        @endif

      </div>

      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="{{trans('test.Search')}}" aria-label="Search">
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
                    {{ trans('test.Dashboard') }}
                </p>
                </a>
            </li>
        @elseif(auth()->user()->user_type === 'parent')
            <li class="nav-item menu-open">
                <a href="{{ route('parent_dashboard') }}" class="nav-link {{ (Route::is('parent_dashboard')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    {{ trans('test.Dashboard') }}
                </p>
                </a>
            </li>
        @elseif(auth()->user()->user_type === 'child')
            <li class="nav-item menu-open">
                <a href="{{ route('child_dashboard') }}" class="nav-link {{ (Route::is('child_dashboard')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    {{ trans('test.Dashboard') }}
                </p>
                </a>
            </li>
        @endif



        <li class="nav-item">
          <a href="{{ route('account_user') }}" class="nav-link {{ (Route::is('account_user')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
                {{trans('test.Profile')}}
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

                <i class="nav-icon fas fa-users"></i>
                <p>
                    {{trans('test.Users')}}

                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ trans('test.View User') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('users.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ trans('test.Create User') }}</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('childs.create') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['childs.create', 'childs.show', 'childs.edit']) ? 'active' : '' }}">

                <i class="nav-icon fas fa-user-tag"></i>
                <p>
                    {{trans('test.Child')}}

                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{ route('childs.create') }}" class="nav-link {{ (Route::is('childs.create')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ trans('test.Create Child') }}</p>
                </a>
                </li>
            </ul>

          </li>

          <li class="nav-item">
              <a href=" " class="nav-link {{ in_array(Route::currentRouteName(), ['members.create', 'members.show', 'members.edit']) ? 'active' : '' }}">

              <i class="nav-icon fa fa-image"></i>
              <p>
                  {{trans('test.Setting')}}

                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{ route('members.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ trans('test.View Member') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=" {{ route('members.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ trans('test.Create Member') }}</p>
                </a>
              </li>

            </ul>
          </li>
        @endif


         {{-- Members Setting --}}

         {{-- @if(Qs::userIsTeamPAT())
         <li class="nav-item">
             <a href=" " class="nav-link {{ in_array(Route::currentRouteName(), ['members.create', 'members.show', 'members.edit']) ? 'active' : '' }}">

             <i class="nav-icon fas fa-copy"></i>
             <p>
                 {{trans('test.Setting')}}

               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href=" {{ route('members.index') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>{{ trans('test.View Member') }}</p>
               </a>
             </li>
             <li class="nav-item">
               <a href=" {{ route('members.create') }}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>{{ trans('test.Create Member') }}</p>
               </a>
             </li>

           </ul>
         </li>
         @endif --}}


        {{-- @if(Qs::userIsTeamPAT())

            <li class="nav-item">


                <a href="{{ route('childs.create') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['childs.create', 'childs.show', 'childs.edit']) ? 'active' : '' }}">
                <a href="#" class="nav-link">

                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        {{trans('test.Child')}}


                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{ route('childs.create') }}" class="nav-link {{ (Route::is('childs.create')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ trans('test.Create Child') }}</p>
                    </a>
                    </li>


                </ul>

            </li>

        @endif --}}

        {{-- Child --}}
        @if(Qs::userIsTeamPA())

            <li class="nav-item">


                {{-- <a href="{{ route('childs.create') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['childs.create', 'childs.show', 'childs.edit']) ? 'active' : '' }}"> --}}
                <a href="#" class="nav-link">

                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        {{trans('test.Child')}}


                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{ route('childs.create') }}" class="nav-link {{ (Route::is('childs.create')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ trans('test.Create Child') }}</p>
                    </a>
                    </li>
                    <li class="nav-item">
                        {{-- <a href="{{$url}}" class="nav-link"> --}}

                    <a href="{{ route('my_children') }}" class="nav-link {{ (Route::is('my_children')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ trans('test.View My Child') }}</p>
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
                {{trans('test.Income')}}

              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('incomes.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ trans('test.View Income') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('incomes.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ trans('test.Create Income') }}</p>
              </a>
            </li>


          </ul>
        </li>

         {{-- Expense --}}
         <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                {{trans('test.Expense')}}

                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('expenses.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ trans('test.View Expense') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('expenses.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ trans('test.Create Expense') }}</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Expense Category</p>
                </a>
              </li> --}}

            </ul>
        </li>

        {{-- Income Category --}}
        <li class="nav-item">
            <a href="{{ route('in_category.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['in_category.index','in_category.create']) ? 'active' : '' }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                {{trans('test.Income Category')}}

                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('in_category.index')}}" class="nav-link {{ (Route::is('in_category.index')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ trans('test.View Category') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('in_category.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ trans('test.Create Category') }}</p>
                </a>
              </li>


            </ul>
        </li>

         {{-- Expense Category --}}
        <li class="nav-item">
            <a href="{{ route('ex_category.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['ex_category.index','ex_category.create']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                {{trans('test.Expense Category')}}

                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ex_category.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ trans('test.View Category') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('ex_category.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ trans('test.Create Category') }}</p>
                </a>
              </li>


            </ul>
        </li>


        {{-- Report --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-flag"></i>
            <p>
                {{trans('test.Reports')}}

              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('show.weekly') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ trans('test.Weekly Report') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('show.monthly') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ trans('test.Monthly Report') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('view.yearly') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ trans('test.Yearly Report') }}</p>
              </a>
            </li>
          </ul>

        </li>



      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>










