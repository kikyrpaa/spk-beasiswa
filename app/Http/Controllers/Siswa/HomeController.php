<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\BeasiswaSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Only Authenticated users for "siswa" guard
     * are allowed.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }

    /**
     * Show Admin Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $id = Auth::user()->id_siswa;
        $siswa = Siswa::with('beasiswas')->where('id_siswa',$id)->first();
        $beasiswaSiswa = BeasiswaSiswa::with(['siswa', 'beasiswa'])->where('id_siswa','=',$id)->get();
//        dd($beasiswaSiswa, $siswa);
        return view('siswa.home.index', compact(['siswa','beasiswaSiswa']));
    }

    public function changePassword(Request $request) {
        $success = true;
        $errorMessage = "";

        $siswa = Siswa::find(Auth::user()->id_siswa);

        if ($siswa != null)
        {
            $oldPassword = request('old_password');
            $newPassword = request('new_password');
            $newPassword2 = request('retype_new_password');

            // Check if old password given is correct
            if (Hash::check($oldPassword,$siswa->password)) {
                // Check if both new password are correct
                if ($newPassword == $newPassword2) {
                    // Save new password
                    $siswa->password = bcrypt($newPassword);
                    $siswa->save();
                } else {
                    $success = false;
                    $errorMessage = "New passwords don't match.";
                }
            } else {
                $success = false;
                $errorMessage = "Old password is incorrect.";
            }
        }
        else
        {
            $success = false;
            $errorMessage = "User not found or your session has expired.";
        }

        if ($success) {
            return redirect()->back()->with(['success' => "You have successfully changed your password!"]);
        } else {
            return redirect()->back()
                ->with(['error' => "Failed to change your password. Cause: {$errorMessage}"]);
        }
    }

    public function form(Request $request, $id = null) {
        $siswa = Siswa::find($id);
        return view('siswa.form', compact('siswa'));
    }

    public function store(Request $request) {
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

        $action = 'update';
        $siswa = Siswa::find(request('id_siswa'));

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
        return redirect()->route('siswa.home')->with(['success' => "\"{$siswa->nama}\" has been successfully {$action}d."]);
    }
}
