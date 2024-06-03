<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class TicketPresalesExport implements FromCollection, WithMapping, WithHeadings, WithEvents
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
        $this->total += $data->price;

        return[
            $data->presale->code,
            $data->serial_number,
            $data->category->name,
            $data->sold_date,
            $data->price,
        ];
    }

    public function headings(): array
    {
        return ['Kode Batch', 'Serial Number', 'Kategori', 'Tanggal', 'Harga'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->append([
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
