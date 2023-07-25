<div class="form-row">
    <div class="form-group col-md-4">
        {!! Form::label("froles", __("$lang.attributes.roles")) !!}
        <select class="js-states form-control" name="roles[]" id="froles" multiple="multiple">
            @forelse (['null' => 'null'] + Spatie\Permission\Models\Role::orderBy('name','asc')->pluck('name','name')->all() as $role)
                <option value="{{ $role }}" @if (request()->roles) {{ (in_array($role, request()->roles)) ? 'selected' : '' }}  @endif>
                    {{ $role }}
                </option>
            @empty
            @endforelse
        </select>
    </div>
    <div class="form-group col-md-4">
        {!! Form::label("fis_active", __("$lang.attributes.is_active")) !!}
        {!! Form::select('is_active', ['1' => __('Active'), '0' => __('Not Active')], request()->is_active, [
            'id'          => "fis_active",
            'class'       => "form-control ". ($errors->has('is_active') ? ' is-invalid' : ''),
            'placeholder' => MyHelper::generate_ph("select", __("$lang.attributes.is_active"))
            ]) 
        !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::label("femail_verified_at", __("$lang.attributes.email_verified_at")) !!}
        {!! Form::select('email_verified_at', ['1' => __('Verified'), '0' => __('Not Verified')], request()->email_verified_at, [
            'id'          => "femail_verified_at",
            'class'       => "form-control ". ($errors->has('email_verified_at') ? ' is-invalid' : ''),
            'placeholder' => MyHelper::generate_ph("select", __("$lang.attributes.email_verified_at"))
            ]) 
        !!}
    </div>
</div>