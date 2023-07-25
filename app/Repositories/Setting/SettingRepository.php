<?php

namespace App\Repositories\Setting;

use App\Models\Setting;
use App\Repositories\Setting\SettingInterface;
use App\Traits\BaseQueryTrait;

class SettingRepository implements SettingInterface
{
    protected $setting;
    protected $model;
    protected $available_fields = ['key', 'is_trash', 'sheet_id', 'last_sync'];
    use BaseQueryTrait;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
        // VARIABLE FOR BaseQueryTrait
        $this->model = $setting;
    }
    private function getConditions($setting, $key, $value)
    {
        return $setting;
    }
    public function get($conditions = false)
    {
        $setting = $this->setting;
        // BASE CONDITION GET DATA
        $setting = $this->baseGetConditions($setting, $conditions);
        if ($conditions) {
            $setting = $this->baseGetOrderBy($setting, $conditions);
            // LIMIT
            // $setting = $this->baseGetLimit($setting, $conditions);
        } else {
            $setting = $setting->orderBy('id', 'desc');
        }
        return $setting->get();
    }
    public function getRequest($request, $conditions = [])
    {
        $setting = $this->setting;
        // BASE CONDITION GET DATA
        $setting = $this->baseGetConditions($setting, $conditions);
        // FILTER
        $setting = $this->baseGetOrderByRequest($setting, $request);
        return $setting->paginate($request->show)->withPath(route($request->route()->getName(), $request->except('page')));
    }
    public function find($keyword, $value)
    {
        $setting = $this->setting->withTrashed();
        switch ($keyword) {
            case 'id':
                return $setting->findOrFail($value);
            case 'key':
                return $setting->where('key', $value)->first();
            default:
                return false;
                break;
        }
    }
}
