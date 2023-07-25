@php
    if(request()->tab == "trash")
        $trash_params = ['tab' => 'trash'];
    else
        $trash_params = [];
@endphp
<!-- Activate All Data -->
<a class="dropdown-item btn-js-confirm" href="javascript:void(0);" data-action="{{ "$table_name-activate-all-data" }}" data-alert_title="@lang('Are you sure?')" data-alert_msg="@lang("$lang.messages.activate.all.alert")">@lang('Activate All Data')</a>
{!! Form::open(['url' => action('UserController@activateAll', $trash_params + ['type'=>'activate']), 'method' => 'post', 'class' => 'd-none', 'id' => "$table_name-activate-all-data"]) !!}
{!! Form::close() !!}
<!-- Deactivate All Data -->
<a class="dropdown-item btn-js-confirm" href="javascript:void(0);" data-action="{{ "$table_name-deactivate-all-data" }}" data-alert_title="@lang('Are you sure?')" data-alert_msg="@lang("$lang.messages.deactivate.all.alert")">@lang('Deactivate All Data')</a>
{!! Form::open(['url' => action('UserController@activateAll', $trash_params + ['type'=>'deactivate']), 'method' => 'post', 'class' => 'd-none', 'id' => "$table_name-deactivate-all-data"]) !!}
{!! Form::close() !!}

<div class="dropdown-divider"></div>
<!-- Verification All Data -->
<a class="dropdown-item btn-js-confirm" href="javascript:void(0);" data-action="{{ "$table_name-verification-all-data" }}" data-alert_title="@lang('Are you sure?')" data-alert_msg="@lang("$lang.messages.verification.all.alert")">@lang('Verification All Data')</a>
{!! Form::open(['url' => action('UserController@verificationAll', $trash_params + ['type'=>'verification']), 'method' => 'post', 'class' => 'd-none', 'id' => "$table_name-verification-all-data"]) !!}
{!! Form::close() !!}
<!-- Unverification All Data -->
<a class="dropdown-item btn-js-confirm" href="javascript:void(0);" data-action="{{ "$table_name-unverification-all-data" }}" data-alert_title="@lang('Are you sure?')" data-alert_msg="@lang("$lang.messages.unverification.all.alert")">@lang('Unverification All Data')</a>
{!! Form::open(['url' => action('UserController@verificationAll', $trash_params + ['type'=>'unverification']), 'method' => 'post', 'class' => 'd-none', 'id' => "$table_name-unverification-all-data"]) !!}
{!! Form::close() !!}