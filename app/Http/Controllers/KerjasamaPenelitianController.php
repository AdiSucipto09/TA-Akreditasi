<?php

namespace App\Http\Controllers;

use App\Models\KerjasamaPenelitian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KerjasamaPenelitianController extends Controller
{
    public function index()
    {
        return view('pages.kerjasama_penelitian');
    }

    public function show()
    {
        if (Auth::user()->id) {
            $kerjasama_penelitian = KerjasamaPenelitian::where('user_id', Auth::user()->id)->get();
        }
        return view('pages.kerjasama_penelitian', compact('kerjasama_penelitian'));
    }

    public function add(Request $request)
    {

        KerjasamaPenelitian::create([
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

        $kerjasama_pendidikan = KerjasamaPenelitian::find($id);
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
        $kerjasama_penelitian = KerjasamaPenelitian::find($id);
        $kerjasama_penelitian->delete();

        return redirect()->back()->with('success', 'Data Visi & Misi berhasil dihapus!');
    }
}
