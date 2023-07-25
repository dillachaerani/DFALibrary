<h6 class="p-0 m-0 mr-2 mt-1 text-light">@lang('Trash')</h6>
<label class="switch s-icons s-outline s-outline-info p-0 m-0">
    <input class="table-config-trash" data-href="{{ $action }}" data-key="{{ $key }}" value="true" type="checkbox" {{ ($is_enable) ? 'checked' : '' }}>
    <span class="slider round"></span>
</label>