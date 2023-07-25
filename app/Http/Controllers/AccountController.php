<?php

namespace App\Http\Controllers;

use App\Helpers\MyHelper;
use App\Http\Requests\Account\UpdateRequest as AccountUpdateRequest;
use App\Repositories\User\UserInterface;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $userRepo;
    protected $path  = "pages/account/";
    protected $lang  = "account_lang";
    protected $trash = true;
    protected $input = ['name', 'email', 'password', 'username'];
    // RULES UPLOAD IMAGE
    protected $imgName  = "avatar";
    protected $imgPath  = "uploads/users"; // path img public/storage/$imgPath
    protected $imgSizes = [40, 200, 500, 1000]; // size img thumbnails
    use UploadImage;
    
    function __construct(UserInterface $userRepo)
    {
        // set middleware
        $this->middleware('permission:accounts.index', ['only' => ['show']]);
        $this->middleware('permission:accounts.update', ['only' => ['edit', 'update', 'removeImage']]);

        $this->userRepo    = $userRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $id = encrypt(\Auth::user()->id);
        $user = $this->userRepo->find('id', decrypt($id));
        return view($this->path . 'edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountUpdateRequest $request, $id)
    {
        $input = $request->only($this->input);
        try {
            $id = encrypt(\Auth::user()->id);
            $user = $this->userRepo->find('id', decrypt($id));
            if ($request->file('img_avatar')) {
                if ($user->avatar)
                    $this->deleteImage($this->imgPath, $user->avatar, $this->imgSizes);
                $avatar = $this->storeImage($request->file('img_avatar'), $this->imgPath,  $this->imgName, $this->imgSizes);
                $input['avatar'] = $avatar;
            }
            if ($request->email != $user->email)
                $input['email_verified_at'] = null;
            $this->userRepo->update(decrypt($id), $input);

            MyHelper::flash_notification(false, __($this->lang . '.messages.update.success', ['attr' => $request->username]));
            return redirect()->action('AccountController@show', $id);
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
        //
    }
    public function removeImage($id)
    {
        $user = $this->userRepo->find('id', decrypt($id));
        if ($user) {
            if ($user->avatar) {
                $this->deleteImage($this->imgPath, $user->avatar, $this->imgSizes);
                $this->userRepo->update(decrypt($id), ['avatar' => null]);
                return redirect()->back();
            }
        }
        return abort(404, "Image not founde");
    }
}
