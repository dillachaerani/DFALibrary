<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $casts = [
        'last_sync' => 'datetime',
        'last_sync_import' => 'datetime',
    ];

    public function setSheetIdAttribute($value)
    {
        $this->attributes['sheet_id'] = $value;
        if (!$value)
            $this->attributes['last_sync'] = null;
    }
}
