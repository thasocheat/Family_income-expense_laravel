<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img class="img-circle elevation-2" src="{{ Auth::user()->photo }}" alt="{{ Auth::user()->name }}">
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

        <li class="nav-item menu-open">
          <a href="{{ route('dashboard') }}" class="nav-link {{ (Route::is('dashboard')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>

        </li>

        <li class="nav-item">
          <a href="{{ route('account_user') }}" class="nav-link {{ (Route::is('account_user')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Profile
            </p>
          </a>
        </li>

        {{-- User --}}

        @if(Qs::userIsTeamPA())
        <li class="nav-item">
            {{-- <a href="{{ route('users.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['users.index', 'users.show', 'users.edit']) ? 'active' : '' }}">
                <i class="icon-users4"></i> <span> Users</span>
            </a> --}}

          <a href="{{ route('users.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['users.index', 'users.show', 'users.edit']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Users
              {{-- <i class="fas fa-angle-left right"></i> --}}
            </p>
          </a>
          {{-- <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="pages/layout/top-nav.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>View User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create User</p>
              </a>
            </li>

          </ul> --}}
        </li>
        @endif


        {{-- Income --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Income
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('income_view')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>View Income</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/charts/flot.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Flot</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/charts/inline.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inline</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/charts/uplot.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>uPlot</p>
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
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/uplot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>uPlot</p>
                </a>
              </li>
            </ul>
        </li>



        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
            <p>
              UI Elements
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

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Forms
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="pages/forms/general.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>General Elements</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/forms/advanced.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Advanced Elements</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/forms/editors.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Editors</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/forms/validation.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Validation</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Tables
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="pages/tables/simple.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Simple Tables</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/tables/data.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>DataTables</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/tables/jsgrid.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>jsGrid</p>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>









{{-- <header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="{{ route('account_user') }}"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{ Auth::user()->photo }}" alt="{{ Auth::user()->name }}" />
        <div class="badge-bottom"><span class="badge badge-primary">New</span></div>
        <a href="user-profile"> <h6 class="mt-3 f-14 f-w-600">{{ Auth::user()->name }}</h6></a>
        <p class="mb-0 font-roboto">{{ Auth::user()->email }}</p>
        <i class="fa-angles-down font-size-sm"></i> &nbsp;{{ ucwords(str_replace('_', ' ', Auth::user()->user_type)) }}


    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa-angles-down ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>General</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title active" href="javascript:void(0)"><i data-feather="home"></i><span>Dashboard</span></a>
                        <ul class="nav-submenu menu-content" style="display: block;">
                            <li><a href="https://laravel.pixelstrap.com/viho/dashboard" class="active">Default</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/dashboard/dashboard-02" class="">Ecommerce</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="airplay"></i><span>Widgets</span></a>
                        <ul class="nav-submenu menu-content"  style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/widgets/general-widget" class="">General</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/widgets/chart-widget" class="">Chart</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="layout"></i><span>Page layout</span></a>
                        <ul class="nav-submenu menu-content"  style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/page-layout/boxed-layout" class="">Boxed</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/page-layout/layout-rtl" class="">RTL</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/page-layout/layout-dark" class="">Dark</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/page-layout/footer-light" class="">Footer Light</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/page-layout/footer-dark" class="">Footer Dark</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/page-layout/footer-fixed" class="">Footer Fixed</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Components</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="box"></i><span>Ui Kits</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/state-color" class="">State color</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/typography" class="">Typography</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/avatars" class="">Avatars</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/helper-classes" class="">helper classes</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/grid" class="">Grid</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/tag-pills" class="">Tag & pills</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/progress-bar" class="">Progress</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/modal" class="">Modal</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/alert" class="">Alert</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/popover" class="">Popover</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/tooltip" class="">Tooltip</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/loader" class="">Spinners</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/dropdown" class="">Dropdown</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/according" class="">Accordion</a></li>
                            <li>
                                <a class="submenu-title  " href="javascript:void(0)">
                                    Tabs<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span>
                                </a>
                                <ul class="nav-sub-childmenu submenu-content" style="display: none;">
                                    <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/tab-bootstrap" class="">Bootstrap Tabs</a></li>
                                    <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/tab-material" class="">Line Tabs</a></li>
                                </ul>
                            </li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/navs" class="">Navs</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/box-shadow" class="">Shadow</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ui-kits/list" class="">Lists</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="folder-plus"></i><span>Bonus Ui</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/scrollable" class="">Scrollable</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/tree" class="">Tree view</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/bootstrap-notify" class="">Bootstrap Notify</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/rating" class="">Rating</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/dropzone" class="">dropzone</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/tour" class="">Tour</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/sweet-alert2" class="">SweetAlert2</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/modal-animated" class="">Animated Modal</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/owl-carousel" class="">Owl Carousel</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/ribbons" class="">Ribbons</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/pagination" class="">Pagination</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/steps" class="">Steps</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/breadcrumb" class="">Breadcrumb</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/range-slider" class="">Range Slider</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/image-cropper" class="">Image cropper</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/sticky" class="">Sticky </a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/basic-card" class="">Basic Card</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/creative-card" class="">Creative Card</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/tabbed-card" class="">Tabbed Card</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/dragable-card" class="">Draggable Card</a></li>
                            <li>
                                <a class="submenu-title " href="javascript:void(0)">
                                    Timeline<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span>
                                </a>
                                <ul class="nav-sub-childmenu submenu-content" style="display: none;">
                                    <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/timeline-v-1" class="">Timeline 1</a></li>
                                    <li><a href="https://laravel.pixelstrap.com/viho/bonus-ui/timeline-v-2" class="">Timeline 2</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="edit-3"></i><span>Builders</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/builders/form-builder-1" class="">Form Builder 1</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/builders/form-builder-2" class="">Form Builder 2</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/builders/pagebuild" class="">Page Builder</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/builders/button-builder" class="">Button Builder</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="cloud-drizzle"></i><span>Animation</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/animation/animate" class="">Animate</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/animation/scroll-reval" class="">Scroll Reveal</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/animation/aos" class="">AOS animation</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/animation/tilt" class="">Tilt Animation</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/animation/wow" class="">Wow Animation</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="command"></i><span>Icons</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/icons/flag-icon" class="">Flag icon</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/icons/font-awesome" class="">Fontawesome Icon</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/icons/ico-icon" class="">Ico Icon</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/icons/themify-icon" class="">Thimify Icon</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/icons/feather-icon" class="">Feather icon</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/icons/whether-icon" class="">Whether Icon </a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="cloud"></i><span>Buttons</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/buttons/buttons" class="">Default Style</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/buttons/buttons-flat" class="">Flat Style</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/buttons/buttons-edge" class="">Edge Style</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/buttons/raised-button" class="">Raised Style</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/buttons/button-group" class="">Button Group</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="bar-chart"></i><span>Charts</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/charts/chart-apex" class="">Apex Chart</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/charts/chart-google" class="">Google Chart</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/charts/chart-sparkline" class="">Sparkline chart</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/charts/chart-flot" class="">Flot Chart</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/charts/chart-knob" class="">Knob Chart</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/charts/chart-morris" class="">Morris Chart</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/charts/chartjs" class="">Chatjs Chart</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/charts/chartist" class="">Chartist Chart</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/charts/chart-peity" class="">Peity Chart</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Forms</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="sliders"></i><span>Form Controls </span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/form-controls/form-validation" class="">Form Validation</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-controls/base-input" class="">Base Inputs</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-controls/radio-checkbox-control" class="">Checkbox & Radio</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-controls/input-group" class="">Input Groups</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-controls/megaoptions" class="">Mega Options </a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="package"></i><span>Form Widgets</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/form-widgets/datepicker" class="">Datepicker</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-widgets/time-picker" class="">Timepicker</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-widgets/datetimepicker" class="">Datetimepicker</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-widgets/daterangepicker" class="">Daterangepicker</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-widgets/touchspin" class="">Touchspin</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-widgets/select2" class="">Select2</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-widgets/switch" class="">Switch</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-widgets/typeahead" class="">Typeahead</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-widgets/clipboard" class="">Clipboard </a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="layout"></i><span>Form layout</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/form-layout/default-form" class="">Default Forms</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-layout/form-wizard" class="">Form Wizard 1</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-layout/form-wizard-two" class="">Form Wizard 2</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/form-layout/form-wizard-three" class="">Form Wizard 3</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Table</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="server"></i><span>Bootstrap Tables </span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/bootstrap-tables/bootstrap-basic-table" class="">Basic Tables</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bootstrap-tables/bootstrap-sizing-table" class="">Sizing Tables</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bootstrap-tables/bootstrap-border-table" class="">Border Tables</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bootstrap-tables/bootstrap-styling-table" class="">Styling Tables</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/bootstrap-tables/table-components" class="">Table components</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="database"></i><span>Data Tables </span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/data-tables/datatable-basic-init" class="">Basic Init</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/data-tables/datatable-advance" class="">Advance Init</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/data-tables/datatable-styling" class="">Styling</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/data-tables/datatable-AJAX" class="">AJAX</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/data-tables/datatable-server-side" class="">Server Side</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/data-tables/datatable-plugin" class="">Plug-in</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/data-tables/datatable-API" class="">API</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/data-tables/datatable-data-source" class="">Data Sources</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="hard-drive"></i><span>Ex. Data Tables </span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/ex-data-tables/datatable-ext-autofill" class="">Auto Fill</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ex-data-tables/datatable-ext-basic-button" class="">Basic Button</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ex-data-tables/datatable-ext-col-reorder" class="">Column Reorder</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ex-data-tables/datatable-ext-fixed-header" class="">Fixed Header</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ex-data-tables/datatable-ext-key-table" class="">Key Table</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ex-data-tables/datatable-ext-responsive" class="">Responsive</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ex-data-tables/datatable-ext-row-reorder" class="">Row Reorder</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ex-data-tables/datatable-ext-scroller" class="">Scroller </a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/jsgrid-table"><i data-feather="file-text"></i><span>Js Grid Table</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Applications</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="box"></i><span>Project </span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/project/projects" class="">Project List</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/project/projectcreate" class="">Create new </a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/file-manager"><i data-feather="git-pull-request"></i><span>File manager</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/kanban"><i data-feather="monitor"></i><span>Kanban Board</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="shopping-bag"></i><span>Ecommerce</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/ecommerce/product" class="">Product</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ecommerce/product-page" class="">Product page</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ecommerce/list-products" class="">Product list</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ecommerce/payment-details" class="">Payment Details</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ecommerce/order-history" class="">Order History</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ecommerce/invoice-template" class="">Invoice</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ecommerce/cart" class="">Cart</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ecommerce/list-wish" class="">Wishlist</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ecommerce/checkout" class="">Checkout</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/ecommerce/pricing" class="">Pricing</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="mail"></i><span>Email</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/email/email_inbox" class="">Mail Inbox</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/email/email_read" class="">Read mail</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/email/email_compose" class="">Compose</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="message-circle"></i><span>Chat</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/chat/chat" class="">Chat App</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/chat/chat-video" class="">Video chat</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="users"></i><span>Users</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/users/user-profile" class="">Users Profile</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/users/edit-profile" class="">Users Edit</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/users/user-cards" class="">Users Cards</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/bookmark"><i data-feather="heart"></i><span>Bookmarks</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/contacts"><i data-feather="list"></i><span>Contacts</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/task"><i data-feather="check-square"></i><span>Tasks</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/calendar-basic"><i data-feather="calendar"></i><span>Calender </span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/social-app"><i data-feather="zap"></i><span>Social App</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/to-do"><i data-feather="clock"></i><span>To-Do</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/search"><i data-feather="search"></i><span>Search Result</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Pages</h6>
                        </div>
                    </li>
                    <li>

                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/sample-page"><i data-feather="file"></i><span>Sample page</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/internationalization"><i data-feather="aperture"></i><span>Internationalization</span></a>
                    </li>
                    <li class="mega-menu">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="layers"></i><span>Others</span></a>
                        <div class="mega-menu-container menu-content" style="display: none;">
                            <div class="container">
                                <div class="row">
                                    <div class="col mega-box">
                                        <div class="link-section">
                                            <div class="submenu-title">
                                                <h5>Error Page</h5>
                                            </div>
                                            <div class="submenu-content opensubmegamenu">
                                                <ul>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/error-page1" class="" target="_blank">Error page 1</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/error-page2" class="" target="_blank">Error page 2</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/error-page3" class="" target="_blank">Error page 3</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/error-page4" class="" target="_blank">Error page 4 </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mega-box">
                                        <div class="link-section">
                                            <div class="submenu-title">
                                                <h5>Authentication</h5>
                                            </div>
                                            <div class="submenu-content opensubmegamenu">
                                                <ul>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/login" class="" target="_blank">Login Simple</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/login_one" class="" target="_blank">Login with bg image</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/login_two" class="" target="_blank">Login with image two </a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/login-bs-validation" class="" target="_blank">Login With validation</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/login-bs-tt-validation" class="" target="_blank">Login with tooltip</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/login-sa-validation" class="" target="_blank">Login with sweetalert</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/sign-up" class="" target="_blank">Register Simple</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/sign-up-one" class="" target="_blank">Register with Bg Image </a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/sign-up-two" class="" target="_blank">Register with Bg video </a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/unlock" class="">Unlock User</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/forget-password" class="">Forget Password</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/creat-password" class="">Creat Password</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/maintenance" class="">Maintenance</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mega-box">
                                        <div class="link-section">
                                            <div class="submenu-title">
                                                <h5>Coming Soon</h5>
                                            </div>
                                            <div class="submenu-content opensubmegamenu">
                                                <ul>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/comingsoon" class="">Coming Simple</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/comingsoon-bg-video" class="">Coming with Bg video</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/comingsoon-bg-img" class="">Coming with Bg Image</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mega-box">
                                        <div class="link-section">
                                            <div class="submenu-title">
                                                <h5>Email templates</h5>
                                            </div>
                                            <div class="submenu-content opensubmegamenu">
                                                <ul>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/basic-template" class="">Basic Email</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/email-header" class="">Basic With Header</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/template-email" class="">Ecomerce Template</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/template-email-2" class="">Email Template 2</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/ecommerce-templates" class="">Ecommerce Email</a></li>
                                                    <li><a href="https://laravel.pixelstrap.com/viho/email-order-success" class="">Order Success </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Miscellaneous</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="image"></i><span>Gallery</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/gallery" class="">Gallery Grid</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/gallery/gallery-with-description" class="">Gallery Grid Desc</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/gallery/gallery-masonry" class="">Masonry Gallery</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/gallery/masonry-gallery-with-disc" class="">Masonry with Desc</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/gallery/gallery-hover" class="">Hover Effects</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="edit"></i><span>Blog</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/blog" class="">Blog Details</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/blog/blog-single" class="">Blog Single</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/blog/add-post" class="">Add Post</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/faq"><i data-feather="help-circle"></i><span>FAQ</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="user-check"></i><span>Job Search</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/job-search/job-cards-view" class="">Cards view</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/job-search/job-list-view" class="">List View</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/job-search/job-details" class="">Job Details</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/job-search/job-apply" class="">Apply</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="layers"></i><span>Learning</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/learning/learning-list-view" class="">Learning List</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/learning/learning-detailed" class="">Detailed Course</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="map"></i><span>Maps</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/maps/map-js" class="">Maps JS</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/maps/vector-map" class="">Vector Maps</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="git-pull-request"></i><span>Editors</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/editors/summernote" class="">Summer Note</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/editors/ckeditor" class="">CK editor</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/editors/simple-MDE" class="">MDE editor</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/editors/ace-code-editor" class="">ACE code editor</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="database"></i><span>Knowledgebase</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="https://laravel.pixelstrap.com/viho/knowledgebase" class="">Knowledgebase</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/knowledgebase/knowledge-category" class="">Knowledge category</a></li>
                            <li><a href="https://laravel.pixelstrap.com/viho/knowledgebase/knowledge-detail" class="">Knowledge detail</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav " href="https://laravel.pixelstrap.com/viho/support-ticket"><i data-feather="headphones"></i><span>Support Ticket</span></a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header> --}}
