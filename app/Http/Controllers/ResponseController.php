<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiCustomDesign;
use Illuminate\Http\Request;

class ResponseController extends Controller
{


    public function detailTransaksi($id)
    {
        $transaksi = Transaksi::with('detailTransaksi')->find($id);

        return response()->json($transaksi);
    }


    public function detailCustom($id)
    {
        $custom = TransaksiCustomDesign::with(['sizes','designs','progress'])->find($id);

        return response()->json($custom);
    }
}
