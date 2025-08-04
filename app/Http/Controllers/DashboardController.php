<?php

namespace App\Http\Controllers;

use App\Models\Pendataan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tanggalSekarang = now();
        $query = Pendataan::select(DB::raw('COUNT(*) as total_bayi'))
            ->whereRaw("DATE_ADD(tgl_lahir_bayi, INTERVAL 12 MONTH) >= ?", [$tanggalSekarang])
            ->get();
        $totalBayiUnder12 = $query[0]->total_bayi;

        $query = Pendataan::select(DB::raw('COUNT(*) as total_bayi'))
            ->whereRaw("DATE_ADD(tgl_lahir_bayi, INTERVAL 12 MONTH) < ?", [$tanggalSekarang])
            ->whereRaw("DATE_ADD(tgl_lahir_bayi, INTERVAL 24 MONTH) >= ?", [$tanggalSekarang])
            ->get();
        $totalBayiUnder24 = $query[0]->total_bayi;

        $query = Pendataan::select(DB::raw('COUNT(*) as total_bayi'))
            ->whereRaw("DATE_ADD(tgl_lahir_bayi, INTERVAL 24 MONTH) < ?", [$tanggalSekarang])
            ->whereRaw("DATE_ADD(tgl_lahir_bayi, INTERVAL 36 MONTH) >= ?", [$tanggalSekarang])
            ->get();
        $totalBayiUnder36 = $query[0]->total_bayi;

        $query = Pendataan::select(DB::raw('COUNT(*) as total_bayi'))
            ->whereRaw("DATE_ADD(tgl_lahir_bayi, INTERVAL 36 MONTH) < ?", [$tanggalSekarang])
            ->whereRaw("DATE_ADD(tgl_lahir_bayi, INTERVAL 48 MONTH) >= ?", [$tanggalSekarang])
            ->get();
        $totalBayiUnder48 = $query[0]->total_bayi;

        $query = Pendataan::select(DB::raw('COUNT(*) as total_bayi'))
            ->whereRaw("DATE_ADD(tgl_lahir_bayi, INTERVAL 48 MONTH) < ?", [$tanggalSekarang])
            ->whereRaw("DATE_ADD(tgl_lahir_bayi, INTERVAL 60 MONTH) >= ?", [$tanggalSekarang])
            ->get();
        $totalBayiUnder60 = $query[0]->total_bayi;

        return view('dashboard', [
            'totalPuskesmas' => User::where('role', 'puskesmas')->count(),
            'totalPosyandu' => User::where('role', 'posyandu')->count(),
            'totalL' => Pendataan::where('jkel', 'Laki-Laki')->count(),
            'totalP' => Pendataan::where('jkel', 'Perempuan')->count(),
            'totalBayiUnder12' => $totalBayiUnder12,
            'totalBayiUnder24' => $totalBayiUnder24,
            'totalBayiUnder36' => $totalBayiUnder36,
            'totalBayiUnder48' => $totalBayiUnder48,
            'totalBayiUnder60' => $totalBayiUnder60,
        ]);
    }
}
