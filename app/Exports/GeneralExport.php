<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class GeneralExport implements FromView, ShouldAutoSize
{
    protected $type;
    protected $data;
    protected $page;
    protected $part;
    protected $maxRow;

    public function __construct($data, $type, $page, $part = 0, $maxRow = 0)
    {
        $this->type   = $type;
        $this->data   = $data;
        $this->page   = $page;
        $this->part   = $part;
        $this->maxRow = $maxRow;
    }
    public function view(): View
    {
        $type   = $this->type;
        $data   = $this->data;
        $part   = $this->part;
        $maxRow = $this->maxRow;
        return view($this->page, compact('data', 'type', 'part', 'maxRow'));
    }
}
