<div class="mt-1" id="{{ $input_id }}_action">
    @if($delete_url)
        <a href="{{ $delete_url }}" class="btn-sm btn-danger remove-dropify mr-1 nowrap" data-alert_title="@lang('Are you sure?')" data-alert_msg="@lang('File will be deleted')" data-input_id="{{ $input_id }}" data-action_id="{{ $input_id }}_action">
            <i class="fas fa-trash"></i> @lang('Remove')
        </a>
    @endif
    <a href="javascript:void(0)" class="btn-sm btn-dark btn-view-image nowrap" data-file="{{ $file }}" data-file_original="{{ $file_original }}" data-filename="{{ $filename }}">
        <i class="fas fa-eye"></i> @lang('View')
    </a>
    <!-- Modal -->
    @include('components.modal-view-file')
</div>