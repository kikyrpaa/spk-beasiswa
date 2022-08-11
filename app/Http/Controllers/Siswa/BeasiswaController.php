<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\Siswa;
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
        $this->middleware(['auth:siswa']);
    }

    /**
     * Show Admin Dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $beasiswas = Beasiswa::with('siswas')->get();
        foreach ($beasiswas as $key=>$value){
            $exists = $value->siswas->contains(Auth::user()->id_siswa);
            $value->apply = !$exists;
        }
        return view('siswa.beasiswa.index', compact('beasiswas'));
    }

    public function detail($id)
    {
        $beasiswa = Beasiswa::find($id);
        return view('siswa.beasiswa.detail', compact('beasiswa'));
    }

    public function apply(Request $request){
        $beasiswa = Beasiswa::find(request('id_beasiswa'));
        $siswa = Siswa::find(Auth::user()->id_siswa);
        if (!$siswa->status) {
            return redirect()->route('siswa.beasiswa')->with(['error' => "You are not yet verified"]);
        }
        try
        {
            $beasiswa->siswas()->attach($siswa);
            return redirect()->route('siswa.beasiswa')->with(['success' => "\"{$beasiswa->nama_beasiswa}\" has been successfully applied."]);
        }
        catch(\Exception $e){
            $data = request()->all();
            return redirect()->back()
                ->with(['error' => "Failed to apply \"{$beasiswa->nama_beasiswa}\". Cause: {$e->getMessage()}"])
                ->with('data', $data)->withInput();
        }
    }
}
