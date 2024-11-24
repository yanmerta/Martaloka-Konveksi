<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kontak;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ReCaptcha\ReCaptcha;

class KontakController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter; // For gender filter
    
        // Set pagination
        $paginate = 10;
    
        // Base query for contacts
        $query = Kontak::query();
    
        // Search functionality
        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('telepon', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('jenis_kelamin', 'like', '%' . $search . '%')
                  ->orWhere('pesan', 'like', '%' . $search . '%');
        }
    
        // Filter by gender (Laki-laki or Perempuan)
        if ($filter) {
            $query->where('jenis_kelamin', $filter);
        }
    
        $kontaks = $query->latest()->paginate($paginate);
    
        // Return the view with data
        return view('admin.kontak.kontak-index', [
            'judul' => 'Daftar Kontak',
            'kontaks' => $kontaks,
            'search' => $search,
            'filter' => $filter
        ]);
    }
    

    public function store(Request $request)
    {

 // Validasi input form
 $recaptchaSecret = env('RECAPTCHA_SECRET');


 if (empty($recaptchaSecret)) {
     throw new \RuntimeException('No secret provided');
 }
 
 $recaptcha = new ReCaptcha($recaptchaSecret);
 $response = $recaptcha->verify($request->input('g-recaptcha-response'));

 if (!$response->isSuccess()) {
     return back()->with('error', 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.');
 }

        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email',
            'jenis_kelamin' => 'required',
            'pesan' => 'required|string',
        ]);
    
        // Simpan data ke database
        $kontaks = new Kontak();
        $kontaks->nama = $request->nama;
        $kontaks->telepon = $request->telepon;
        $kontaks->email = $request->email;
        $kontaks->jenis_kelamin = $request->jenis_kelamin; // Corrected typo from 'jenis_kelamim'
        $kontaks->pesan = $request->pesan;
        $kontaks->save();
    
        return redirect()->route('home.kontak')->with('message', 'Pesan Anda telah dikirim dengan sukses!'); // Customize the message as needed
    }
    
    // public function edit($id)
    // {
    //     $kontak = Kontak::findOrFail($id); // Use findOrFail to handle non-existing records
    //     return view('admin.kontak.kontak-edit', [
    //         'kontak' => $kontak,
    //         'judul' => 'Edit Kontak'
    //     ]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'telepon' => 'required|string|max:15',
    //         'email' => 'required|email',
    //         'jenis_kelamin' => 'required|in:L,P',
    //         'pesan' => 'required|string',
    //     ]);

    //     $kontak = Kontak::findOrFail($id); // Use findOrFail to handle non-existing records
    //     $kontak->update($request->only(['nama', 'telepon', 'email', 'jenis_kelamin', 'pesan']));

    //     return redirect()->route('kontak.index')->with('message', 'Kontak berhasil diperbarui!');
    // }

    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id); // Use findOrFail to handle non-existing records
        $kontak->delete();

        return redirect()->route('kontak.index')->with('message', 'Kontak berhasil dihapus!');
    }
}
