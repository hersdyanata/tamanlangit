<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailReservation;

class Mailer {

    public function reservation($address, $data){
        $message = 'Email berhasil dikirim ke ' . $address;
        Mail::to($address)->send(new EmailReservation($data));
        return response()->json(['message' => $message]);
    }

}