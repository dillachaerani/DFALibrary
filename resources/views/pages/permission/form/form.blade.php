<!-- FORM -->
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