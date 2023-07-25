{!! Form::open(['method' => 'POST', 'url' => $url, 'files' => true, 'class' => 'form-import', 'data-url_store' => $url_store, 'data-delay_time' => $delay_time]) !!}
    <div class="row">
        <div class="col-md-12" style="display: none" id="import-report">
            <hr>
                <h6 class="p-0 m-0 mb-2">
                    @lang('Total Data') : <span id="import-report-total"></span>,
                    @lang('New Data') : <span id="import-report-new"></span>,
                    @lang('Updated Data') : <span id="import-report-update"></span>,
                    @lang('Failed Data') : <span id="import-report-failed"></span>
                </h6>
            <hr>
        </div>
        <div class="col-md mb-4">
            <h6 class="p-0 m-0 mb-2">@lang('New Data')</h6>
            <textarea class="form-control" id="import-result-new-data" rows="5" disabled></textarea>
        </div>
        <div class="col-md mb-4">
            <h6 class="p-0 m-0 mb-2">@lang('Updated Data')</h6>
            <textarea class="form-control" id="import-result-update-data" rows="5" disabled></textarea>
        </div>
        <div class="col-md mb-4">
            <h6 class="p-0 m-0 mb-2">@lang('Failed Data')</h6>
            <textarea class="form-control" id="import-result-failed-data" rows="5" disabled></textarea>
        </div>
    </div>
    <div class="row" id="import-group-form">
        <div class="form-group col-md-12">
            {!! Form::file('file', ['class' => 'form-control-file upload-excel-validate', 'required', 'data-filesize_max' => $filesize_max]) !!}
            <p class="text-warning mt-2">
                <small>
                    <strong>*@lang('notes_lang.validation-file-size-max', ['attr' => $filesize_max . "KB"])</strong> <br>
                    <strong>*@lang('notes_lang.validation-file-format', ['attr' => '.xlsx, .xls'])</strong>
                </small>
            </p>
        </div>
        <div class="form-group col-md-12 text-center">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="submit" class="btn btn-primary">@lang('Import')</button>
        </div>
    </div>
{!! Form::close() !!}