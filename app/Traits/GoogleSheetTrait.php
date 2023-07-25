<?php

namespace App\Traits;

use Google_Service_Sheets_ClearValuesRequest;
use Google_Service_Sheets_ValueRange;

trait GoogleSheetTrait
{
    public function readGoogleSheet()
    {
        $dimensions = $this->getDimensions($this->spreadSheetId);
        if (!$dimensions['error']) {
            $range = $this->sheetName . '!A1:' . $dimensions['colCount'];
            $data = $this->googleSheetService
                ->spreadsheets_values
                ->batchGet($this->spreadSheetId, ['ranges' => $range]);
            return $data->getValueRanges()[0]->values;
        }
        return [];
    }

    public function clearGoogleSheet()
    {
        $dimensions = $this->getDimensions($this->spreadSheetId);
        if (!$dimensions['error']) {
            if ($dimensions['rowCount'] >= $this->rowData) {
                $range = $this->sheetName . '!A1:' . $dimensions['colCount'] . $dimensions['rowCount'];
                $requestBody = new Google_Service_Sheets_ClearValuesRequest();
                $this->googleSheetService->spreadsheets_values->clear($this->spreadSheetId, $range, $requestBody);
                return $range;
            }
        }
        return false;
    }

    public function saveDataToSheet(array $data, $clearSheet = false)
    {
        $dimensions = $this->getDimensions($this->spreadSheetId);
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $data
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED',
        ];
        if ($clearSheet)
            $range = "A1";
        else {
            if (isset($dimensions['rowCount']))
                $range = "A" . ($dimensions['rowCount'] + 1);
            else
                $range = "A1";
        }
        return $this->googleSheetService
            ->spreadsheets_values
            ->update($this->spreadSheetId, $range, $body, $params);
        return false;
    }

    private function getDimensions($spreadSheetId)
    {
        $rowDimensions = $this->googleSheetService->spreadsheets_values->batchGet(
            $spreadSheetId,
            ['ranges' => $this->sheetName . '!A:A', 'majorDimension' => 'COLUMNS']
        );

        //if data is present at nth row, it will return array till nth row
        //if all column values are empty, it returns null
        $rowMeta = $rowDimensions->getValueRanges()[0]->values;
        if (!$rowMeta) {
            return [
                'error' => true,
                'message' => 'missing row data'
            ];
        }

        $colDimensions = $this->googleSheetService->spreadsheets_values->batchGet(
            $spreadSheetId,
            ['ranges' => $this->sheetName . '!1:1', 'majorDimension' => 'ROWS']
        );

        //if data is present at nth col, it will return array till nth col
        //if all column values are empty, it returns null
        $colMeta = $colDimensions->getValueRanges()[0]->values;
        if (!$colMeta) {
            return [
                'error' => true,
                'message' => 'missing row data'
            ];
        }

        return [
            'error' => false,
            'rowCount' => count($rowMeta[0]),
            'colCount' => $this->colLengthToColumnAddress(count($colMeta[0]))
        ];
    }

    private function colLengthToColumnAddress($number)
    {
        if ($number <= 0) return null;

        $letter = '';
        while ($number > 0) {
            $temp = ($number - 1) % 26;
            $letter = chr($temp + 65) . $letter;
            $number = ($number - $temp - 1) / 26;
        }
        return $letter;
    }
}
