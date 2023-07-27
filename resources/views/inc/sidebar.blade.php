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
            @canany(['books.index'])
                <li class="menu {{ MyHelper::active_class(['admin/books*']) }}">
                    <a href="#books" data-active="{{ MyHelper::active_class_true(['admin/books*']) }}" data-toggle="collapse" aria-expanded="{{ MyHelper::active_class_true(['admin/books*']) }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="book"></i>
                            <span>@lang('Buku')</span>
                        </div>
                        <i data-feather="chevron-right"></i>
                    </a>
                    <ul class="collapse submenu list-unstyled {{ MyHelper::active_class_show(['admin/books*']) }}" id="books" data-parent="#sidebar">
                        @can('book_categories.index')
                            <li class="{{ MyHelper::active_class(['admin/book-categories*']) }}">
                                <a href="{{ action('UserController@index', ['tab' => 'all']) }}"> @lang('Kategori') </a>
                            </li>
                        @endcan
                        @can('books.index')
                            <li class="{{ MyHelper::active_class(['admin/books*']) }}">
                                <a href="{{ action('RoleController@index', ['tab' => 'all']) }}"> @lang('Daftar Buku') </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            <li class="menu {{ MyHelper::active_class(['admin/dashboard*']) }}">
                <a href="{{ action('DashboardController@index') }}" aria-expanded="{{ MyHelper::active_class_true(['admin/dashboard*']) }}" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="file-text"></i>
                        <span>Daftar Peminjaman<span>
                    </div>
                </a>
            </li>
            @include('inc._sidebar.user-management')
            <li class="menu {{ MyHelper::active_class(['admin/faq*']) }}">
                <a href="{{ action('DashboardController@index') }}" aria-expanded="{{ MyHelper::active_class_true(['admin/dashboard*']) }}" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="help-circle"></i>
                        <span>FAQ<span>
                    </div>
                </
            @include('inc._sidebar.setting')
        </ul>
        
    </nav>

</div>
<!--  END SIDEBAR  -->