<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo mr-4">
                <a href="/">
                    <img src="{{asset('storage/img/logo.png')}}" class="navbar-logo" alt="logo" style="width: auto">
                </a>
            </li>
        </ul>
        <ul class="navbar-item flex-row ml-md-0 ml-auto d-none">
            <li class="nav-item align-self-center search-animated">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <form class="form-inline search-full form-inline search" role="search">
                    <div class="search-bar">
                        <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                    </div>
                </form>
            </li>
        </ul>

        <ul class="navbar-item flex-row ml-md-auto">            
            <li class="nav-item dropdown user-profile-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    @if (Auth::user()->avatar)
                        @if (file_exists(storage_path('app/public/user/thumbnail/40/' . Auth::user()->avatar)))
                            <img alt="avatar" src="{{ asset('storage/uploads/users/thumbnail/40/'.Auth::user()->avatar) }}"/>
                        @else
                            <img alt="avatar" src="{{ asset('storage/uploads/users/original/'.Auth::user()->avatar) }}"/>
                        @endif
                    @else
                        <img src="{{asset('storage/img/90x90.jpg')}}" alt="avatar">
                    @endif
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="">
                        <div class="dropdown-item">
                            <a href="{{ action('AccountController@show', encrypt(Auth::user()->id)) }}">
                                <i data-feather="user"></i> {{ Auth::user()->username }}
                                @if (Auth::user()->email_verified_at)
                                    <span ><i class="far fa-check-circle text-info"></i></span>
                                @endif
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i data-feather="log-out"></i> @lang('Sign Out')</a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN NAVBAR  -->
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
        <ul class="navbar-nav flex-row">
            <li style="color: red">
                <div class="page-header">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->