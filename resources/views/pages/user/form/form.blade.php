<!-- FORM -->
<div class="form-group row mb-4">
    {!! Form::label("favatar", __("$lang.attributes.avatar"), ["class"=>"col-xl-2 col-sm-3 col-sm-2 col-form-label"]) !!}
    <div class="col-xl-10 col-lg-9 col-sm-10">
        @component('components.form-dropify', [
            'model'      => (isset($user)) ? $user : null,
            'field_name' => 'avatar',
            'path'       => 'user',
            'file_size'  => 1024,
            'extention'  => 'jpg,jpeg,png',
            'input_name' => 'upload_avatar',
            'id'         => "fupload_avatar",
            'required'   => false,
            'delete_url' => (isset($user)) ? action('UserController@removeImage', ['id'=>encrypt($user->id), 'name'=>'avatar']) : null
        ]) 
        @endcomponent
    </div>
</div>
<div class="form-group row mb-4">
    {!! Form::label("fusername", __("$lang.attributes.username") . "*", ["class"=>"col-xl-2 col-sm-3 col-sm-2 col-form-label"]) !!}
    <div class="col-xl-7 col-lg-6 col-sm-7">
        {!! Form::text("username", null, [
            'id'            => "fusername",
            'class'         => "form-control ". ($errors->has('username') ? ' is-invalid' : ''),
            'placeholder'   => MyHelper::generate_ph("text", __("$lang.attributes.username")),
            'required'
            ]) 
        !!}
        @error('username')
            <div class="invalid-feedback" style="display: block;">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col">
        <div class="n-chk mt-2">
            <label class="new-control new-checkbox new-checkbox-rounded checkbox-outline-primary">
              {!! Form::checkbox('is_active', true, isset($user) ? ($user->is_active) ? true : false : true, ['class'=>'new-control-input']) !!}
              <span class="new-control-indicator"></span><span class="new-chk-content">@lang('Activated')</span>
            </label>
        </div>
    </div>
</div>
<div class="form-group row mb-4">
    {!! Form::label("fname", __("$lang.attributes.name") . "*", ["class"=>"col-xl-2 col-sm-3 col-sm-2 col-form-label"]) !!}
    <div class="col-xl-10 col-lg-9 col-sm-10">
        {!! Form::text("name", null, [
            'id'            => "fname",
            'class'         => "form-control ". ($errors->has('name') ? ' is-invalid' : ''),
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
<div class="form-group row mb-4">
    {!! Form::label("femail", __("$lang.attributes.email") . "*", ["class"=>"col-xl-2 col-sm-3 col-sm-2 col-form-label"]) !!}
    <div class="col-xl-7 col-lg-6 col-sm-7">
        {!! Form::email("email", null, [
            'id'            => "femail",
            'class'         => "form-control ". ($errors->has('email') ? ' is-invalid' : ''),
            'placeholder'   => MyHelper::generate_ph("text", __("$lang.attributes.email")),
            'required'
            ]) 
        !!}
        @error('email')
            <div class="invalid-feedback" style="display: block;">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col">
        <div class="n-chk mt-2">
            <label class="new-control new-checkbox new-checkbox-rounded checkbox-outline-primary">
              {!! Form::checkbox('is_verified', true, isset($user) ? ($user->email_verified_at) ? true : false : true, ['class'=>'new-control-input']) !!}
              <span class="new-control-indicator"></span><span class="new-chk-content">@lang('Verified')</span>
            </label>
        </div>
    </div>
</div>
<div class="form-group row mb-4">
    {!! Form::label("froles", __("$lang.attributes.roles"), ["class"=>"col-xl-2 col-sm-3 col-sm-2 col-form-label"]) !!}
    <div class="col-xl-10 col-lg-9 col-sm-10">
        <select class="js-states form-control" name="roles[]" id="froles" multiple="multiple">
            @forelse (Spatie\Permission\Models\Role::orderBy('name','asc')->pluck('name','name')->all() as $role)
                <option value="{{ $role }}" 
                    @if (old('roles')) 
                        {{ (in_array($role, old('roles'))) ? 'selected' : '' }} 
                    @else 
                        {{ (isset($user)) ? (in_array($role, $user['roles'])) ? 'selected' : '' : '' }} 
                    @endif>
                    {{ $role }}
                </option>
            @empty
            @endforelse
        </select>
        @error('roles')
            <div class="invalid-feedback" style="display: block;">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="form-group row mb-4">
    {!! Form::label("fpassword", __("$lang.attributes.password") . "*", ["class"=>"col-xl-2 col-sm-3 col-sm-2 col-form-label"]) !!}
    <div class="col-xl-10 col-lg-9 col-sm-10">
        {!! Form::password('password', [
            'id'            => 'fpassword',
            'class'         => "form-control ". ($errors->has('password') ? ' is-invalid' : ''),
            'placeholder'   => MyHelper::generate_ph('text', __('user_lang.attributes.password')),
            (Route::currentRouteName() == "users.create") ? 'required' : ''
            ]) 
        !!}
        @error('password')
            <div class="invalid-feedback" style="display: block;">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="form-group row mb-4">
    {!! Form::label("fpassword_confirmation", __("$lang.attributes.password_confirmation") . "*", ["class"=>"col-xl-2 col-sm-3 col-sm-2 col-form-label"]) !!}
    <div class="col-xl-10 col-lg-9 col-sm-10">
        {!! Form::password('password_confirmation', [
            'id'            => 'fpassword_confirmation',
            'class'         => "form-control ". ($errors->has('password_confirmation') ? ' is-invalid' : ''),
            'placeholder'   => MyHelper::generate_ph('text', __('user_lang.attributes.password_confirmation')),
            (Route::currentRouteName() == "users.create") ? 'required' : ''
            ]) 
        !!}
        @error('password')
            <div class="invalid-feedback" style="display: block;">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>