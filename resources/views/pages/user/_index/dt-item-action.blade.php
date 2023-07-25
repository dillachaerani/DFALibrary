<!-- Activate -->
<a class="dropdown-item btn-js-confirm-get" href="{{ action('UserController@activate', encrypt($item->id)) }}" data-alert_title="@lang('Are you sure?')" data-alert_msg="{{ ($item->is_active) ? __("$lang.messages.deactivate.alert", ['attr' => $item->username]) : __("$lang.messages.activate.alert", ['attr' => $item->username]) }}">
    {{ ($item->is_active) ? __('Deactivate') : __('Activate') }}
</a>
<!-- Verification -->
<a class="dropdown-item btn-js-confirm-get" href="{{ action('UserController@verification', encrypt($item->id)) }}" data-alert_title="@lang('Are you sure?')" data-alert_msg="{{ ($item->email_verified_at) ? __("$lang.messages.unverification.alert", ['attr' => $item->username]) : __("$lang.messages.verification.alert", ['attr' => $item->username]) }}">
    {{ ($item->email_verified_at) ? __('Unverified') : __('Verified') }}
</a>