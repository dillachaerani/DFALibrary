<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelper;
use App\Repositories\Setting\SettingInterface;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $settingRepo;
    protected $input = ['key', 'is_trash'];
    function __construct(SettingInterface $settingRepo)
    {
        $this->settingRepo = $settingRepo;
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
        if (request()->ajax()) {
            $input = $request->only($this->input);
            if ($request->has('key')) {
                $key = decrypt($request->key);
                $param = [
                    'key' => $key
                ];
                $input = [
                    'key'      => $key,
                    'is_trash' => $request->is_trash,
                ];
                $this->settingRepo->updateOrCreate($param, $input);
                $response = APIHelper::createAPIResponse(false, 200, "Succes Saved", $input);
            } else
                $response = APIHelper::createAPIResponse(true, 400, "Succes Saved", $input);
            return $response;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
