<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pendataan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartDataController extends Controller
{
    public function getDataTotalPerbulan(Request $request)
    {
        // $tahun = date('Y');
        $tahun = date(2023);
        $totalPengecekanPerbulan = Pendataan::select(DB::raw('MONTH(tgl_pengecekan) as bulan, COUNT(*) as jumlah_bayi'))
            ->whereYear('tgl_pengecekan', $tahun)
            ->groupBy(DB::raw('MONTH(tgl_pengecekan)'))
            ->orderBy(DB::raw('MONTH(tgl_pengecekan)'))
            ->get();

        // Format data sesuai dengan kebutuhan grafik
        $labels = $totalPengecekanPerbulan->pluck('bulan');
        $values = $totalPengecekanPerbulan->pluck('jumlah_bayi');

        return response()->json([
            'labels' => $labels,
            'values' => $values,
        ]);
    }
}
