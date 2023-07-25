<div class="upload pr-md-4">
    @if ($model)
        @if ($model[$field_name] && file_exists(storage_path("app/public/$path/thumbnail/200/" . $model[$field_name])))
            <input type="file" id="{{ $id }}" class="dropify dropify-validate-custom" data-upload_filesize_max="{{ $file_size }}" data-upload_extention="{{ $extention }}" data-default-file="{{ asset("storage/$path/thumbnail/200/" . $model[$field_name]) }}" data-max-file-size="{{ floor($file_size/1000) }}M" name="{{ $input_name }}" />
            @component('components.form-file-view', [
                'file'          => asset("storage/$path/thumbnail/200/" . $model[$field_name]),
                'file_original' => asset("storage/$path/original/" . $model[$field_name]),
                'filename'      => $model[$field_name],
                'delete_url'    => ($delete_url) ? $delete_url : null,
                'input_id'      => $id
            ]) 
            @endcomponent
        @else
            <input type="file" id="{{ $id }}" class="dropify dropify-validate-custom" data-upload_filesize_max="{{ $file_size }}" data-upload_extention="{{ $extention }}" data-max-file-size="{{ floor($file_size/1000) }}M" name="{{ $input_name }}" {{ $required }} />
        @endif
    @else
        <input type="file" id="{{ $id }}" class="dropify dropify-validate-custom" data-upload_filesize_max="{{ $file_size }}" data-upload_extention="{{ $extention }}" data-max-file-size="{{ floor($file_size/1000) }}M" name="{{ $input_name }}" {{ $required }} />
    @endif
    <p class="text-warning"><small><strong>*{!! __('notes_lang.validation-file-size-max', ['attr'=> $file_size . 'KB']) !!}</strong></small></p>
</div>