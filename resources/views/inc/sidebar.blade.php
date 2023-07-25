<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
        
    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="sidebar">
            <li class="menu {{ MyHelper::active_class(['admin/dashboard*']) }}">
                <a href="{{ action('DashboardController@index') }}" aria-expanded="{{ MyHelper::active_class_true(['admin/dashboard*']) }}" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="home"></i>
                        <span>Dashboard<span>
                    </div>
                </a>
            </li>
            @include('inc._sidebar.user-management')
            @include('inc._sidebar.setting')
        </ul>
        
    </nav>

</div>
<!--  END SIDEBAR  -->