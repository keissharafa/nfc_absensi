<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\KartuNfc;
use App\Models\Absensi;
use Carbon\Carbon;

class NfcController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('nfc.index', compact('mahasiswa'));
    }

    public function daftarKartu(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required',
            'serial_number' => 'required'
        ]);

        KartuNfc::updateOrCreate(
            ['serial_number' => $request->serial_number],
            ['mahasiswa_id' => $request->mahasiswa_id]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Kartu NFC berhasil didaftarkan.'
        ]);
    }

    public function scanAbsensi(Request $request)
    {
        $request->validate([
            'serial_number' => 'required'
        ]);

        $kartu = KartuNfc::where('serial_number', $request->serial_number)->first();

        if (!$kartu) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kartu NFC tidak terdaftar.'
            ]);
        }

        $tanggalHariIni = Carbon::now()->toDateString();

        $sudahAbsen = Absensi::where('mahasiswa_id', $kartu->mahasiswa_id)
            ->where('tanggal', $tanggalHariIni)
            ->first();

        if ($sudahAbsen) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Mahasiswa sudah absen hari ini.',
                'nama' => $kartu->mahasiswa->nama,
                'nim' => $kartu->mahasiswa->nim
            ]);
        }

        Absensi::create([
            'mahasiswa_id' => $kartu->mahasiswa_id,
            'tanggal' => $tanggalHariIni,
            'jam_masuk' => Carbon::now()->format('H:i:s'),
            'status' => 'Hadir'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Absensi berhasil dicatat.',
            'nama' => $kartu->mahasiswa->nama,
            'nim' => $kartu->mahasiswa->nim
        ]);
    }

    public function dataAbsensi()
    {
        $absensi = Absensi::with('mahasiswa')->latest()->get();
        return view('nfc.absensi', compact('absensi'));
    }
}