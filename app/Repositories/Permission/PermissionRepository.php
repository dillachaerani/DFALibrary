<?php

namespace App\Repositories\Permission;

use Spatie\Permission\Models\Permission;
use App\Repositories\Permission\PermissionInterface;
use App\Traits\BaseQueryTrait;

class PermissionRepository implements PermissionInterface
{
    protected $permission;
    protected $model;
    protected $available_fields = ['name', 'guard_name'];
    use BaseQueryTrait;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
        // VARIABLE FOR BaseQueryTrait
        $this->model = $permission;
    }
    private function getConditions($permission, $key, $value)
    {
        if ($key == "name") {
            if (is_array($value))
                $permission = $permission->whereIn('name', $value);
            else
                $permission = $permission->where('name', $value);
        }
        return $permission;
    }
    public function get($conditions = false)
    {
        $permission = $this->permission;
        // BASE CONDITION GET DATA
        $permission = $this->baseGetConditions($permission, $conditions);
        if ($conditions) {
            if (isset($conditions['name'])) {
                $name     = $conditions['name'];
                $permission = $this->getConditions($permission, 'name', $name);
            }
            $permission = $this->baseGetOrderBy($permission, $conditions);
            // LIMIT
            // $permission = $this->baseGetLimit($permission, $conditions);
        } else {
            $permission = $permission->orderBy('id', 'desc');
        }
        return $permission->get();
    }
    public function getRequest($request, $conditions = [])
    {
        $permission = $this->permission;
        // BASE CONDITION GET DATA
        $permission = $this->baseGetConditions($permission, $conditions);
        // FILTER
        $permission = $this->baseGetOrderByRequest($permission, $request);
        return $permission->paginate($request->show)->withPath(route($request->route()->getName(), $request->except('page')));
    }
    public function find($keyword, $value)
    {
        $permission = $this->permission->withTrashed();
        switch ($keyword) {
            case 'id':
                return $permission->findOrFail($value);
            case 'name':
                return $permission->where('name', $value)->first();
            default:
                return false;
                break;
        }
    }
}
