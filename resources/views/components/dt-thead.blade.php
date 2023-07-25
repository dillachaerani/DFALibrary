<thead>
    <tr>
        <th class="checkbox-column text-center align-middle" width="10px">
            <label class="new-control new-checkbox checkbox-info m-0 ml-2" style="height: 15px;">
                <input type="checkbox" class="new-control-input check-all-item" data-child="{{ $child }}">
                <span class="new-control-indicator"></span>
            </label>
        </th>
        {{ $slot }}
        @if (MyHelper::tab_class_active_true('trash'))
            <th class="align-middle">
                {!! MyHelper::table_generate_th(__('Date Deleted'), 'deleted_at') !!}
            </th>
        @else
            <th class="align-middle">
                {!! MyHelper::table_generate_th(__('Last Modified'), 'updated_at') !!}
            </th>
        @endif
        <th class="text-center align-middle">@lang('Action')</th>
    </tr>
</thead>