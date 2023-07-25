<thead>
    <tr>
        <th class="checkbox-column text-center align-middle" width="10px">
            <label class="new-control new-checkbox checkbox-info m-0" style="height: 18px;">
                <input type="checkbox" class="new-control-input check-all-item" data-child="{{ $child }}">
                <span class="new-control-indicator"></span>
            </label>
        </th>
        {{ $slot }}
        <th class="align-middle">
            {!! MyHelper::table_generate_th(__('Date Deleted'), 'deleted_at') !!}
        </th>
        <th class="text-center text-dark align-middle">@lang('Action')</th>
    </tr>
</thead>