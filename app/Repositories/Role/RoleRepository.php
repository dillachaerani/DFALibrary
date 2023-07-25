<?php

namespace App\Repositories\Role;

use Spatie\Permission\Models\Role;
use App\Repositories\Role\RoleInterface;
use App\Traits\BaseQueryTrait;

class RoleRepository implements RoleInterface
{
    protected $role;
    protected $model;
    protected $available_fields = ['name', 'guard_name'];
    use BaseQueryTrait;

    public function __construct(Role $role)
    {
        $this->role = $role;
        // VARIABLE FOR BaseQueryTrait
        $this->model = $role;
    }
    private function getConditions($role, $key, $value)
    {
        if ($key == "name") {
            if (is_array($value))
                $role = $role->whereIn('name', $value);
            else
                $role = $role->where('name', $value);
        }
        return $role;
    }
    public function get($conditions = false)
    {
        $role = $this->role;
        // BASE CONDITION GET DATA
        $role = $this->baseGetConditions($role, $conditions);
        if ($conditions) {
            if (isset($conditions['name'])) {
                $name     = $conditions['name'];
                $role = $this->getConditions($role, 'name', $name);
            }
            $role = $this->baseGetOrderBy($role, $conditions);
            // LIMIT
            // $role = $this->baseGetLimit($role, $conditions);
        } else {
            $role = $role->orderBy('id', 'desc');
        }
        return $role->get();
    }
    public function getRequest($request, $conditions = [])
    {
        $role = $this->role;
        // BASE CONDITION GET DATA
        $role = $this->baseGetConditions($role, $conditions);
        // FILTER
        $role = $this->baseGetOrderByRequest($role, $request);
        return $role->paginate($request->show)->withPath(route($request->route()->getName(), $request->except('page')));
    }
    public function find($keyword, $value)
    {
        $role = $this->role->withTrashed();
        switch ($keyword) {
            case 'id':
                return $role->findOrFail($value);
            case 'name':
                return $role->where('name', $value)->first();
            default:
                return false;
                break;
        }
    }
}
