<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedDates extends Model
{
    use HasFactory;

    protected $table = 'reserved_dates';
}


// create or replace view reserved_dates as
// with recursive daterange as (
//   select trans_num, start_date as date, end_date, wahana_id, room_id, night_count
//     from reservations
//    where cancel_flag is null
//      and complete_flag is null
//    union all
//   select trans_num, date_add(date, interval 1 day) as date, end_date, wahana_id, room_id, night_count
//     from daterange
//    where date_add(date, interval 1 day) < end_date
// )
// select trans_num, date, wahana_id, room_id, night_count
//   from daterange
//  order by trans_num, date;