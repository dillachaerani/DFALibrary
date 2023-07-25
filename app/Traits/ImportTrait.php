<?php

namespace App\Traits;

use App\Helpers\APIHelper;
use App\Imports\GeneralImport;
use Illuminate\Http\Request;

trait ImportTrait
{
    public function import()
    {
        $importFileSize = $this->importFileSize;
        $input          = $this->importInput;
        return view($this->path . 'import.import', compact('importFileSize', 'input'));
    }
    public function importGenerate(Request $request)
    {
        $validate = [
            'file' => 'required|max:' . $this->importFileSize
        ];
        $dataImport = $this->dataImport($request, $validate, $this->rowHeading);
        if (count($dataImport) > 0) {
            activity()->useLog($this->key)->withProperties($dataImport)->log('import');
            return APIHelper::createAPIResponse(false, 200, "Data import is ready", $dataImport);
        } else {
            return APIHelper::createAPIResponse(true, 404, "Data import is null", null);
        }
    }
    public function dataImport($request, $validate, $rowHeading = 1)
    {
        $result['new']      = $result['update'] = $result['failed'] = [];
        $result['total']    = 0;
        $this->validate($request, $validate);
        $file   = request()->file('file');
        $data   = (new GeneralImport($rowHeading))->toArray($file);
        return [
            'filename'      => request()->file('file')->getClientOriginalName(),
            'header_at_row' => $rowHeading,
            'total'         => count($data[0]),
            'items'         => $data[0],
        ];
    }
}
