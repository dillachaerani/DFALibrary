<div class="btn-group">
    <a class="btn btn-dark btn-sm" href="{{ $open_url ?? 'javascript:void(0);' }}">Detail</a>
    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdown_table_action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
        <i data-feather="chevron-down"></i>
    </button>
    <div class="dropdown-menu">
        @if ($edit_url)
            <a class="dropdown-item" href="{{ $edit_url }}" target="_blank">Edit</a>
        @endif
        @if ($delete_url)
            <a class="dropdown-item btn-js-confirm" href="javascript:void(0);" data-action="del-{{ $row_name }}" data-alert_title="@lang('Are you sure?')" data-alert_msg="{{ $delete_msg }}">@lang('Delete')</a>
            {!! Form::open(['url' => $delete_url, 'method' => 'delete', 'class' => 'd-none', 'id' => "del-$row_name"]) !!}
            {!! Form::close() !!}
        @endif
        @if (isset($restore_url))
            <a class="dropdown-item btn-js-confirm-get" href="{{ $restore_url }}" data-alert_title="@lang('Are you sure?')" data-alert_msg="{{ $restore_msg }}">
                @lang('Restore')
            </a>
        @endif
        @if($slot->isNotEmpty())
            <div class="dropdown-divider"></div>
            {{ $slot }}
        @endif
    </div>
</div>    