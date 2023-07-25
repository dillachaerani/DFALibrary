<!-- FORM -->
<div class="form-group row mb-4">
    {!! Form::label("fname", __("$lang.attributes.name") . "*", ["class"=>"col-xl-2 col-sm-3 col-sm-2 col-form-label"]) !!}
    <div class="col-xl-10 col-lg-9 col-sm-10">
        {!! Form::text("name", null, [
            'id'            => "fname",
            'class'         => "form-control text-slug ". ($errors->has('name') ? ' is-invalid' : ''),
            'placeholder'   => MyHelper::generate_ph("text", __("$lang.attributes.name")),
            'required'
            ]) 
        !!}
        @error('name')
            <div class="invalid-feedback" style="display: block;">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<hr>
{!! Form::label("fname", __("$lang.attributes.permissions"), ["class"=>"col-form-label mb-2"]) !!}
<div class="row pl-4 pr-4">
    @foreach ($permissions as $key => $item)
        <div class="col-sm-3 b-l-primary b-b-primary">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <h6 class="mt-2">{{ $key }} ({{ count($item) }})</h6>
                    <div class="ml-3">
                        <div class="n-chk">
                            <label class="new-control new-checkbox new-checkbox-text checkbox-info">
                            <input type="checkbox" class="new-control-input check-all-item" data-child = "permissions-{{ $key }}">
                            <span class="new-control-indicator"></span><span class="new-chk-content">@lang('Check All')</span>
                            </label>
                        </div>
                        @foreach ($item as $permission)
                            <div class="n-chk">
                                <label class="new-control new-checkbox new-checkbox-text checkbox-info">
                                    <input type="checkbox" class="new-control-input item-permisiion permissions-{{ $key }}" name="permissions_id[]" value="{{ $permission['id'] }}" {{ isset($role) ? ($role->permissions->where('id', $permission['id'])->first()) ? 'checked' : '' : '' }}>
                                    <span class="new-control-indicator"></span>
                                    <span class="new-chk-content">{{ $permission['name'] }}</span>
                                </label>
                            </div>
                        @endforeach 
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>