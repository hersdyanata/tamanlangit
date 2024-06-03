<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailReservation;
use App\Mail\PaymentSuccess;
use App\Models\Reservations;
use App\Mail\Review;

class Mailer {

    public function reservation($address, $id){
        $message = 'Email berhasil dikirim ke ' . $address;
        $data = Reservations::with(['room', 'wahana'])->find($id)->toArray();
        Mail::to($address)->send(new EmailReservation($data));
        return response()->json(['message' => $message]);
    }

    public function payment_success($address, $id){
        $message = 'Email berhasil dikirim ke ' . $address;
        $data = Reservations::with(['room', 'wahana'])->find($id)->toArray();
        Mail::to($address)->send(new PaymentSuccess($data));
        return response()->json(['message' => $message]);
    }

    public function review($address, $id){
        $message = 'Email berhasil dikirim ke ' . $address;
        $data = Reservations::with(['room', 'wahana'])->find($id)->toArray();
        Mail::to($address)->send(new Review($data));
        return response()->json(['message' => $message]);
    }
}