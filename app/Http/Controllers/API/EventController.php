<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DetailEvent;
use App\Models\Event;
use App\Models\TiketEvent;
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
            $v->foto = asset('uploads/foto_event/' . $v->foto_event);
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

    public function list_tiket_event($id_event){
        $k = TiketEvent::where('id_event',$id_event)->orderBy('id','desc')->get();
        foreach($k as $v){
            
            $v->foto = asset('uploads/foto_event/' . $v->foto_event);
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

    public function fasilitas($id_event){
        $k = DetailEvent::where('id_event',$id_event)->orderBy('id','desc')->get();
        
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
