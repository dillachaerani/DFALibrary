<div class="table-responsive">
    <table class="table table-borderless table-hover table-md">
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.name")])
            {{ $permission->name }}
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.guard_name")])
            {{ $permission->guard_name }}
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.roles_count")])
            {{ $permission->roles->count() }}
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.roles")])
            <ul class="p-0 m-0">
                @foreach ($permission->roles as $role)
                    <li class="ml-3">
                        {{ $role->name }}
                    </li>
                @endforeach
            </ul>
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("Date Created")])
            {{ MyHelper::datetime_long_datetime_local($permission->created_at) }} | {{ $permission->created_at->diffForHumans() }}
        @endcomponent
        @if ($permission->deleted_at)
            @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("Date Deleted")])
                {{ MyHelper::datetime_long_datetime_local($permission->deleted_at) }} | {{ $permission->deleted_at->diffForHumans() }}
            @endcomponent
        @else
            @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("Last Modified")])
                {{ MyHelper::datetime_long_datetime_local($permission->updated_at) }} | {{ $permission->updated_at->diffForHumans() }}
            @endcomponent
        @endif
    </table>
</div>