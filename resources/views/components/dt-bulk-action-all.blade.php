<div class="btn-group" role="group">
    <button id="btn_bulk_action" type="button" class="btn btn-dark mb-1 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i data-feather="menu"></i> @lang('Bulk Action') <i data-feather="chevron-down"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="btn_bulk_action">
        @if (isset($delete_url))
            <a class="dropdown-item btn-js-confirm" href="javascript:void(0);" data-action="{{ "$table_name-delete-all-data" }}" data-alert_title="@lang('Are you sure?')" data-alert_msg="{{ $delete_msg }}">@lang('Delete All Data')</a>
            {!! Form::open(['url' => $delete_url, 'method' => 'post', 'class' => 'd-none', 'id' => "$table_name-delete-all-data"]) !!}
            {!! Form::close() !!}
        @endif
        @if (isset($restore_url))
            <a class="dropdown-item btn-js-confirm" href="javascript:void(0);" data-action="{{ "$table_name-restore-all-data" }}" data-alert_title="@lang('Are you sure?')" data-alert_msg="{{ $restore_msg }}">@lang('Restore All Data')</a>
            {!! Form::open(['url' => $restore_url, 'method' => 'post', 'class' => 'd-none', 'id' => "$table_name-restore-all-data"]) !!}
            {!! Form::close() !!}
        @endif
        @if($slot->isNotEmpty())
            <div class="dropdown-divider"></div>
            {{ $slot }}
        @endif
    </div>
</div>