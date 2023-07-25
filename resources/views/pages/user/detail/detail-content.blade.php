<div class="table-responsive">
    <table class="table table-borderless table-hover table-md">
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.is_active")])
            {!! MyHelper::badge_active($user->is_active) !!}
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.avatar")])
            @if ($user->avatar)
                @component('components.detail-view-file', [
                    'type'          => 'image',
                    'name'          => 'avatar',
                    'file'          => asset('storage/uploads/users/thumbnail/200/' . $user->avatar),
                    'view_file'     => asset('storage/uploads/users/original/' . $user->avatar),
                    'download_file' => asset('storage/uploads/users/original/' . $user->avatar),
                ])
                @endcomponent
            @else
                <div class="avatar avatar-md mt-1">
                    <span class="avatar-title rounded-circle">{{ MyHelper::get_initial_name($user->username) }}</span>
                </div>
            @endif
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.username")])
            {{ $user->username }}
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.name")])
            {{ $user->name }}
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.email")])
            {{ $user->email }}
            {!! MyHelper::icon_verified($user->email_verified_at) !!} 
            @if ($user->email_verified_at)
                <br>
                @lang('Verification Date') : {{ MyHelper::datetime_long_datetime_local($user->email_verified_at) }} | {{ $user->email_verified_at->diffForHumans() }}
            @endif
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("$lang.attributes.roles")])
            <ul class="p-0 m-0">
                @foreach ($user->roles as $role)
                    <li class="ml-3">
                        {{ $role->name }}
                    </li>
                @endforeach
            </ul>
        @endcomponent
        @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("Date Created")])
            {{ MyHelper::datetime_long_datetime_local($user->created_at) }} | {{ $user->created_at->diffForHumans() }}
        @endcomponent
        @if ($user->deleted_at)
            @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("Date Deleted")])
                {{ MyHelper::datetime_long_datetime_local($user->deleted_at) }} | {{ $user->deleted_at->diffForHumans() }}
            @endcomponent
        @else
            @component('components.detail-table-tr', ['th_width' => '200px', 'th_nowrap' => true, 'th_text' => __("Last Modified")])
                {{ MyHelper::datetime_long_datetime_local($user->updated_at) }} | {{ $user->updated_at->diffForHumans() }}
            @endcomponent
        @endif
    </table>
</div>