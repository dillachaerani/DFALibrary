<div class="table-responsive">
    <table class="table table-borderless table-hover table-md">
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.name")])
            {{ $role->name }}
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.guard_name")])
            {{ $role->guard_name }}
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.users_count")])
            {{ $role->users->count() }}
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.users")])
            {{ $role->users->count() ? $role->users->pluck('username')->join(", ") : "-" }}
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.permissions_count")])
            {{ $role->permissions->count() }}
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => false, 'th_text' => __("$lang.attributes.permissions")])
            {{ $role->permissions->count() ? $role->permissions->pluck('name')->join(", ") : "-" }}
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("Date Created")])
            {{ MyHelper::datetime_long_datetime_local($role->created_at) }} | {{ $role->created_at->diffForHumans() }}
        @endcomponent
        @if ($role->deleted_at)
            @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("Date Deleted")])
                {{ MyHelper::datetime_long_datetime_local($role->deleted_at) }} | {{ $role->deleted_at->diffForHumans() }}
            @endcomponent
        @else
            @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("Last Modified")])
                {{ MyHelper::datetime_long_datetime_local($role->updated_at) }} | {{ $role->updated_at->diffForHumans() }}
            @endcomponent
        @endif
    </table>
</div>