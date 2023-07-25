<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelper;
use App\Helpers\MyHelper;
use App\Http\Requests\Permission\StoreRequest;
use App\Http\Requests\Permission\UpdateRequest;
use App\Repositories\Permission\PermissionInterface;
use App\Repositories\Setting\SettingInterface;
use App\Services\GeneralSheet;
use App\Traits\ControllerTrait;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use ControllerTrait;
    protected $permissionRepo;
    protected $settingRepo;
    protected $modelRepo;
    protected $path     = "pages/permission/";
    protected $lang     = "permission_lang";
    protected $trash    = true;
    protected $settings = null;
    protected $key      = "permissions";
    protected $input    = ['name'];
    protected $attr     = 'name';

    function __construct(PermissionInterface $permissionRepo, SettingInterface $settingRepo)
    {
        $this->permissionRepo = $permissionRepo;
        $this->modelRepo      = $permissionRepo;
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
            return redirect()->action('PermissionController@index', ['tab' => 'all']);

        $key        = $this->key;
        $trash      = $this->trash;
        $conditions = ['with_counting' => 'roles'];
        if ($request->tab == 'trash') {
            $conditions['is_trash'] = true;
            $request['order_by'] = $request->order_by ?? 'deleted_at';
            $request['sort_by'] = $request->sort_by ?? 'desc';
        }
        $data = $this->permissionRepo->getRequest($request, $conditions);
        return view($this->path . 'index', compact('data', 'trash', 'key'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path . 'create');
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
            $this->permissionRepo->create($input);
            MyHelper::flash_notification(false, __($this->lang . '.messages.create.success', ['attr' => $request->name]));
            return redirect()->action('PermissionController@index', ['tab' => 'all']);
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
        $permission = $this->permissionRepo->find('id', decrypt($id));
        if (request()->ajax()) {
            return view($this->path . 'detail.detail-modal', compact('permission'));
        } else
            return view($this->path . 'detail.detail', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->permissionRepo->find('id', decrypt($id));
        return view($this->path . 'edit', compact('permission'));
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
            $permission = $this->permissionRepo->find('id', decrypt($id));
            $this->permissionRepo->update(decrypt($id), $input);
            MyHelper::flash_notification(false, __($this->lang . '.messages.update.success', ['attr' => $request->name]));
            return redirect()->action('PermissionController@index', ['tab' => $permission->deleted_at ? 'trash' : 'all']);
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
        $permission = $this->permissionRepo->find('id', decrypt($id));
        if ($this->trash && $permission->deleted_at == null) {
            $this->permissionRepo->destroy($permission->id);
            MyHelper::flash_notification(false, __($this->lang . ".messages.delete.success", ['attr' => $permission->name]));
        } else {
            $this->permissionRepo->destroyForce($permission->id);
            MyHelper::flash_notification(false, __($this->lang . ".messages.delete_force.success", ['attr' => $permission->name]));
        }
        return redirect()->action('PermissionController@index', ['tab' => $permission->deleted_at ? 'trash' : 'all']);
    }
    public function destroySelected(Request $request)
    {
        try {
            $dataID  = $request->id;
            $items   = [];
            $success = 0;
            foreach ($dataID as $id) {
                $permission = $this->permissionRepo->find('id', decrypt($id));
                if ($this->trash && $permission->deleted_at == null) {
                    $this->permissionRepo->destroy($permission->id);
                    $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.delete.success', ['attr' => $permission->name]));
                } else {
                    $this->permissionRepo->destroyForce($permission->id);
                    $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.delete_force.success', ['attr' => $permission->name]));
                }
                $success++;
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
            foreach ($this->permissionRepo->get($conditions) as $permission) {
                if ($this->trash && $permission->deleted_at == null) {
                    $this->permissionRepo->destroy($permission->id);
                    $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.delete.success', ['attr' => $permission->name]));
                } else {
                    $this->permissionRepo->destroyForce($permission->id);
                    $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.delete_force.success', ['attr' => $permission->name]));
                }
                $success++;
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
}
