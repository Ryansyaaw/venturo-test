<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tahun = $request['tahun'];
        $menu = json_decode(file_get_contents('http://tes-web.landa.id/intermediate/menu'), true);
        $transaksi = json_decode(file_get_contents('https://tes-web.landa.id/intermediate/transaksi?tahun=' . $tahun), true);

        $totalPerMenu = [];
        $totalPerBulan = [];

        if ($tahun != null) {
            foreach ($transaksi as $t) {
                $tanggal = substr($t['tanggal'], 5, 2);
                $bulan = ltrim($tanggal, '0');
                $namamenu = $t['menu'];

                if (!isset($totalPerMenu[$bulan][$namamenu])) {
                    $totalPerMenu[$bulan][$namamenu] = 0;
                }
                $totalPerMenu[$bulan][$namamenu] += $t['total'];

                if (!isset($totalPerBulan[$bulan])) {
                    $totalPerBulan[$bulan] = 0;
                }
                $totalPerBulan[$bulan] += $t['total'];

            }
        }

        // dd($totalPerBulan);

        return view('index',[
            'menu' => $menu,
            'transaksi' => $transaksi,
            'tahun' => $tahun,
            'totalPerMenu' => $totalPerMenu,
            'totalPerBulan' => $totalPerBulan
        ]);
    }
}
