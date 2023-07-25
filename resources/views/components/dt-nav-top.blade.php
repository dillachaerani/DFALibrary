<div class="form-inline d-flex mb-3">
    <div class="form-group">
        <label for="fshow">@lang('Show')</label>
        <select name="show" class="form-control form-control-sm table-show-item" id="fshow">
            @foreach (MyHelper::datatable_show_option() as $item)
                <option value="{{ $item }}" data-href="{{ route(request()->route()->getName(), request()->except(['show', 'page'])+['show'=>$item]) }}" {{ (request()->show == $item) ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group ml-auto">
        <form action="{{ route(request()->route()->getName(), request()->except('page')) }}" class="table-form-search">
            <div class="input-group">
                {!! Form::text('q', request()->q, [
                    'id'            => 'fq',
                    'class'         => "form-control",
                    'placeholder'   => __('Search'),
                    ]) 
                !!}
                <div class="input-group-append">
                    <button type="submit" class="btn btn-md btn-dark"><i class="fas fa-search"></i></button>
                    <button class="btn btn-md btn-danger"><a class="text-light" href="{{ route(request()->route()->getName(), ['tab' => request()->tab]) }}">Reset</a></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="form-inline d-flex mb-3">
    {{ $bulk_action }}
    <div class="ml-auto mt-2">
        @if ($data->count() > 0)
            {{ $data->links('components.pagination') }}
        @else
            @include('components.pagination-empty')
        @endif
    </div>
</div>