<div class="btn-group" role="group" aria-label="Basic example">
    @if (isset($edit_url))
        <a href="{{ $edit_url }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit">
            <i class="fas fa-pencil-alt text-white"></i>
        </a>
    @endif
    @if (isset($delete_url))
        <a href="javascript:void(0);" class="btn btn-danger btn-js-confirm" data-toggle="tooltip" data-placement="top" title="@lang('Delete')" data-original-title="@lang('Delete')" data-action="del-{{ $row_name }}" data-alert_title="@lang('Are you sure?')" data-alert_msg="{{ $delete_msg }}">
            <i class="fas fa-trash-alt text-white"></i>
        </a>
        {!! Form::open(['url' => $delete_url, 'method' => 'delete', 'class' => 'd-none', 'id' => "del-$row_name"]) !!}
        {!! Form::close() !!}
    @endif
    @if (isset($restore_url))
        <a href="{{ $restore_url }}" class="btn btn-success btn-js-confirm-get" data-toggle="tooltip" data-placement="top" title="@lang('Restore')" data-original-title="@lang('Restore')" data-alert_title="@lang('Are you sure?')" data-alert_msg="{{ $restore_msg }}">
            <i class="fas fa-recycle text-white"></i>
        </a>
    @endif
    {{ $slot }}
</div>