<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BeasiswaSiswa;

class BeasiswaSiswaController extends Controller
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
        $beasiswaSiswa = BeasiswaSiswa::with(['siswa', 'beasiswa'])->get();
        return view('admin.beasiswa-siswa.index', compact('beasiswaSiswa'));
    }
}
