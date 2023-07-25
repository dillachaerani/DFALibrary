@canany(['accounts.index', 'app.update', 'menu_settings.index', 'activity_logs.index'])
    <li class="menu {{ MyHelper::active_class(['admin/setting*', 'admin/account*']) }}">
        <a href="#settings" data-active="{{ MyHelper::active_class_true(['admin/setting*', 'admin/account*']) }}" data-toggle="collapse" aria-expanded="{{ MyHelper::active_class_true(['admin/setting*', 'admin/account*']) }}" class="dropdown-toggle">
            <div class="">
                <i data-feather="settings"></i>
                <span>@lang('Setting')</span>
            </div>
            <i data-feather="chevron-right"></i>
        </a>
        <ul class="collapse submenu list-unstyled {{ MyHelper::active_class_show(['admin/setting*', 'admin/account*']) }}" id="settings" data-parent="#sidebar">
            @role('developer|superadmin')
                @can('app.update')
                    <li class="{{ MyHelper::active_class(['admin/setting/app*']) }}">
                        <a href="{{ action('AppSettingController@index') }}"> @lang('Application') </a>
                    </li>
                @endcan
            @endrole
            @can('accounts.index')
                <li class="{{ MyHelper::active_class(['admin/account*']) }}">
                    <a href="{{ action('AccountController@show', encrypt(\Auth::user()->id)) }}"> @lang('My Account') </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany