<div class="widget box box-shadow">
    <div class="widget-header">
        @if ($title)
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>{{ $title }}</h4>
                </div>
            </div>
        @endif
        {{ isset($header) ? $header : '' }}
    </div>
    <div class="widget-content widget-content-area">
        {{ isset($content) ? $content : '' }}
    </div>
</div>