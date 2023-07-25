<?php

namespace App\Http\Controllers;

use App\Helpers\MyHelper;
use App\Traits\UploadFile;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    protected $userRepo;
    protected $path  = "pages/app/";
    protected $lang  = "app_lang";
    protected $trash = true;
    protected $input = ['app_name', 'app_locale', 'app_region'];

    use UploadFile;

    function __construct()
    {
        // set middleware
        $this->middleware('permission:app.update', ['only' => ['index', 'store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app = [
            'app_name'   => config('app.name'),
            'app_locale' => config('app.locale'),
            'app_region' => config('app.region'),
        ];
        return view($this->path . 'edit', compact('app'));
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
        $input = $request->only($this->input);
        try {
            if ($request->file('img_favicon')) {
                if (file_exists(public_path('favicon.ico')))
                    $this->deleteFile(public_path(), 'favicon.ico');
                $this->storeFile($request->file('img_favicon'), public_path(),  'favicon');
            }
            $this->updateDotEnv($input);
            MyHelper::flash_notification(false, __($this->lang . '.messages.update.success', ['attr' => $request->name]));
            return redirect()->action('AppSettingController@index');
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
        }
    }

    private function updateDotEnv($request)
    {
        $path     = base_path('.env');
        foreach ($request as $key => $value) {
            $oldValue = config(str_replace('_', '.', $key));
            $newValue = $value;
            $envKey   = strtoupper($key);
            // rewrite file content with changed data
            if (file_exists($path)) {
                // replace current value with new value 
                file_put_contents(
                    $path,
                    str_replace(
                        $envKey . '="' . $oldValue . '"',
                        $envKey . '="' . $newValue . '"',
                        file_get_contents($path)
                    )
                );
            }
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
