<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class RefundExport implements FromCollection, WithMapping, WithHeadings, WithEvents
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
        $this->total += $data->refund;

        return[
            $data->trans_num,
            $data->start_date,
            $data->trans_via,
            ucwords(strtolower($data->wahana->name)),
            $data->room->name,
            $data->price,
            $data->night_count,
            $data->subtotal,
            ($data->refund_status !== null) ? 'Selesai' : 'Belum Selesai',
            ($data->refund_date !== null) ? $data->refund_date : '-',
            $data->refund
        ];
    }

    public function headings(): array
    {
        return ['Nomor Tiket', 'Tanggal', 'Via', 'Paket', 'Tenda', 'Harga', 'Malam', 'Subtotal', 'Status', 'Tanggal Refund', 'Refund'];
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
                    '',
                    '',
                    '',
                    '',
                    'Total Refund',
                    $this->total,
                ]);
            },
        ];
    }
}
