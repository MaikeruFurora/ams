<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Helper{

    public static function auditLog($type,$event){

        // return  DB::table('audits')->insert([

        //             'auditable_id'   => auth()->user()->id,

        //             'auditable_type' => $type,

        //             'event'          => $event,

        //             'url'            => request()->fullUrl(),

        //             'ip_address'     => request()->getClientIp(),

        //             'user_agent'     => request()->userAgent(),

        //             'created_at'     => Carbon::now(),

        //             'updated_at'     => Carbon::now(),

        //             'user_id'        => auth()->user()->id,

        //         ]);
    }

}