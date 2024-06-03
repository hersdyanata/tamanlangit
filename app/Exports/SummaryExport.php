<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SummaryExport implements FromCollection, WithHeadings
{
    protected $data;
    
    public function __construct($data)
    {
        $this->data = collect([
            ['Kategori' => 'Reservasi', 'Income' => $data->reservasi],
            ['Kategori' => 'Tiket Presale', 'Income' => $data->ticketPresale],
            ['Kategori' => 'Tiket Direct', 'Income' => $data->ticketDirect],
            ['Kategori' => 'Inventory', 'Income' => $data->inventory],
            ['Kategori' => 'Total', 'Income' => $data->total],
        ]);
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return ['Kategori', 'Income'];
    }
}
