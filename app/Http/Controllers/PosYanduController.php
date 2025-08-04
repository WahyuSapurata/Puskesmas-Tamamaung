<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePosYanduRequest;
use App\Http\Requests\UpdatePosYanduRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PosYanduController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('admin.posyandu.index', [
            'data' => $this->user->where('role', 'posyandu')->get()
        ]);
    }

    public function create()
    {
        return view('admin.posyandu.create');
    }

    public function store(StorePosYanduRequest $request)
    {
        try {
            $data = $request->all();
            $data['role'] = 'posyandu';
            User::create($data);
        } catch (\Exception $e) {
            return redirect(route('posyandu.index'))->with('error', 'Gagal');
        }
        return redirect(route('posyandu.index'))->with('success', 'Berhasil Tambah Data');
    }

    public function edit(User $posyandu)
    {
        return view('admin.posyandu.edit', compact('posyandu'));
    }

    public function update(UpdatePosYanduRequest $request, User $posyandu)
    {
        try {
            $data = $request->validated();
            if ($request->password != null) {
                $data['password'] = $request->password;
            }

            $posyandu->update($data);
        } catch (\Exception $e) {
            return redirect(route('posyandu.index'))->with('error', 'Gagal');
        }
        return redirect(route('posyandu.index'))->with('success', 'Berhasil Edit Data');
    }

    public function destroy(User $posyandu)
    {
        $posyandu->delete();
        return redirect(route('posyandu.index'))->with('success', 'Berhasil Hapus Data');
    }
}
