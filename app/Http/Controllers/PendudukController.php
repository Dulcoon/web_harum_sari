<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class PendudukController extends Controller
{


    public function create()
    {
        return view('penduduk.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nik' => 'required|unique:penduduks|max:16',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date_format:d/m/Y',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'pekerjaan' => 'required',
            'pendidikan' => 'required',
            'status_perkawinan' => 'required',
            'pass_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);
    
        // Format ulang tanggal lahir
        $tanggalLahirFormatted = \DateTime::createFromFormat('d/m/Y', $request->tanggal_lahir)->format('Y-m-d');
    
        if ($request->hasFile('pass_foto')) {

            $foto = $request->file('pass_foto');
        
            $fotoName = Str::random(40) . '.' . $foto->getClientOriginalExtension();
        

            $foto->storeAs('pass_foto_penduduk', $fotoName);
        
        }
        
        

    
        // Simpan data penduduk
        Penduduk::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $tanggalLahirFormatted,
            'alamat' => $request->alamat,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'pekerjaan' => $request->pekerjaan,
            'pendidikan' => $request->pendidikan,
            'status_perkawinan' => $request->status_perkawinan,
            'pass_foto' => $fotoName // Simpan path publik
        ]);

    
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }
    
    
    

    // Fungsi untuk mendapatkan nama wilayah berdasarkan kode wilayah
    public function index(Request $request)
    {
        $query = Penduduk::query();

        // Pencarian
        if ($search = $request->input('search')) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%");
        }

        // Sorting
        $order = $request->input('order', 'desc'); // Default desc untuk terbaru
        $query->orderBy('created_at', $order);

        // Paginate hasil
        $penduduks = $query->paginate(5)->through(function ($penduduk) {
            $penduduk->tanggal_lahir = $penduduk->tanggal_lahir
                ? \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d/m/Y')
                : '';
            return $penduduk;
        });

        return view('penduduk.index', compact('penduduks', 'order'));
    }


    

    // Fungsi untuk mendapatkan nama wilayah berdasarkan kode dan jenis wilayah
    public function getWilayahNameByCode($code, $type, $kodeInduk)
    {
        $endpoint = '';
        
        switch ($type) {
            case 'villages':
                $endpoint = "https://wilayah.id/api/villages/{$kodeInduk}.json";
                $response = Http::get($endpoint);
                $data = json_decode($response, true);
                $wilayahName = null;
                
                foreach ($data['data'] as $wilayah) {
                    if ($wilayah['code'] === $code) {
                        $wilayahName = $wilayah['name'];
                        break;
                    }
                }

                if ($wilayahName) {
                    return $wilayahName;
                } else {
                    return null;
                }  
            case 'districts':
                $endpoint = "https://wilayah.id/api/districts/{$kodeInduk}.json";
                $response = Http::get($endpoint);
                $data = json_decode($response, true);
                $wilayahName = null;
                
                foreach ($data['data'] as $wilayah) {
                    if ($wilayah['code'] === $code) {
                        $wilayahName = $wilayah['name'];
                        break;
                    }
                }

                if ($wilayahName) {
                    return $wilayahName;
                } else {
                    return null;
                }  
            case 'regencies':
                $endpoint = "https://wilayah.id/api/regencies/{$kodeInduk}.json";
                $response = Http::get($endpoint);
                $data = json_decode($response, true);
                $wilayahName = null;
                
                foreach ($data['data'] as $wilayah) {
                    if ($wilayah['code'] === $code) {
                        $wilayahName = $wilayah['name'];
                        break;
                    }
                }

                if ($wilayahName) {
                    return $wilayahName;
                } else {
                    return null;
                }  
            case 'provinces':
                $endpoint = "https://wilayah.id/api/provinces.json";
                $response = Http::get($endpoint);
                $data = json_decode($response, true);
                $wilayahName = null;
                
                foreach ($data['data'] as $wilayah) {
                    if ($wilayah['code'] === $code) {
                        $wilayahName = $wilayah['name'];
                        break;
                    }
                }

                if ($wilayahName) {
                    return $wilayahName;
                } else {
                    return null;
                }  
            default:
                return null;  // Jika tipe tidak valid, return null
        }

    }

    public function show(Penduduk $penduduk)
    {
        // Ambil nama wilayah berdasarkan kode
        $penduduk->kelurahan_name = $this->getWilayahNameByCode($penduduk->kelurahan, 'villages', $penduduk->kecamatan);
        $penduduk->kecamatan_name = $this->getWilayahNameByCode($penduduk->kecamatan, 'districts', $penduduk->kabupaten);
        $penduduk->kabupaten_name = $this->getWilayahNameByCode($penduduk->kabupaten, 'regencies', $penduduk->provinsi );
        $penduduk->provinsi_name = $this->getWilayahNameByCode($penduduk->provinsi, 'provinces', null);

        return view('penduduk.show', compact('penduduk'));
    }

    public function edit($id)
    {
        $user = Penduduk::find($id);
        
        // Mengonversi tanggal dari format Y-m-d ke d/m/Y
        $formattedDate = $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d/m/Y') : '';
    
        return view('penduduk.edit', ['user' => $user, 'formattedDate' => $formattedDate]);
    }

    public function update(Request $request, $id)
    {
        $penduduk = Penduduk::findOrFail($id);
    
        $request->validate([
            'nik' => 'required|max:16|unique:penduduks,nik,' . $penduduk->id,
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date_format:d/m/Y',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'pekerjaan' => 'required',
            'pendidikan' => 'required',
            'status_perkawinan' => 'required',
            'pass_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);
    
        $tanggalLahirFormatted = \DateTime::createFromFormat('d/m/Y', $request->tanggal_lahir)->format('Y-m-d');
    
        if ($request->hasFile('pass_foto')) {
            $foto = $request->file('pass_foto');
    
            $fotoName = Str::random(40) . '.' . $foto->getClientOriginalExtension();
    
            $foto->storeAs('pass_foto_penduduk', $fotoName);
    
            if ($penduduk->pass_foto && Storage::exists('pass_foto_penduduk/' . $penduduk->pass_foto)) {
                Storage::delete('pass_foto_penduduk/' . $penduduk->pass_foto);
            }
    
            $penduduk->pass_foto = $fotoName;
        }
    
        $penduduk->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $tanggalLahirFormatted,
            'alamat' => $request->alamat,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'pekerjaan' => $request->pekerjaan,
            'pendidikan' => $request->pendidikan,
            'status_perkawinan' => $request->status_perkawinan,
        ]);
    
        // Redirect ke halaman index
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui.');
    }
    
    
    
    
    

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->route('penduduk.index')->with('success', 'Data Penduduk berhasil dihapus.');
    }



    public function dashboard()
    {
        $totalPenduduk = Penduduk::count(); // Total penduduk
        $pendudukPerProvinsi = Penduduk::selectRaw('provinsi, COUNT(*) as total')
            ->groupBy('provinsi')
            ->get(); // Jumlah penduduk per Provinsi

        $latestPenduduk = Penduduk::latest()->take(5)->get(); // 5 penduduk terbaru
        $usiaProduktif = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 60')->count();
        $usiaNonProduktif = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 18 OR TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) > 60')->count();

        return view('dashboard', compact('totalPenduduk', 'pendudukPerProvinsi', 'latestPenduduk', 'usiaProduktif', 'usiaNonProduktif'));
    }


    public function getPendudukByGender()
    {
        $dataLaki = Penduduk::selectRaw('provinsi, COUNT(*) as penduduk_laki')
            ->where('jenis_kelamin', 'Laki-Laki')
            ->groupBy('provinsi')
            ->get();

        $dataPerempuan = Penduduk::selectRaw('provinsi, COUNT(*) as penduduk_perempuan')
            ->where('jenis_kelamin', 'Perempuan')
            ->groupBy('provinsi')
            ->get();

        // Format data
        $response = [
            'data_laki' => $dataLaki,
            'data_perempuan' => $dataPerempuan,
        ];

        return response()->json($response);
    }
}
