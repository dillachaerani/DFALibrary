@canany(['users.index', 'roles.index', 'permissions.index'])
    <li class="menu {{ MyHelper::active_class(['admin/user-management*']) }}">
        <a href="#users" data-active="{{ MyHelper::active_class_true(['admin/user-management*']) }}" data-toggle="collapse" aria-expanded="{{ MyHelper::active_class_true(['admin/user-management*']) }}" class="dropdown-toggle">
            <div class="">
                <i data-feather="users"></i>
                <span>@lang('User Management')</span>
            </div>
            <i data-feather="chevron-right"></i>
        </a>
        <ul class="collapse submenu list-unstyled {{ MyHelper::active_class_show(['admin/user-management*']) }}" id="users" data-parent="#sidebar">
            @can('users.index')
                <li class="{{ MyHelper::active_class(['admin/user-management/users*']) }}">
                    <a href="{{ action('UserController@index', ['tab' => 'all']) }}"> @lang('Users') </a>
                </li>
            @endcan
            @can('roles.index')
                <li class="{{ MyHelper::active_class(['admin/user-management/roles*']) }}">
                    <a href="{{ action('RoleController@index', ['tab' => 'all']) }}"> @lang('Roles') </a>
                </li>
            @endcan
            @can('permissions.index')
                <li class="{{ MyHelper::active_class(['admin/user-management/permissions*']) }}">
                    <a href="{{ action('PermissionController@index') }}"> @lang('Permissions') </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany