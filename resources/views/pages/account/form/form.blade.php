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
            'input_name' => 'img_avatar',
            'id'         => "fimg_avatar",
            'required'   => 'required',
            'delete_url' => (isset($user)) ? action('AccountController@removeImage', encrypt($user->id)) : null
        ]) 
        @endcomponent
    </div>
</div>
<div class="form-group row mb-4">
    {!! Form::label("fusername", __("$lang.attributes.username") . "*", ["class"=>"col-xl-2 col-sm-3 col-sm-2 col-form-label"]) !!}
    <div class="col-xl-10 col-lg-9 col-sm-10">
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
    <div class="col-xl-10 col-lg-9 col-sm-10">
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