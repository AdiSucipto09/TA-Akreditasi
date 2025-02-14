<?php

namespace App\Http\Controllers;

use App\Models\KerjasamaPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KerjasamaPendidikanController extends Controller
{
    public function index()
    {
        return view('pages.kerjasama_pendidikan');
    }

    public function show()
    {
        if (Auth::user()->id) {
            $kerjasama_pendidikan = KerjasamaPendidikan::where('user_id', Auth::user()->id)->get();
        }
        return view('pages.kerjasama_pendidikan', compact('kerjasama_pendidikan'));
    }

    public function add(Request $request)
    {
        // $request->validate([
        //     '' => 'required|string',
        //     'misi' => 'required|string',
        //     'deskripsi' => 'required|string',
        // ]);

        KerjasamaPendidikan::create([
            'user_id' => Auth::user()->id,
            'lembaga_mitra' => $request->lembaga_mitra,
            'tingkat' => $request->tingkat,
            'judul_kegiatan' => $request->judul_kegiatan,
            'waktu_durasi' => $request->waktu_durasi,
            'realisasi_kerjasama' => $request->realisasi_kerjasama,
            'spk' => $request->spk
        ]);

        return redirect()->back()->with('success', 'Data Visi & Misi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'visi' => 'required|string',
        //     'misi' => 'required|string',
        //     'deskripsi' => 'required|string',
        // ]);

        $kerjasama_pendidikan = KerjasamaPendidikan::find($id);
        $kerjasama_pendidikan->lembaga_mitra = $request->lembaga_mitra;
        $kerjasama_pendidikan->tingkat = $request->tingkat;
        $kerjasama_pendidikan->judul_kegiatan = $request->judul_kegiatan;
        $kerjasama_pendidikan->waktu_durasi = $request->waktu_durasi;
        $kerjasama_pendidikan->realisasi_kerjasama = $request->realisasi_kerjasama;
        $kerjasama_pendidikan->spk = $request->spk;
        $kerjasama_pendidikan->user_id = Auth::user()->id;
        $kerjasama_pendidikan->save();

        return redirect()->back()->with('success', 'Data Visi & Misi berhasil diubah!');
    }

    public function destroy($id)
    {
        $kerjasama_pendidikan = KerjasamaPendidikan::find($id);
        $kerjasama_pendidikan->delete();

        return redirect()->back()->with('success', 'Data Visi & Misi berhasil dihapus!');
    }
}
