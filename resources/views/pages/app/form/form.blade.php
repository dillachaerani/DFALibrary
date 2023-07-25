<!-- FORM -->
<div class="form-group row mb-4">
    {!! Form::label("ffavicon", __("$lang.attributes.favicon") . "*", ["class"=>"col-xl-2 col-sm-3 col-sm-2 col-form-label"]) !!}
    <div class="col-xl-10 col-lg-9 col-sm-10">
        <div class="upload pr-md-4">
            @if (file_exists(public_path('favicon.ico')))
                <input type="file" id="input-file-max-fs" class="dropify dropify-validate-custom" data-upload_filesize_max="1024" data-upload_extention="ico" data-default-file="{{ asset('storage/img/favicon.ico') }}" data-max-file-size="1M" name="img_favicon" />
                @component('components.form-file-view', [
                    'file'          => asset('favicon.ico'),
                    'file_original' => asset('favicon.ico'),
                    'filename'      => 'favicon.ico',
                    'input_id'      => 'img_favicon',
                    'delete_url'    => null,
                ]) 
                @endcomponent
            @else
                <input type="file" id="input-file-max-fs" class="dropify dropify-validate-custom" data-upload_filesize_max="1024" data-upload_extention="ico" data-max-file-size="1M" name="img_favicon" required />
            @endif
        </div>
    </div>
</div>
<div class="form-group row mb-4">
    {!! Form::label("fapp_name", __("$lang.attributes.app_name") . "*", ["class"=>"col-xl-2 col-sm-3 col-sm-2 col-form-label"]) !!}
    <div class="col-xl-10 col-lg-9 col-sm-10">
        {!! Form::text("app_name", null, [
            'id'            => "fapp_name",
            'class'         => "form-control ". ($errors->has('app_name') ? ' is-invalid' : ''),
            'placeholder'   => MyHelper::generate_ph("text", __("$lang.attributes.app_name")),
            'required'
            ]) 
        !!}
        @error('app_name')
            <div class="invalid-feedback" style="display: block;">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="form-group row mb-4">
    {!! Form::label("fapp_region", __("$lang.attributes.app_region") . "*", ["class"=>"col-xl-2 col-sm-3 col-sm-2 col-form-label"]) !!}
    <div class="col-xl-10 col-lg-9 col-sm-10">
        {!! Form::select('app_region', MyHelper::timezone(), null, [
            'id'          => "fapp_region",
            'class'       => "form-control ". ($errors->has('app_region') ? ' is-invalid' : ''),
            'placeholder' => MyHelper::generate_ph("select", __("$lang.attributes.app_region")),
            'required'
            ]) 
        !!}
        @error('app_region')
            <div class="invalid-feedback" style="display: block;">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>