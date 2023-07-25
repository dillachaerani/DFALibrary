<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserInterface;
use App\Traits\BaseQueryTrait;

class UserRepository implements UserInterface
{
    protected $user;
    protected $model;
    protected $available_fields = ['name', 'email', 'username', 'email_verified_at'];
    use BaseQueryTrait;

    public function __construct(User $user)
    {
        $this->user = $user;
        // VARIABLE FOR BaseQueryTrait
        $this->model = $user;
    }
    private function getConditions($user, $key, $value)
    {
        if ($key == "name") {
            if (is_array($value))
                $user = $user->whereIn('name', $value);
            else
                $user = $user->where('name', $value);
        } else if ($key == "slug") {
            if (is_array($value))
                $user = $user->whereIn('slug', $value);
            else
                $user = $user->where('slug', $value);
        } else if ($key == "username") {
            if (is_array($value))
                $user = $user->whereIn('username', $value);
            else
                $user = $user->where('username', $value);
        } else if ($key == "is_active") {
            $user = $user->where('is_active', $value);
        } else if ($key == "email_verified_at") {
            if ($value)
                $user = $user->WhereNotNull('email_verified_at');
            else
                $user = $user->WhereNull('email_verified_at');
        } else if ($key == "roles") {
            if (is_array($value)) {
                if (in_array('null', $value) && count($value) == 1)
                    $user = $user->doesnthave('roles');
                elseif (!in_array('null', $value))
                    $user = $user->whereHas('roles', function ($query) use ($value) {
                        $query->whereIn('name', $value);
                    });
                else
                    $user = $user->doesntHave('roles')->orWhereHas('roles', function ($query) use ($value) {
                        $query->whereIn('name', $value);
                    });
            } else {
                if ($value == null)
                    $user = $user->doesnthave('roles');
                else
                    $user = $user->whereHas('roles', function ($query) use ($value) {
                        $query->where('name', $value);
                    });
            }
        }
        return $user;
    }
    public function get($conditions = false)
    {
        $user = $this->user;
        // BASE CONDITION GET DATA
        $user = $this->baseGetConditions($user, $conditions);
        if ($conditions) {
            if (isset($conditions['roles'])) {
                $roles = $conditions['roles'];
                $user = $this->getConditions($user, 'roles', $roles);
            }
            if (isset($conditions['name'])) {
                $name     = $conditions['name'];
                $user = $this->getConditions($user, 'name', $name);
            }
            if (isset($conditions['slug'])) {
                $slug     = $conditions['slug'];
                $user = $this->getConditions($user, 'slug', $slug);
            }
            if (isset($conditions['username'])) {
                $username     = $conditions['username'];
                $user = $this->getConditions($user, 'username', $username);
            }
            if (isset($conditions['is_active'])) {
                $is_active = $conditions['is_active'];
                $user  = $this->getConditions($user, 'is_active', $is_active);
            }
            $user = $this->baseGetOrderBy($user, $conditions);
            // LIMIT
            // $user = $this->baseGetLimit($user, $conditions);
        } else {
            $user = $user->orderBy('id', 'desc');
        }
        return $user->get();
    }
    public function getRequest($request, $conditions = [])
    {
        $user = $this->user;
        // BASE CONDITION GET DATA
        $user = $this->baseGetConditions($user, $conditions);
        // FILTER
        if ($request->roles) {
            $roles = $request->roles;
            $user = $this->getConditions($user, 'roles', $roles);
        }
        if (in_array($request->is_active, ['0', '1'])) {
            $is_active = $request->is_active;
            $user  = $this->getConditions($user, 'is_active', $is_active);
        }
        if (in_array($request->email_verified_at, ['0', '1'])) {
            $email_verified_at = $request->email_verified_at;
            $user  = $this->getConditions($user, 'email_verified_at', $email_verified_at);
        }
        $user = $this->baseGetOrderByRequest($user, $request);
        return $user->paginate($request->show)->withPath(route($request->route()->getName(), $request->except('page')));
    }
    public function find($keyword, $value)
    {
        $user = $this->user->withTrashed();
        switch ($keyword) {
            case 'id':
                return $user->findOrFail($value);
            case 'name':
                return $user->where('name', $value)->first();
            case 'username':
                return $user->where('username', $value)->first();
            default:
                return false;
                break;
        }
    }
}
