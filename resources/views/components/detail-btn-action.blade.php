@if($edit_url)
    <a href="{{ $edit_url }}" class="btn btn-info mb-1"><i class="fas fa-pencil-alt"></i> @lang('Edit')</a>
@endif
@if ($restore_url)
    @if ($delete_url)
        <a class="btn btn-danger mb-1 btn-js-confirm" href="javascript:void(0);" data-alert_title="@lang('Are you sure?')" data-alert_msg="@lang("$lang.messages.delete_force.alert", ['attr' => $name])" data-action="{{ "del-$table_name" }}">
            <i class="fas fa-trash-alt"></i> @lang('Delete')
        </a>
        {!! Form::open(['url' => $delete_url, 'method' => 'delete', 'class' => 'd-none', 'id' => "del-$table_name"]) !!}
        {!! Form::close() !!}
    @endif
    @if ($restore_url)
        <a class="btn btn-success mb-1 btn-js-confirm-get" href="{{ $restore_url }}" data-alert_title="@lang('Are you sure?')" data-alert_msg="@lang("$lang.messages.restore.alert", ['attr' => $name])">
            <i class="fas fa-recycle"></i> @lang('Restore')
        </a>
    @endif
@else
    <a class="btn btn-danger mb-1 btn-js-confirm" href="javascript:void(0);" data-alert_title="@lang('Are you sure?')" data-alert_msg="@lang("$lang.messages.delete.alert", ['attr' => $name])" data-action="{{ "del-$table_name" }}">
        <i class="fas fa-trash-alt"></i> @lang('Delete')
    </a>
    {!! Form::open(['url' => $delete_url, 'method' => 'delete', 'class' => 'd-none', 'id' => "del-$table_name"]) !!}
    {!! Form::close() !!}
@endif
@if($slot->isNotEmpty())
    <div class="btn-group mb-1" role="group">
        <button id="btn_other" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('Others') <i data-feather="chevron-down"></i></button>
        <div class="dropdown-menu" aria-labelledby="btn_other">
            {{ $slot }}
        </div>
    </div>
@endif