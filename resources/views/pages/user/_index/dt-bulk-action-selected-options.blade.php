@php
    if(request()->tab == "trash")
        $trash_params = ['tab' => 'trash'];
    else
        $trash_params = [];
@endphp
<!-- Activate -->
<option value="activate" data-alert_title="@lang('Are you sure?')" data-alert="@lang("$lang.messages.activate.selected.alert")" data-loading_text="@lang('Activate Data')" data-url="{{ action('UserController@activateSelected', ['type'=>'activate']) }}">@lang('Activate')</option>
<!-- Deactivate -->
<option value="deactivate" data-alert_title="@lang('Are you sure?')" data-alert="@lang("$lang.messages.deactivate.selected.alert")" data-loading_text="@lang('Deactivate Data')" data-url="{{ action('UserController@activateSelected', ['type'=>'deactivate']) }}">@lang('Deactivate')</option>

<option disabled>──────────</option>
<!-- Verified -->
<option value="verification" data-alert_title="@lang('Are you sure?')" data-alert="@lang("$lang.messages.activate.selected.alert")" data-loading_text="@lang('Verified Data')" data-url="{{ action('UserController@verificationSelected', ['type'=>'verification']) }}">@lang('Verified')</option>
<!-- Unverified -->
<option value="unverification" data-alert_title="@lang('Are you sure?')" data-alert="@lang("$lang.messages.unverification.selected.alert")" data-loading_text="@lang('Unverified Data')" data-url="{{ action('UserController@verificationSelected', ['type'=>'unverification']) }}">@lang('Unverified')</option>