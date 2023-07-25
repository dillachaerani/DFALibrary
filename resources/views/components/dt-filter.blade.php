<div id="filter" class="no-outer-spacing mb-2">
    <div class="card no-outer-spacing">
        <div class="card-header" id="headingOne2">
            <section class="mb-0 mt-0">
                <div role="menu" class="" data-toggle="collapse" data-target="#filterAccordionOne" aria-expanded="true" aria-controls="filterAccordionOne">
                    @lang('Filter') <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                </div>
            </section>
        </div>
        <div id="filterAccordionOne" class="collapse show" aria-labelledby="headingOne2" data-parent="#filter">
            <div class="card-body">
                {!! Form::open(['method' => 'GET', 'url' => $action]) !!}
                    {!! Form::hidden("tab", request()->tab, ['required']) !!}
                    {!! Form::hidden("q", request()->q)  !!}
                    {{ $slot }}
                    <div class="form-row">
                        <div class="form-group col-md-12 text-right">
                            <button class="btn btn-primary" type="submit">@lang('Apply')</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>