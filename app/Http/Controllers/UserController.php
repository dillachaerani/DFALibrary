<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelper;
use App\Helpers\MyHelper;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Setting;
use App\Repositories\Setting\SettingInterface;
use App\Repositories\User\UserInterface;
use App\Services\GeneralSheet;
use App\Traits\ControllerTrait;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ControllerTrait;
    protected $userRepo;
    protected $settingRepo;
    protected $modelRepo;
    protected $path     = "pages/user/";
    protected $lang     = "user_lang";
    protected $trash    = true;
    protected $settings = null;
    protected $key      = "users"; // key for permission, key trash, etc
    protected $input    = ['name', 'email', 'password', 'username'];
    protected $attr     = 'name';
    // RULES UPLOAD IMAGE
    protected $imgName  = "avatar";
    protected $imgPath  = "uploads/users"; // path img public/storage/$imgPath
    protected $imgSizes = [40, 200, 500, 1000]; // size img thumbnails
    use UploadImage;

    function __construct(UserInterface $userRepo, SettingInterface $settingRepo)
    {
        $this->userRepo    = $userRepo;
        $this->modelRepo   = $userRepo;
        $this->settingRepo = $settingRepo;
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
            return redirect()->action('UserController@index', ['tab' => 'all']);

        $key   = $this->key;
        $trash = $this->trash;
        $conditions = ['with_counting' => 'roles'];
        if ($request->tab == 'trash') {
            $conditions['is_trash'] = true;
            $request['order_by'] = $request->order_by ?? 'deleted_at';
            $request['sort_by'] = $request->sort_by ?? 'desc';
        }
        $data = $this->userRepo->getRequest($request, $conditions);
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
            if ($request->file('upload_avatar')) {
                $avatar = $this->storeImage($request->file('upload_avatar'), $this->imgPath,  $this->imgName, $this->imgSizes);
                $input['avatar'] = $avatar;
            }
            if ($request->has('is_verified'))
                $input['email_verified_at'] = now();

            $input['is_active'] = ($request->has('is_active')) ? $request->is_active : false;
            $user  = $this->userRepo->create($input);
            // SYNC ROLES
            $user->syncRoles(($request->has('roles')) ? $request->roles : []);
            MyHelper::flash_notification(false, __($this->lang . '.messages.create.success', ['attr' => $request->username]));
            return redirect()->action('UserController@show', encrypt($user->id));
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
        $user = $this->userRepo->find('id', decrypt($id));
        if (request()->ajax()) {
            return view($this->path . 'detail.detail-modal', compact('user'));
        } else
            return view($this->path . 'detail.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepo->find('id', decrypt($id));
        $user['roles'] = $user->getRoleNames()->toArray();
        return view($this->path . 'edit', compact('user'));
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
            $user = $this->userRepo->find('id', decrypt($id));
            if ($request->file('upload_avatar')) {
                if ($user->avatar)
                    $this->deleteImage($this->imgPath, $user->avatar, $this->imgSizes);
                $avatar = $this->storeImage($request->file('upload_avatar'), $this->imgPath,  $this->imgName, $this->imgSizes);
                $input['avatar'] = $avatar;
            }
            if ($request->has('is_verified')) {
                if (!$user->email_verified_at)
                    $input['email_verified_at'] = now();
            } else
                $input['email_verified_at'] = null;

            if ($request->has('is_active'))
                $input['is_active'] = true;
            else {
                if (\Auth::user()->hasRole('developer'))
                    $input['is_active'] = false;
                else {
                    if (!$user->hasRole('developer') && \Auth::user()->id != $user->id)
                        $input['is_active'] = false;
                }
            }
            $this->userRepo->update(decrypt($id), $input);
            // SYNC ROLES
            $user->syncRoles(($request->has('roles')) ? $request->roles : []);
            MyHelper::flash_notification(false, __($this->lang . '.messages.update.success', ['attr' => $request->username]));
            return redirect()->action('UserController@show', $id);
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
        $user = $this->userRepo->find('id', decrypt($id));
        if ($user->hasRole('developer') || \Auth::user()->id == $user->id) {
            MyHelper::flash_notification(true, __($this->lang . ".messages.delete.failed", ['attr' => $user->username]));
            return redirect()->back();
        } else {
            if ($this->trash && $user->deleted_at == null) {
                $this->userRepo->destroy($user->id);
                MyHelper::flash_notification(false, __($this->lang . ".messages.delete.success", ['attr' => $user->username]));
            } else {
                $this->userRepo->destroyForce($user->id);
                // Remove image
                if ($user->avatar)
                    $this->deleteImage($this->imgPath, $user->avatar, $this->imgSizes);
                MyHelper::flash_notification(false, __($this->lang . ".messages.delete_force.success", ['attr' => $user->username]));
            }
            return redirect()->action('UserController@index', ['tab' => $user->deleted_at ? 'trash' : 'all']);
        }
    }
    public function destroySelected(Request $request)
    {
        try {
            $dataID  = $request->id;
            $items   = [];
            $success = 0;
            foreach ($dataID as $id) {
                $user = $this->userRepo->find('id', decrypt($id));
                if ($user->hasRole('developer') || \Auth::user()->id == $user->id) {
                    $items[] = MyHelper::flash_notification_item(true, __($this->lang . '.messages.delete.failed', ['attr' => $user->username]));
                } else {
                    if ($this->trash && $user->deleted_at == null) {
                        $this->userRepo->destroy($user->id);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.delete.success', ['attr' => $user->username]));
                    } else {
                        $this->userRepo->destroyForce($user->id);
                        // Remove image
                        if ($user->avatar)
                            $this->deleteImage($this->imgPath, $user->avatar, $this->imgSizes);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.delete_force.success', ['attr' => $user->username]));
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
            foreach ($this->userRepo->get($conditions) as $user) {
                if ($user->hasRole('developer') || \Auth::user()->id == $user->id) {
                    $items[] = MyHelper::flash_notification_item(true, __($this->lang . '.messages.delete.failed', ['attr' => $user->username]));
                } else {
                    if ($this->trash && $user->deleted_at == null) {
                        $this->userRepo->destroy($user->id);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.delete.success', ['attr' => $user->username]));
                    } else {
                        $this->userRepo->destroyForce($user->id);
                        // Remove image
                        if ($user->avatar)
                            $this->deleteImage($this->imgPath, $user->avatar, $this->imgSizes);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.delete_force.success', ['attr' => $user->username]));
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

    // verification
    public function verification($id)
    {
        try {
            $item = $this->modelRepo->find('id', decrypt($id));
            if (!$item->email_verified_at) {
                $this->modelRepo->update($item->id, ['email_verified_at' => now()]);
                MyHelper::flash_notification(false, __($this->lang . '.messages.verification.success', ['attr' => $item[$this->attr]]));
            } else if ($item->email_verified_at) {
                $this->modelRepo->update($item->id, ['email_verified_at' => null]);
                MyHelper::flash_notification(false, __($this->lang . '.messages.unverification.success', ['attr' => $item[$this->attr]]));
            }
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
            MyHelper::flash_notification(true, __('Process is Fail!'));
        }
        return redirect()->back();
    }
    public function verificationSelected(Request $request)
    {
        try {
            $dataID  = $request->id;
            $items   = [];
            $success = 0;
            $type    = $request->type;
            foreach ($dataID as $id) {
                $item = $this->modelRepo->find('id', decrypt($id));
                if ($type == "verification") {
                    if (!$item->email_verified_at) {
                        $this->modelRepo->update($item->id, ['email_verified_at' => now()]);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.verification.success', ['attr' => $item[$this->attr]]));
                        $success++;
                    }
                } else if ($type == "unverification") {
                    if ($item->email_verified_at) {
                        $this->modelRepo->update($item->id, ['email_verified_at' => null]);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.unverification.success', ['attr' => $item[$this->attr]]));
                        $success++;
                    }
                }
            }
            if ($success > 0) {
                MyHelper::flash_notification(false, __($this->lang . ".messages.$type.selected.success", ['attr' => $success]), $items);
                $response = APIHelper::createAPIResponse(false, 200, "Process is Success!", $items);
            } else {
                MyHelper::flash_notification(true, __($this->lang . ".messages.$type.selected.failed", ['attr' => $success]), $items);
                $response = APIHelper::createAPIResponse(true, 400, "Process is Fail!", $items);
            }
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
            MyHelper::flash_notification(true, __('Process is Fail!'));
            $response = APIHelper::createAPIResponse(true, 400, "Process is Fail!", $items);
        }
        return $response;
    }
    public function verificationAll(Request $request)
    {
        try {
            $items      = [];
            $success    = 0;
            $conditions = [];
            $type       = $request->type;
            if ($request->tab == 'trash')
                $conditions['is_trash'] = true;
            foreach ($this->modelRepo->get($conditions) as $item) {
                if ($type == "verification") {
                    if (!$item->email_verified_at) {
                        $this->modelRepo->update($item->id, ['email_verified_at' => now()]);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.verification.success', ['attr' => $item[$this->attr]]));
                        $success++;
                    }
                } else if ($type == "unverification") {
                    if ($item->email_verified_at) {
                        $this->modelRepo->update($item->id, ['email_verified_at' => null]);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.unverification.success', ['attr' => $item[$this->attr]]));
                        $success++;
                    }
                }
            }
            if ($success > 0) {
                MyHelper::flash_notification(false, __($this->lang . ".messages.$type.selected.success", ['attr' => $success]), $items);
            } else {
                MyHelper::flash_notification(true, __($this->lang . ".messages.$type.selected.failed", ['attr' => $success]), $items);
            }
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
            MyHelper::flash_notification(true, __('Process is Fail!'));
        }
        return redirect()->back();
    }
}
