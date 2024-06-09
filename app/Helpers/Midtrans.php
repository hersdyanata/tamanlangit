<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use App\Models\Reservations;
use App\Models\Payments;

class Midtrans {
    private $postUrl;
    private $getUrl;

    public function __construct()
    {
        if(env('MIDTRANS_SANDBOX') === true){
            $this->postUrl = env('MIDTRANS_SANDBOX_URL');
            $this->getUrl = env('MIDTRANS_SANDBOX_GET_URL');
        }else{
            $this->postUrl = env('MIDTRANS_PROD_URL');
            $this->getUrl = env('MIDTRANS_PROD_GET_URL');
        }
    }

    public function postCharge($id)
    {
        try {
            $reservation = Reservations::with(['room', 'wahana'])->findOrFail($id);
            $payload = [
                'transaction_details' => [
                    'order_id'      => $reservation->trans_num,
                    'gross_amount'  => $reservation->total_amount,
                ],
                'customer_details' => [
                    'first_name'    => $reservation->name,
                    'email'         => $reservation->email,
                    'phone'         => $reservation->wa_number,
                    // 'address'       => '',
                ],
                'item_details' => [
                    [
                        'id'       => $reservation->wahana_id,
                        'price'    => $reservation->price,
                        'quantity' => $reservation->night_count,
                        'name'     => ucwords(strtolower($reservation->wahana->name))
                    ],
                    [
                        'id' => 'PPN',
                        'price' => $reservation->ppn_amount,
                        'quantity' => 1,
                        'name' => 'PPN',
                    ],
                    [
                        'id' => 'Discount',
                        'price' => ($reservation->discount_amount !== null) ? -$reservation->discount_amount : 0,
                        'quantity' => 1,
                        'name' => 'Voucher'
                    ],
                ],
                'enabled_payments' => ['bank_transfer']
            ];

            $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $auth",
            ])->post($this->postUrl.'/snap/v1/transactions', $payload);
            $resp = json_decode($response->body());

            $reservation->payment_url = $resp->redirect_url;
            $reservation->save();
        } catch (\Exception $e){
            return response()->json([
                'msg_title' => 'Gagal!',
                'msg_body' => $e->getMessage(),
            ], 400);
        }

        return response()->json('success');
    }

    public function notifier($sendmail, $id)
    {
        $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));
        $post = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth",
        ])->get($this->getUrl."/v2/$id/status");

        $response = json_decode($post->body());
        // $order = Reservations::findOrFail($response->order_id);
        $order = Reservations::where('trans_num', $response->order_id)->firstOrFail();
        if($order->payment_status === 'paid' || $order->payment_status === 'ditinjau'){
            return 'Payment has been done';
        }
        
        if($response->transaction_status === 'capture'){
            // kirim email reservasi ke customer
            $order->payment_status = 'ditinjau';
        }else if($response->transaction_status === 'settlement'){
            $order->payment_status = 'paid';
            if(isset($response->biller_code)){
                if($response->biller_code === '70012'){
                    $order->payment_via = 'mandiri';
                    $order->va_number = $response->bill_key;
                }
            }elseif(isset($response->permata_va_number)){
                $order->payment_via = 'permata';
                $order->va_number = $response->permata_va_number;
                $order->expiry_time = $response->expiry_time;
            }else{
                $order->payment_via = $response->va_numbers[0]->bank;
                $order->va_number = $response->va_numbers[0]->va_number;
                $order->expiry_time = $response->expiry_time;
            }

            $sendmail->payment_success($order->email, $order->id);
        }else if($response->transaction_status === 'pending'){
            $order->payment_status = 'pending';
            if(isset($response->biller_code)){
                if($response->biller_code === '70012'){
                    $order->payment_via = 'mandiri';
                    $order->va_number = $response->bill_key;
                    $order->expiry_time = $response->expiry_time;
                }
            }elseif(isset($response->permata_va_number)){
                $order->payment_via = 'permata';
                $order->va_number = $response->permata_va_number;
                $order->expiry_time = $response->expiry_time;
            }else{
                $order->payment_via = $response->va_numbers[0]->bank;
                $order->va_number = $response->va_numbers[0]->va_number;
                $order->expiry_time = $response->expiry_time;
            }
        }else if($response->transaction_status === 'deny'){
            $order->payment_status = 'deny';
            $order->reservation_status = 'cancel';
        }else if($response->transaction_status === 'expire'){
            $order->payment_status = 'expire';
            $order->reservation_status = 'cancel';
        }else if($response->transaction_status === 'cancel'){
            $order->payment_status = 'cancel';
            $order->reservation_status = 'cancel';
        }
        $order->save();

        return 'success';
    }
}