<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use DateTime;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    
    public function list_event(){
        $k = Event::orderBy('id','desc')->get();
        foreach($k as $v){
            $tanggalObj = new DateTime($v->tanggal_event);

            $namaBulan = $tanggalObj->format("F");
            
            $v->nama_bulan = $namaBulan;
        }
        if ($k) {

            return response()->json([
                'code' => '200',
                'data' => $k
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }
}
