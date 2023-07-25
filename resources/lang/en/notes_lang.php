<?php

return [
    'pagination'                 => 'Showing :first to :last of :total entries | Page :curren_page to :last_page',
    "validation-file-size-max"   => "Maximum file size <b>:attr</b>.",
    "validation-file-format"     => "<b>File</b> format must be <b>:attr</b>.",
    "validation-column-value"    => "<b>Cell contents</b> must be in text format, other than text formatting is not allowed. Examples of number formats, currency, date, time, percentage are not allowed.",
    "validation-file-size-max"   => "Maximum file size <b>:attr</b>.",
    "validation-file-format"     => "<b>File</b> format must be <b>:attr</b>.",
    "validation-min"             => "<b>:attr</b> must be at least <b>:min</b> characters.",
    "validation-required-update" => "<b>:attr</b> is required (cannot be empty) to update data.",
    "validation-required-column" => "<b>Columns</b> with color <span class='badge badge-primary text-dark' style='background-color: :color'> :color </span> is <b>required</b> (can not be empty).",
    "validation-datetime"        => "The text format for <b>:attr</b> is yyyy-mm-dd H:i:s, example 2022-02-05 09:42:14.",
    'validation' => [
        'required' => 'The :attribute field is required.',
        'unique'   => 'The :attribute must be unique (cannot be the same).',
        'key'      => 'The :attribute becomes <b>primary key</b> in each row.<br>If the database contains the same <b>primary key</b> then the data will be updated, if not found <b>primary key</b> is the same, new data will be stored.',
        'multiple' => "The :attribute field is multiple. Use a comma (,) as a separator.",
        'boolean'  => 'The :attribute field must be 1 or 0.',
        'enum' => 'The :attribute field is :option. <br>:detail',
    ],
];
