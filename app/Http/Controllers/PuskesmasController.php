<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePuskesmasRequest;
use App\Http\Requests\UpdatePuskesmasRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PuskesmasController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('admin.puskesmas.index', [
            'data' => $this->user->where('role', 'puskesmas')->get()
        ]);
    }

    public function create()
    {
        return view('admin.puskesmas.create');
    }

    public function store(StorePuskesmasRequest $request)
    {
        try {
            $data = $request->all();
            $data['role'] = 'puskesmas';
            User::create($data);
        } catch (\Exception $e) {
            return redirect(route('puskesmas.index'))->with('error', 'Gagal');
        }
        return redirect(route('puskesmas.index'))->with('success', 'Berhasil Tambah Data');
    }

    public function edit(User $puskesma)
    {
        return view('admin.puskesmas.edit', compact('puskesma'));
    }

    public function update(UpdatePuskesmasRequest $request, User $puskesma)
    {
        try {
            $data = $request->validated();
            if ($request->password != null) {
                $data['password'] = $request->password;
            }

            $puskesma->update($data);
        } catch (\Exception $e) {
            return redirect(route('puskesmas.index'))->with('error', 'Gagal');
        }
        return redirect(route('puskesmas.index'))->with('success', 'Berhasil Edit Data');
    }

    public function destroy(User $puskesma)
    {
        $puskesma->delete();
        return redirect(route('puskesmas.index'))->with('success', 'Berhasil Hapus Data');
    }
}
