<div class="modal fade" id="modalViewFile" tabindex="-1" role="dialog" aria-labelledby="modalViewFileTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalViewFileTitle">@lang('File Detail')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body pb-1">
                <div class="text-center mb-4" id="modal_view_file">
                </div>
                <p class="mb-0"><b>@lang('Filename')</b> : <span class="modal_view_file_name"></span></p>
                <p class="mb-0"><b>@lang('Link')</b> : <a href="#" target="blank" class="modal_view_file_link"><span id="link_file" class="modal_view_file_link_txt"></span></a></p>
            </div>
            <div class="modal-footer justify-content-between">
                <div>
                    <a href="#" class="mb-1 btn btn-success modal_view_file_link" download><i class="fas fa-download"></i> @lang('Download')</a>
                </div>
                <div>
                    <button class="btn" data-dismiss="modal">X @lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
</div>