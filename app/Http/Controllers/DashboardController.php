<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Models\TicketSales;
use App\Models\TicketDirectSales;
use App\Models\Sales;
use App\Models\Purchases;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:dashboard-list|dashboard-graph|dashboard-widget|dashboard-table'], ['only' => ['index', 'build_chart']]);
    }

    public function index()
    {
        return view('modules.dashboard.index')
                ->with([
                    'title' => 'Dashboard'
                ]);
    }

    public function build_chart(Request $request){
        $dates = explode(' - ',  $request['daterange']);
        $start_date = strtotime($dates[0]);
        $end_date = strtotime($dates[1]);
        
        // Reservasi
        $reservations = Reservations::where('payment_status', 'paid')
                        ->whereBetween('start_date', $dates)
                        ->get();

        $reservation_count = $reservations->count();
        $reservation_omzet = $reservations->sum(function ($reservation) {
            return $reservation->omzet + $reservation->extra_bill;
        });

        // Ticket Sales
        $ticketPresale = TicketSales::whereBetween('sold_date', $dates)->get();
        $ticketDirect = TicketDirectSales::whereBetween('trans_date', $dates)->get();
        $ticket_count = $ticketPresale->count() + $ticketDirect->count();
        $ticket_omzet = $ticketPresale->sum('price') + $ticketDirect->sum('amount');

        // Inventory Sales
        $inventory = Sales::whereBetween('trans_date', $dates)->where('payment_status', 'paid')->get();
        $inventory_count = $inventory->count();
        $inventory_omzet = $inventory->sum('total_amount');

        // Purchasing
        $purchase = Purchases::whereBetween('trans_date', $dates)->get();
        $purchase_count = $purchase->count();
        $purchase_expense = $purchase->sum('total_amount');

        if( date('Y-m', strtotime($dates[0])) === date('Y-m', strtotime($dates[1])) ){
            $formatGroup = 'Y-m-d';
            $addTime = '+1 day';
            $dateLegend = 'd/m';
            $c3DateFormat = "%m/%d";
        }else{
            $formatGroup = 'Y-m';
            $addTime = '+1 month';
            $dateLegend = 'm/y';
            $c3DateFormat = "%m/%y";
        }

        $ticketPresale->transform(function ($item) use ($formatGroup){
            $item->sold_date = date($formatGroup, strtotime($item->sold_date));
            return $item;
        });

        $ticketDirect->transform(function ($item) use ($formatGroup){
            $item->trans_date = date($formatGroup, strtotime($item->trans_date));
            return $item;
        });
        
        $inventory->transform(function ($item) use ($formatGroup){
            $item->trans_date = date($formatGroup, strtotime($item->trans_date));
            return $item;
        });

        $purchase->transform(function ($item) use ($formatGroup){
            $item->trans_date = date($formatGroup, strtotime($item->trans_date));
            return $item;
        });

        // Chart
        // Menampilkan daftar tanggal dari rentang
        $tanggal = [];
        $income = [];
        $expense = [];
        $c3Tanggal = ['x'];
        $c3Income = ['income'];
        $c3Expense = ['expense'];
        while (date($formatGroup, $start_date) <= date($formatGroup, $end_date)) {
            $tanggal[] = date($dateLegend, $start_date);
            $income[] = $ticketPresale->where('sold_date', date($formatGroup, $start_date))->sum('price') + 
                        $ticketDirect->where('trans_date', date($formatGroup, $start_date))->sum('amount') +
                        $inventory->where('trans_date', date($formatGroup, $start_date))->sum('total_amount') +
                        $reservations->where('start_date', date($formatGroup, $start_date))->sum('omzet') + $reservations->where('start_date', date($formatGroup, $start_date))->sum('extra_bill');

            $expense[] = $purchase->where('trans_date', date($formatGroup, $start_date))->sum('total_amount');

            // Untuk chart C3
            $c3Tanggal[] = date('Y-m-d', $start_date);
            $c3Income[] = $ticketPresale->where('sold_date', date($formatGroup, $start_date))->sum('price') + 
                          $ticketDirect->where('trans_date', date($formatGroup, $start_date))->sum('amount') +
                          $inventory->where('trans_date', date($formatGroup, $start_date))->sum('total_amount') +
                          $reservations->where('start_date', date($formatGroup, $start_date))->sum('omzet') + $reservations->where('start_date', date($formatGroup, $start_date))->sum('extra_bill');
            $c3Expense[] = $purchase->where('trans_date', date($formatGroup, $start_date))->sum('total_amount');

            $start_date = strtotime($addTime, $start_date);
        }

        $result = [
            'reservation_count' => $reservation_count,
            'reservation_omzet' => $reservation_omzet,
            'ticket_count' => $ticket_count,
            'ticket_omzet' => $ticket_omzet,
            'inventory_count' => $inventory_count,
            'inventory_omzet' => $inventory_omzet,
            'purchase_count' => $purchase_count,
            'purchase_expense' => $purchase_expense,
            'chart' => [
                'tanggal' => $tanggal,
                'income' => $income,
                'expense' => $expense,
            ],
            'c3Chart' => [
                'tanggal' => $c3Tanggal,
                'income' => $c3Income,
                'expense' => $c3Expense,
                'dateFormat' => $c3DateFormat,
            ]
        ];

        return response()->json($result, 200);
    }

}
