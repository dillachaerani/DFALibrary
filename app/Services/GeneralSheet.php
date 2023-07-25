<?php

namespace App\Services;

use App\Traits\GoogleSheetTrait;
use Google_Client;
use Google_Service_Sheets;

class GeneralSheet
{
    protected $spreadSheetId;
    protected $client;
    protected $googleSheetService;
    protected $sheetName = "DatabaseWeb";
    protected $rowData   = 2; // Start row data
    use GoogleSheetTrait;

    public function __construct($id)
    {
        $this->spreadSheetId = $id;

        $this->client = new Google_Client();
        $this->client->setAuthConfig(storage_path('credentials.json'));
        $this->client->addScope("https://www.googleapis.com/auth/spreadsheets");

        $this->googleSheetService = new Google_Service_Sheets($this->client);
    }
}
