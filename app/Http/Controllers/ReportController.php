<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

use App\Models\Reservations;
use App\Models\TicketSales;
use App\Models\TicketDirectSales;
use App\Models\Sales;
use DB;

use App\Exports\ReservationExport;
use App\Exports\RefundExport;
use App\Exports\TicketPresalesExport;
use App\Exports\TicketDirectSalesExport;
use App\Exports\SalesInventoryExport;
use App\Exports\SummaryExport;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:report-list'], ['only' => ['index', 'generate']]);
    }

    public function index()
    {
        return view('modules.report.index')
                ->with([
                    'title' => 'Laporan'
                ]);
    }

    public function generate(Request $request)
    {
        $tanggal = explode(' - ', $request->tanggal);

        if($request->subject === 'reservasi'){
            return $this->exportReservasi($tanggal, $request->reservation_status, $request->payment_status);
        }else if($request->subject === 'refund'){
            $data = Reservations::with(['wahana', 'room', 'extras', 'extras.stock', 'extras.stock.product'])
                    ->whereBetween('start_date', $tanggal)
                    ->whereNotNull('refund')
                    ->get();

            return Excel::download(new RefundExport($data), 'laporan_refund_'.$tanggal[0].'_'.$tanggal[1].'.xlsx');
        }else if ($request->subject === 'ticket_presale'){
            $data = TicketSales::with(['presale', 'category'])
                    ->whereBetween('sold_date', $tanggal)->get();

            return Excel::download(new TicketPresalesExport($data), 'laporan_tiket_presale_'.$tanggal[0].'_'.$tanggal[1].'.xlsx');
        }else if ($request->subject === 'ticket_direct'){
            $data = DB::table('ticket_direct_sales as a')
                    ->leftJoin('ticket_direct_sales_details as b', 'b.trans_id', 'a.id')
                    ->leftJoin('ticket_direct as c', 'c.id', 'b.ticket_id')
                    ->leftJoin('ticket_categories as d', 'd.id', 'c.category')
                    ->whereBetween('trans_date', $tanggal)
                    ->get();

            return Excel::download(new TicketDirectSalesExport($data), 'laporan_tiket_direct_sales_'.$tanggal[0].'_'.$tanggal[1].'.xlsx');
        }else if ($request->subject === 'inventory'){
            $data = DB::table('sales as a')
                    ->leftJoin('sales_details as b', 'b.sales_id', 'a.id')
                    ->leftJoin('products as c', 'c.id', 'b.product_id')
                    ->whereBetween('trans_date', $tanggal)
                    ->where('c.inventory_type', 'sale')
                    ->get();

            return Excel::download(new SalesInventoryExport($data), 'laporan_sales_inventory_'.$tanggal[0].'_'.$tanggal[1].'.xlsx');
        }else if ($request->subject === 'summary'){
            $qReservasi = Reservations::where('payment_status', 'paid');

            if ($tanggal) {
                $qReservasi->whereBetween('start_date', $tanggal);
            }

            $omzet = $qReservasi->sum('omzet');
            $extraBill = $qReservasi->sum('extra_bill');
            $reservasi = $omzet + $extraBill;

            $ticketPresale = TicketSales::whereBetween('sold_date', $tanggal)->sum('price');
            $ticketDirect = TicketDirectSales::whereBetween('trans_date', $tanggal)->sum('amount');
            $inventory = Sales::whereBetween('trans_date', $tanggal)->where('payment_status', 'paid')->sum('amount');

            $data = (object) [
                'reservasi' => $reservasi,
                'ticketPresale' => $ticketPresale,
                'ticketDirect' => $ticketDirect,
                'inventory' => $inventory,
                'total' => $reservasi + $ticketPresale + $ticketDirect + $inventory
            ];

            return Excel::download(new SummaryExport($data), 'summary_'.$tanggal[0].'_'.$tanggal[1].'.xlsx');
        }
    }

    public function exportReservasi($tanggal, $reservationStatus, $paymentStatus){
        $query = Reservations::with(['wahana', 'room']);

        if ($tanggal) {
            $query->whereBetween('start_date', $tanggal);
        }

        if ($reservationStatus) {
            $query->whereIn('reservation_status', $reservationStatus);
        }

        if ($paymentStatus) {
            $query->whereIn('payment_status', $paymentStatus);
        }

        $data = $query->get();
        return Excel::download(new ReservationExport($data), 'laporan_reservasi_'.$tanggal[0].'_'.$tanggal[1].'.xlsx');
    }
}
