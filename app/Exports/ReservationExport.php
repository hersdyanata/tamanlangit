<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use App\Models\ReservationExtraServices;
use Illuminate\Support\Facades\Log;


class ReservationExport implements FromCollection, WithMapping, WithHeadings, WithEvents
{
    protected $data;
    protected $totalOmzetAfterDiscount;
    protected $totalOmzetBeforeDiscount;
    
    public function __construct($data)
    {
        $this->data = $data;
        $this->totalOmzetBeforeDiscount = 0;
        $this->totalOmzetAfterDiscount = 0;
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($data): array
    {
        $subtotalBeforeDiscount = $data->subtotal + $data->ppn_amount + $data->extra_bill;
        $subtotalAfterDiscount = $data->omzet + $data->extra_bill;

        $this->totalOmzetBeforeDiscount += $subtotalBeforeDiscount;
        $this->totalOmzetAfterDiscount += $subtotalAfterDiscount;

        $extra = '';
        if(isset($data->extras)){
            foreach($data->extras as $r){
                if($r->type === 'person'){
                    $extra .= 'Anggota ('.$r->quantity.' x '.number_format($r->price).')'."\n";
                }else{
                    $inventoryType = ($r->stock->product->inventory_type === 'loan') ? 'Sewa' : 'Beli';
                    $extra .= $inventoryType . ' ' . ucwords(strtolower($r->stock->product->name)) . ' ('. $r->quantity . ' x ' . number_format($r->price) . ')'."\n";
                }
            }
        }

        $extra = str_replace("\n", "\r\n", $extra); // Ensure new lines are correctly interpreted in CSV

        return[
            $data->trans_num,
            $data->start_date,
            $data->trans_via,
            $data->reservation_status,
            $data->payment_status,
            ucwords(strtolower($data->wahana->name)),
            $data->room->name,
            $data->price,
            $data->night_count,
            $data->subtotal,
            $data->ppn,
            $data->ppn_amount,
            $data->discount_amount,
            $extra, // Ensure new lines are correctly interpreted in CSV
            $data->extra_bill,
            $data->subtotal + $data->ppn_amount + $data->extra_bill, // omzet sebelum diskon
            $data->omzet + $data->extra_bill,
        ];
    }

    public function headings(): array
    {
        return ['Nomor Tiket',
                'Tanggal',
                'Via',
                'Status Reservasi',
                'Status Pembayaran',
                'Paket',
                'Tenda',
                'Harga',
                'Malam',
                'Subtotal (Harga x Malam)',
                'PPN (%)',
                'Nilai PPN',
                'Diskon',
                'Item Tambahan',
                'Extra Billing',
                'Omzet Sebelum Diskon (Subtotal + PPN + Layanan Extra)',
                'Omzet Setelah Diskon (Subtotal + PPN + Layanan Extra - Diskon)'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->append([
                    '', // start_date
                    '', // trans_via
                    '', // reservation status
                    '', // payment_status
                    '', // wahana_name
                    '', // room_name
                    '', // price
                    '', // night_count
                    '', // subtotal
                    '', // ppn
                    '', // ppn_amount
                    '', // discount
                    '', // item tambahan
                    '', // extra bill
                    'Total', // trans_num
                    $this->totalOmzetBeforeDiscount, // omzet sebelum diskon
                    $this->totalOmzetAfterDiscount, // omzet setelah diskon + extra bill
                ]);
            },
        ];
    }
}
