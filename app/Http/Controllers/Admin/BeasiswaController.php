<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\BeasiswaSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeasiswaController extends Controller
{
    /**
     * Only Authenticated users for "admin" guard
     * are allowed.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    /**
     * Show Admin Dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $beasiswas = Beasiswa::all();
        return view('admin.beasiswa.index', compact('beasiswas'));
    }

    public function form(Request $request, $id = null) {
        $beasiswa = new Beasiswa();
        $isNew = true;
        if ($id != null)
        {
            $beasiswa = Beasiswa::find($id);
            $isNew = false;
        }
        return view('admin.beasiswa.form', compact('beasiswa', 'isNew'));
    }

    public function store(Request $request) {
        $beasiswa;

        if (request('id_beasiswa') != null) {
            // Update
            $action = 'update';
            $beasiswa = Beasiswa::find(request('id_beasiswa'));
        } else {
            // Create
            $action = 'create';
            $beasiswa = new Beasiswa();
        }

        $beasiswa->nama_beasiswa = request('nama_beasiswa');
        $beasiswa->deskripsi = request('deskripsi');
        $beasiswa->semester = request('semester');
        $beasiswa->tahun_beasiswa = request('tahun_beasiswa');
        $beasiswa->pemberi_beasiswa = request('pemberi_beasiswa');
        $beasiswa->tanggal_beasiswa = request('tanggal_beasiswa');
        $beasiswa->jumlah_penerima = request('jumlah_penerima');

        try
        {
            $beasiswa->save();
            return redirect()->route('admin.beasiswa.list')->with(['success' => "\"{$beasiswa->nama_beasiswa}\" has been successfully {$action}d."]);
        }
        catch(\Exception $e){
            $data = request()->all();
            return redirect()->back()
                ->with(['error' => "Failed to {$action} \"{$beasiswa->nama_beasiswa}\". Cause: {$e->getMessage()}"])
                ->with('data', $data)->withInput();
        }
    }

    public function detail($id)
    {
        $beasiswa = Beasiswa::find($id);
        $beasiswaSiswa = BeasiswaSiswa::with('siswa', 'beasiswa')->where('id_beasiswa','=',$id)->get();
        return view('admin.beasiswa.detail', compact(['beasiswa', 'beasiswaSiswa']));
    }

    public function delete(Request $request){
        $beasiswa = Beasiswa::find(request('id_beasiswa'));
        try
        {
            $beasiswa->delete();
            return redirect()->route('admin.beasiswa.list')->with(['success' => "\"{$beasiswa->nama_beasiswa}\" has been successfully deleted."]);
        }
        catch(\Exception $e){
            $data = request()->all();
            return redirect()->back()
                ->with(['error' => "Failed to delete \"{$beasiswa->nama_beasiswa}\". Cause: {$e->getMessage()}"])
                ->with('data', $data)->withInput();
        }
    }

    public function decide(Request $request){
        $idBeasiswa = request('id_beasiswa');
        $beasiswa = Beasiswa::find($idBeasiswa);
        $beasiswaSiswa = BeasiswaSiswa::with(['beasiswa', 'siswa'])->where('id_beasiswa','=',$idBeasiswa)->get();
        foreach ($beasiswaSiswa as $key=>$value){
            $nilaiJuara = 0;
            $value->bobot = 0;
            $value->bobot += $value->siswa->nilai_rapot;
            $value->bobot += $value->siswa->juz_sertifikat_hafidh;
            if ($value->siswa->tingkat_sertifikat_prestasi == 'kota') {
                $nilaiJuara = 4;
            } else if ($value->siswa->tingkat_sertifikat_prestasi == 'provinsi') {
                $nilaiJuara = 7;
            } else {
                $nilaiJuara = 10;
            }
            $bobotJuara = $nilaiJuara-$value->siswa->juara_sertifikat_prestasi;
            $value->bobot += $bobotJuara;
        }
        $sortedData = $beasiswaSiswa->sortByDesc('bobot');
        $array = $beasiswaSiswa->toArray();
        usort($array,function($a,$b){
            return $a['bobot'] <=> $b['bobot'];
        });
        if (sizeof($sortedData) <= $beasiswa->jumlah_penerima) {
            foreach ($array as $key=>$value) {
                $penerimaBeasiswa = BeasiswaSiswa::find($value['id_beasiswa_siswa']);
                $penerimaBeasiswa->status = 'diterima';
                $penerimaBeasiswa->save();
            }
        } else {
            //decider penerima beasiswa
            for ($i=sizeof($array)-1; $i>=0; $i--){
                $penerimaBeasiswa = BeasiswaSiswa::find($array[$i]['id_beasiswa_siswa']);
                $penerimaBeasiswa->status = 'ditolak';
                if ($i>=sizeof($array)-$beasiswa->jumlah_penerima){
                    $penerimaBeasiswa->status = 'diterima';
                }
                $penerimaBeasiswa->save();
            }

//            //decider beasiswa ditolak
//            for ($i=$beasiswa->jumlah_penerima; $i<sizeof($sortedData); $i++){
//                $penerimaBeasiswa = BeasiswaSiswa::find($sortedData[$i]->id_beasiswa_siswa);
//                $penerimaBeasiswa->status = 'ditolak';
//                $penerimaBeasiswa->save();
//            }
        }

        $beasiswa->status = 1;
        $beasiswa->save();
        return redirect()->route('admin.beasiswa.list')->with(['success' => "Decide"]);
    }
}
