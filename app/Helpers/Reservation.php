<?php
namespace App\Helpers;

use App\Models\Coupons;
use App\Models\CouponWahana;
use App\Models\ReservedDates;

class Reservation {
    public function check_availability($request)
    {
        $tanggal = explode(' - ', $request['daterange']);
        $reserved = ReservedDates::whereBetween('date', $tanggal)->where('wahana_id', $request['wahana_id'])->where('room_id', $request['room_id'])->get();
    
        $message = '';
        foreach ($reserved as $index => $reservation){
            $message .= '<span class="fw-semibold">#'.$reservation->trans_num. '</span>, <span class="fw-semibold text-danger">Tanggal: '.$reservation->date.'</span>';        
            if ($index < count($reserved) - 1) {
                $message .= '<br>';
            }
        }
    
        $availability = (count($reserved) > 0) ? false : true;
    
        // $request['source'] hanya dikirim dari fe (frontend)
        if(!isset($request['source'])){
            return response()->json([
                'isAvailable' => $availability,
                'message' => $message
            ], 200);
        }else{
            // return untuk frontend
            if($availability == false){
                return response()->json([
                    'isAvailable' => $availability,
                    'message' => 'Tenda ini sudah terisi! Silahkan ganti dengan tenda atau tanggal yang lain.'
                ], 200);
            }else{
                return response()->json([
                    'isAvailable' => $availability,
                    'message' => null
                ], 200);
            }
        }
    }
    
    public function checkCoupon($wahana_id, $code){
        $kupon = Coupons::with(['wahanas'])
                ->where('code', '#'.$code)
                ->where('valid_for', 'online')
                ->orWhere('valid_for', 'both')
                ->first();
        
        if(isset($kupon)){
            $wahanaFound = false;
            if(isset($kupon) && count($kupon->wahanas) > 0){
                $wahanaFound = in_array($wahana_id, array_column($kupon->wahanas->toArray(), 'wahana_id'));
            }

            if($kupon->status == 'A' && $wahanaFound == true){
                $isActive = true;
                $msg_title = 'Berhasil';
                $msg_body = 'Selamat! Diskon masih berlaku.';
                $alertType = 'success';
            }else{
                $isActive = false;
                $msg_title = 'Maaf!';
                $msg_body = 'Kupon tidak berlaku.';
                $alertType = 'error';
            }
        }else{
            $isActive = false;
            $msg_title = 'Maaf!'; 
            $msg_body = 'Kupon tidak ditemukan';
            $alertType = 'error';
        }
    
        return response()->json([
            'isActive' => $isActive,
            'msg_title' => $msg_title,
            'msg_body' => $msg_body,
            'type' => $alertType,
            'coupon' => $kupon,
        ], 200);
    }
}