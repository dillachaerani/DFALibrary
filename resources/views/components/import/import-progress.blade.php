<div class="row mb-4" style="display: none" id="import-progress">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="d-flex justify-content-between">
            <div class="w-browser-info">
                <p><strong>@lang('Filename') : </strong> <span id="import-filename"></span></p>
                <p><strong>@lang('Importing Data')</strong> (<span id="import-iteration">0</span> @lang('of') <span id="import-entries">0</span> @lang('entries'))</p>
            </div>
        </div>
        <div class="w-browser-stats">
            <div class="progress mb-0">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success text-dark" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="import-progressbar">
                    <strong><span id="import-progressbar-percentage">0</span>%</strong>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <button style="display: none" class="btn btn-xs btn-dark p-0 p-2" id="import-btn-pause" data-toggle="tooltip" data-placement="top" data-original-title="@lang('Pause')"><i data-feather="pause-circle"></i></button>
            <button style="display: none" class="btn btn-xs btn-success p-0 p-2" id="import-btn-play" data-toggle="tooltip" data-placement="top" data-original-title="@lang('Resume')"><i data-feather="play-circle"></i></button>
            <a style="display: none" class="btn btn-xs btn-danger p-0 p-2 btn-js-confirm-get" id="import-btn-refresh" href="{{ $refresh_url }}" data-alert_title="@lang('Are you sure?')" data-alert_msg="@lang('Page will refresh')" data-toggle="tooltip" data-placement="top" data-original-title="@lang('Refresh')"><i data-feather="refresh-cw"></i></a>
        </div>
    </div>
</div>