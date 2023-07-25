<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelper;
use App\Helpers\MyHelper;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Repositories\Permission\PermissionInterface;
use App\Repositories\Role\RoleInterface;
use App\Repositories\Setting\SettingInterface;
use App\Services\GeneralSheet;
use App\Traits\ControllerTrait;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use ControllerTrait;
    protected $roleRepo;
    protected $permissionRepo;
    protected $settingRepo;
    protected $modelRepo;
    protected $path     = "pages/role/";
    protected $lang     = "role_lang";
    protected $trash    = true;
    protected $settings = null;
    protected $key      = "roles";
    protected $input    = ['name'];
    protected $attr     = 'name';

    function __construct(RoleInterface $roleRepo, PermissionInterface $permissionRepo, SettingInterface $settingRepo)
    {
        $this->roleRepo       = $roleRepo;
        $this->modelRepo      = $roleRepo;
        $this->permissionRepo = $permissionRepo;
        $this->settingRepo    = $settingRepo;
        if ($settings = $settingRepo->find('key', $this->key)) {
            $this->trash    = $settings->is_trash;
            $this->settings = $settings;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!in_array($request->tab, ['trash', 'all']))
            return redirect()->action('RoleController@index', ['tab' => 'all']);

        $key   = $this->key;
        $trash = $this->trash;
        $conditions = ['with_counting' => ['users', 'permissions']];
        if ($request->tab == 'trash') {
            $conditions['is_trash'] = true;
            $request['order_by'] = $request->order_by ?? 'deleted_at';
            $request['sort_by'] = $request->sort_by ?? 'desc';
        }
        $data = $this->roleRepo->getRequest($request, $conditions);
        return view($this->path . 'index', compact('data', 'trash', 'key'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permissions();
        return view($this->path . 'create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only($this->input);
        try {
            $role = $this->roleRepo->create($input);
            $role->syncPermissions($request->permissions_id);
            MyHelper::flash_notification(false, __($this->lang . '.messages.create.success', ['attr' => $request->name]));
            return redirect()->action('RoleController@show', encrypt($role->id));
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->roleRepo->find('id', decrypt($id));
        if (request()->ajax()) {
            return view($this->path . 'detail.detail-modal', compact('role'));
        } else
            return view($this->path . 'detail.detail', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = $this->permissions();
        $role = $this->roleRepo->find('id', decrypt($id));
        return view($this->path . 'edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $input = $request->only($this->input);
        try {
            $role = $this->roleRepo->find('id', decrypt($id));
            $this->roleRepo->update(decrypt($id), $input);
            $role->syncPermissions($request->permissions_id);
            MyHelper::flash_notification(false, __($this->lang . '.messages.update.success', ['attr' => $request->name]));
            return redirect()->action('RoleController@show', $id);
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepo->find('id', decrypt($id));
        if (!in_array($role->name, \Auth::user()->getRoleNames()->toArray())) {
            if ($this->trash && $role->deleted_at == null) {
                $this->roleRepo->destroy($role->id);
                MyHelper::flash_notification(false, __($this->lang . ".messages.delete.success", ['attr' => $role->name]));
            } else {
                $this->roleRepo->destroyForce($role->id);
                MyHelper::flash_notification(false, __($this->lang . ".messages.delete_force.success", ['attr' => $role->name]));
            }
        } else
            MyHelper::flash_notification(true, __($this->lang . ".messages.delete.failed", ['attr' => $role->name]));
        return redirect()->action('RoleController@index', ['tab' => $role->deleted_at ? 'trash' : 'all']);
    }
    public function destroySelected(Request $request)
    {
        try {
            $dataID  = $request->id;
            $items   = [];
            $success = 0;
            foreach ($dataID as $id) {
                $role = $this->roleRepo->find('id', decrypt($id));
                if (!in_array($role->name, \Auth::user()->getRoleNames()->toArray())) {
                    if ($this->trash && $role->deleted_at == null) {
                        $this->roleRepo->destroy($role->id);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.delete.success', ['attr' => $role->name]));
                    } else {
                        $this->roleRepo->destroyForce($role->id);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.delete_force.success', ['attr' => $role->name]));
                    }
                    $success++;
                }
            }
            if ($success > 0) {
                MyHelper::flash_notification(false, __($this->lang . '.messages.delete.selected.success', ['attr' => $success]), $items);
                $response = APIHelper::createAPIResponse(false, 200, "Delete successfull", $items);
            } else {
                MyHelper::flash_notification(true, __($this->lang . '.messages.delete.selected.failed', ['attr' => $success]), $items);
                $response = APIHelper::createAPIResponse(true, 400, "Delete failed", $items);
            }
            return $response;
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
        }
    }
    public function destroyAll(Request $request)
    {
        try {
            $items      = [];
            $success    = 0;
            $conditions = [];
            if ($request->tab == 'trash')
                $conditions['is_trash'] = true;
            foreach ($this->roleRepo->get($conditions) as $role) {
                if (!in_array($role->name, \Auth::user()->getRoleNames()->toArray())) {
                    if ($this->trash && $role->deleted_at == null) {
                        $this->roleRepo->destroy($role->id);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.delete.success', ['attr' => $role->name]));
                    } else {
                        $this->roleRepo->destroyForce($role->id);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.delete_force.success', ['attr' => $role->name]));
                    }
                    $success++;
                }
            }
            if ($success > 0) {
                MyHelper::flash_notification(false, __($this->lang . '.messages.delete.selected.success', ['attr' => $success]), $items);
            } else {
                MyHelper::flash_notification(true, __($this->lang . '.messages.delete.selected.failed', ['attr' => $success]), $items);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
        }
    }

    private function permissions()
    {
        $result = [];
        $conditions = [
            'order_by' => 'name',
            'sort_by'  => 'asc',
        ];
        $permissions = $this->permissionRepo->get($conditions);
        foreach ($permissions as $permission) {
            $name = $permission->name;
            $menu = explode(".", $name);
            $menu = $menu[0];
            $result[$menu][] = [
                'id'   => $permission->id,
                'name' => $name,
            ];
        }
        return $result;
    }
}
