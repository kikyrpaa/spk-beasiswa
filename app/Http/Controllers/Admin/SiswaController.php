<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
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
        $siswas = Siswa::all();
        return view('admin.siswa.index', compact('siswas'));
    }

    public function form(Request $request, $id = null) {
        $siswa = new Siswa();
        $isNew = true;

        if ($id != null)
        {

            $siswa = Siswa::find($id);
            $isNew = false;
        }
//        ddd($siswa);
        return view('admin.siswa.form', compact('siswa', 'isNew'));
    }

    public function create(Request $request) {
        $validatedData = $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:siswa,username,'.$this->user()->id,
            'password' => 'required|confirmed',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nilai_rapot' => 'required',
            'foto_siswa' => 'image|file|max:2048',
            'foto_rapot' => 'image|file|max:2048',
            'sertifikat_prestasi' => 'image|file|max:2048',
            'sertifikat_hafidh' => 'image|file|max:2048'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->file('foto_siswa')) {
            $validatedData['foto_siswa'] = $request->file('foto_siswa')->store('post-images');
        }

        Siswa::create($validatedData);
        return redirect()->route('admin.siswa.list')->with(['success' => "\"{$validatedData['nama']}\" has been successfully created."]);
//        try
//        {
//            Siswa::create($validatedData);
//            return redirect()->route('admin.siswa.list')->with(['success' => "\"{$validatedData['nama']}\" has been successfully created."]);
//        }
//        catch(\Exception $e){
//            $data = request()->all();
//            return redirect()->back()
//                ->with(['error' => "Failed to create \"{$validatedData['nama']}\". Cause: {$e->getMessage()}"])
//                ->with('data', $data)->withInput();
//        }
    }

    public function store(Request $request) {
        if (request('id_siswa') != null) {
            $validatedData = $request->validate([
                'nama' => 'required',
                'username' => Rule::unique('siswa')->ignore(request('id_siswa'), 'id_siswa'),
                'alamat' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'nilai_rapot' => 'required',
                'foto_siswa' => 'image|max:2048',
                'foto_rapot' => 'image|max:2048',
                'sertifikat_prestasi' => 'image|max:2048',
                'sertifikat_hafidh' => 'image|max:2048'
            ]);
        } else {
            $validatedData = $request->validate([
                'nama' => 'required',
                'username' => Rule::unique('siswa')->ignore(request('id_siswa'), 'id_siswa'),
                'password' => 'required|confirmed',
                'alamat' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'nilai_rapot' => 'required',
                'foto_siswa' => 'image|max:2048',
                'foto_rapot' => 'image|max:2048',
                'sertifikat_prestasi' => 'image|max:2048',
                'sertifikat_hafidh' => 'image|max:2048'
            ]);
        }
        $siswa;

        if (request('id_siswa') != null) {
            // Update
            $action = 'update';
            $siswa = Siswa::find(request('id_siswa'));
        } else {
            // Create
            $action = 'create';
            $siswa = new Siswa($validatedData);
            $siswa->password = Hash::make(request('password'));
        }

        if ($request->file('foto_siswa')) {
            $validatedData['foto_siswa'] = $request->file('foto_siswa')->store('post-images');
            $siswa->foto_siswa = $validatedData['foto_siswa'];
        }

        if ($request->file('foto_rapot')) {
            $validatedData['foto_rapot'] = $request->file('foto_rapot')->store('post-images');
            $siswa->foto_rapot = $validatedData['foto_rapot'];
        }

        if ($request->file('sertifikat_prestasi')) {
            $validatedData['sertifikat_prestasi'] = $request->file('sertifikat_prestasi')->store('post-images');
            $siswa->sertifikat_prestasi = $validatedData['sertifikat_prestasi'];
        }

        if ($request->file('sertifikat_hafidh')) {
            $validatedData['sertifikat_hafidh'] = $request->file('sertifikat_hafidh')->store('post-images');
            $siswa->sertifikat_hafidh = $validatedData['sertifikat_hafidh'];
        }


        $siswa->nama = request('nama');
        $siswa->username = request('username');
        $siswa->alamat = request('alamat');
        $siswa->tempat_lahir = request('tempat_lahir');
        $siswa->tanggal_lahir = request('tanggal_lahir');
        $siswa->nilai_rapot = request('nilai_rapot');
        $siswa->juara_sertifikat_prestasi = request('juara_sertifikat_prestasi');
        $siswa->tingkat_sertifikat_prestasi = request('tingkat_sertifikat_prestasi');
        $siswa->juz_sertifikat_hafidh = request('juz_sertifikat_hafidh');
        $siswa->save();
        return redirect()->route('admin.siswa.list')->with(['success' => "\"{$siswa->nama}\" has been successfully {$action}d."]);
    }

    public function detail($id)
    {
        $siswa = Siswa::find($id);
        return view('admin.siswa.detail', compact('siswa'));
    }

    public function delete(Request $request){
        $siswa = Siswa::find(request('id_siswa'));
        try
        {
            $siswa->delete();
            return redirect()->route('admin.siswa.list')->with(['success' => "\"{$siswa->nama}\" has been successfully deleted."]);
        }
        catch(\Exception $e){
            $data = request()->all();
            return redirect()->back()
                ->with(['error' => "Failed to delete \"{$siswa->nama}\". Cause: {$e->getMessage()}"])
                ->with('data', $data)->withInput();
        }
    }

    public function verify(Request $request){
        $siswa = Siswa::find(request('id_siswa'));
        if (!($siswa->status_sertifikat_pretasi || $siswa->status_sertifikat_hafidh)) {
            return redirect()->back()
                ->with(['error' => "Failed to verify \"{$siswa->nama}\". Cause: certificate is not verified yet"]);
        }
        $siswa->status = true;
        try
        {
            $siswa->save();
            return redirect()->route('admin.siswa.list')->with(['success' => "\"{$siswa->nama}\" has been successfully verified."]);
        }
        catch(\Exception $e){
            $data = request()->all();
            return redirect()->back()
                ->with(['error' => "Failed to verify \"{$siswa->nama}\". Cause: {$e->getMessage()}"])
                ->with('data', $data)->withInput();
        }
    }

    public function verifyPrestasi(Request $request){
        $siswa = Siswa::find(request('id_siswa'));
        $siswa->status_sertifikat_prestasi = true;
        try
        {
            $siswa->save();
            return redirect()->route('admin.siswa.list')->with(['success' => "\"{$siswa->nama}\" certificate has been successfully verified."]);
        }
        catch(\Exception $e){
            $data = request()->all();
            return redirect()->back()
                ->with(['error' => "Failed to verify \"{$siswa->nama}\". Cause: {$e->getMessage()}"])
                ->with('data', $data)->withInput();
        }
    }

    public function verifyHafidh(Request $request){
        $siswa = Siswa::find(request('id_siswa'));
        $siswa->status_sertifikat_hafidh = true;
        try
        {
            $siswa->save();
            return redirect()->route('admin.siswa.list')->with(['success' => "\"{$siswa->nama}\" has been successfully verified."]);
        }
        catch(\Exception $e){
            $data = request()->all();
            return redirect()->back()
                ->with(['error' => "Failed to verify \"{$siswa->nama}\". Cause: {$e->getMessage()}"])
                ->with('data', $data)->withInput();
        }
    }
}
