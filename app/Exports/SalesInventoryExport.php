<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SalesInventoryExport implements FromCollection, WithMapping, WithHeadings, WithEvents
{
    protected $data;
    protected $total;
    
    public function __construct($data)
    {
        $this->data = $data;
        $this->total = 0;
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($data): array
    {
        $this->total += $data->subtotal;

        return [
            $data->trans_num,
            $data->trans_date,
            $data->name,
            $data->inventory_type,
            $data->quantity,
            $data->price,
            $data->subtotal
        ];
    }

    public function headings(): array
    {
        return ['Nomor Transaksi', 'Tanggal', 'Item', 'Jenis Inventory', 'Quantity', 'Harga', 'Subtotal'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->append([
                    '',
                    '',
                    '',
                    '',
                    '',
                    'Total Omzet',
                    $this->total,
                ]);
            },
        ];
    }
}
