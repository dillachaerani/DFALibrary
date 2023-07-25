<div class="form-group">
    <form class="table-bulk-action" data-child="{{ $child }}">
        <div class="input-group">
            <select class="form-control form-control-sm" name="b_action" required>
                <option value="" selected>@lang('Select Bulk Action')</option>
                @if (isset($delete_url))
                    <option value="delete" data-alert_title="@lang('Are you sure?')" data-alert="{{ $delete_msg }}" data-loading_text="@lang('Deleting Data')" data-url="{{ $delete_url }}">@lang('Delete')</option>
                @endif
                @if (isset($restore_url))
                    <option value="restore" data-alert_title="@lang('Are you sure?')" data-alert="{{ $restore_msg }}" data-loading_text="@lang('Restoring Data')" data-url="{{ $restore_url }}">@lang('Restore')</option>
                @endif
                @if($slot->isNotEmpty())
                    <option disabled>──────────</option>
                    {{ $slot }}
                @endif
            </select>
            <div class="input-group-append">
                <button class="btn btn-dark" type="submit">@lang('Apply')</button>
            </div>
        </div>
    </form>
</div>
