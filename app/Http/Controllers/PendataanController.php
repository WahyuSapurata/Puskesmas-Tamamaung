<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePendataanRequest;
use App\Models\Pendataan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class PendataanController extends Controller
{
    public function index()
    {
        return view('pendataan.index', [
            'data' => Pendataan::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function create()
    {
        return view('pendataan.create');
    }

    public function store(StorePendataanRequest $request)
    {
        try {
            $model = $request->validated();
            $model['user_id'] = auth()->user()->id;
            Pendataan::create($model);
        } catch (\Exception $e) {
            return redirect(route('pendataan.create'))->with('error', 'Gagal' . $e->getMessage());
        }
        return redirect(route('pendataan.create'))->with('success', 'Berhasil Simpan Data');
    }

    public function edit(Pendataan $pendataan)
    {
        return view('pendataan.edit', compact('pendataan'));
    }

    public function update(StorePendataanRequest $request, Pendataan $pendataan)
    {
        try {
            $pendataan->update($request->validated());
        } catch (\Exception $e) {
            return redirect(route('pendataan.index'))->with('error', 'Gagal');
        }
        return redirect(route('pendataan.index'))->with('success', 'Berhasil Edit Data');
    }

    public function destroy(Pendataan $pendataan)
    {
        $pendataan->delete();
        return redirect(route('pendataan.index'))->with('success', 'Berhasil Hapus Data');
    }

    public function cetak()
    {
        $data = Pendataan::where('user_id', auth()->user()->id)->get();
        $pdf = PDF::loadView('exports.pendataan_pdf', [
            'data' => $data
        ]);
        return $pdf->download('Hasil Pendataan.pdf');
    }

    public function usia_0_12($bb, $tb)
    {
        if ($bb < 2.9) {
            return 'Underweight';
        } elseif ($bb > 10.8) {
            return 'Overweight';
        } else {
            if ($tb < 48) {
                return 'Stunted';
            } elseif ($tb > 78.1) {
                return 'Tinggi';
            } else {
                return 'Normal';
            }
        }
    }

    public function usia_13_24($bb, $tb)
    {
        if ($bb < 8.8) {
            return 'Underweight';
        } elseif ($bb > 13.6) {
            return 'Overweight';
        } else {
            if ($tb < 74.5) {
                return 'Stunted';
            } elseif ($tb > 90.9) {
                return 'Tinggi';
            } else {
                return 'Normal';
            }
        }
    }

    public function usia_25_36($bb, $tb)
    {
        if ($bb < 11) {
            return 'Underweight';
        } elseif ($bb > 16.2) {
            return 'Overweight';
        } else {
            if ($tb < 84.9) {
                return 'Stunted';
            } elseif ($tb > 99.8) {
                return 'Tinggi';
            } else {
                return 'Normal';
            }
        }
    }

    public function usia_37_48($bb, $tb)
    {
        if ($bb < 12.9) {
            return 'Underweight';
        } elseif ($bb > 18.6) {
            return 'Overweight';
        } else {
            if ($tb < 93) {
                return 'Stunted';
            } elseif ($tb > 107.5) {
                return 'Tinggi';
            } else {
                return 'Normal';
            }
        }
    }

    public function usia_49_60($bb, $tb)
    {
        if ($bb < 14.5) {
            return 'Underweight';
        } elseif ($bb > 21) {
            return 'Overweight';
        } else {
            if ($tb < 99.7) {
                return 'Stunted';
            } elseif ($tb > 114.6) {
                return 'Tinggi';
            } else {
                return 'Normal';
            }
        }
    }

    public function determineStatus($bb, $umur, $tb)
    {
        if ($umur >= 0 && $umur <= 12) {
            return $this->usia_0_12($bb, $tb);
        } elseif ($umur >= 13 && $umur <= 24) {
            return $this->usia_13_24($bb, $tb);
        } elseif ($umur >= 25 && $umur <= 36) {
            return $this->usia_25_36($bb, $tb);
        } elseif ($umur >= 37 && $umur <= 48) {
            return $this->usia_37_48($bb, $tb);
        } elseif ($umur >= 49 && $umur <= 60) {
            return $this->usia_49_60($bb, $tb);
        } else {
            return 'Tidak Diketahui';
        }
    }

    public function report()
    {
        $data = Pendataan::all();
        $i = 0;
        foreach ($data as $value) {
            $data[$i++]['status'] = $this->determineStatus($value->bb, Carbon::parse($value->tgl_lahir_bayi)->diffInMonths(Carbon::now()), $value->tb);
        }
        return view('pendataan.report', compact('data'));
    }

    public function cetakReport()
    {
        $data = Pendataan::all();
        $i = 0;
        foreach ($data as $value) {
            $data[$i++]['status'] = $this->determineStatus($value->bb, Carbon::parse($value->tgl_lahir_bayi)->diffInMonths(Carbon::now()), $value->tb);
        }
        $pdf = PDF::loadView('exports.report_pdf', [
            'data' => $data
        ]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Data Bayi.pdf');
    }
}
