<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with('user')->get();
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:pegawai,nip',
            'sk_cpns' => 'nullable|file|mimes:pdf,jpg',
            'sk_pns' => 'nullable|file|mimes:pdf,jpg',
            'kk' => 'nullable|file|mimes:pdf,jpg',
            'akte' => 'nullable|file|mimes:pdf,jpg',
            'ktp' => 'nullable|file|mimes:pdf,jpg',
            'ijazah_sd' => 'nullable|file|mimes:pdf,jpg',
            'ijazah_smp' => 'nullable|file|mimes:pdf,jpg',
            'ijazah_sma' => 'nullable|file|mimes:pdf,jpg',
            'ijazah_kuliah' => 'nullable|file|mimes:pdf,jpg',
        ]);

        $data = $request->all();

        // Handle file uploads
        foreach (['sk_cpns', 'sk_pns', 'kk', 'akte', 'ktp', 'ijazah_sd', 'ijazah_smp', 'ijazah_sma', 'ijazah_kuliah'] as $file) {
            if ($request->hasFile($file)) {
                $data[$file] = $request->file($file)->store('pegawai_files');
            }
        }

        Pegawai::create($data);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai created successfully.');
    }

    public function show(Pegawai $pegawai)
    {
        return view('pegawai.show', compact('pegawai'));
    }

    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'sk_cpns' => 'nullable|file|mimes:pdf,jpg',
            'sk_pns' => 'nullable|file|mimes:pdf,jpg',
            'kk' => 'nullable|file|mimes:pdf,jpg',
            'akte' => 'nullable|file|mimes:pdf,jpg',
            'ktp' => 'nullable|file|mimes:pdf,jpg',
            'ijazah_sd' => 'nullable|file|mimes:pdf,jpg',
            'ijazah_smp' => 'nullable|file|mimes:pdf,jpg',
            'ijazah_sma' => 'nullable|file|mimes:pdf,jpg',
            'ijazah_kuliah' => 'nullable|file|mimes:pdf,jpg',
        ]);

        $data = $request->all();

        // Handle file uploads
        foreach (['sk_cpns', 'sk_pns', 'kk', 'akte', 'ktp', 'ijazah_sd', 'ijazah_smp', 'ijazah_sma', 'ijazah_kuliah'] as $file) {
            if ($request->hasFile($file)) {
                $data[$file] = $request->file($file)->store('pegawai_files', 'public');
            }
        }

        $pegawai->update($data);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai updated successfully.');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Pegawai deleted successfully.');
    }
}
