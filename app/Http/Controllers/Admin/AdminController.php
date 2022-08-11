<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
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
        $admins = Admin::all()->except(Auth::user()->id_admin = 1);
        return view('admin.admin.index', compact('admins'));
    }

    public function form(Request $request, $id = null) {
        $admin = new Admin();
        $isNew = true;

        if ($id != null)
        {

            $admin = Admin::find($id);
            $isNew = false;
        }
        return view('admin.admin.form', compact('admin', 'isNew'));
    }

    public function store(Request $request) {
        $admin;

        if (request('id_admin') != null) {
            $validatedData = $request->validate([
                'username' => Rule::unique('admin')->ignore(request('id_admin'), 'id_admin'),
            ]);
            // Update
            $action = 'update';
            $admin = Admin::find(request('id_admin'));
        } else {
            $validatedData = $request->validate([
                'username' => Rule::unique('admin')->ignore(request('id_admin'), 'id_admin'),
                'password' => 'required|confirmed',
            ]);
            // Create
            $action = 'create';
            $admin = new Admin;
            $admin->password = Hash::make(request('password'));
        }

        $admin->nama = request('nama');
        $admin->username = request('username');
        $admin->alamat = request('alamat');
        $admin->tempat_lahir = request('tempat_lahir');
        $admin->tanggal_lahir = request('tanggal_lahir');
        $admin->jabatan = request('jabatan');

        try
        {
            $admin->save();
            return redirect()->route('admin.admin.list')->with(['success' => "\"{$admin->nama}\" has been successfully {$action}d."]);
        }
        catch(\Exception $e){
            $data = request()->all();
            return redirect()->back()
                ->with(['error' => "Failed to {$action} \"{$admin->nama}\". Cause: {$e->getMessage()}"])
                ->with('data', $data)->withInput();
        }
    }

    public function detail($id)
    {
        $admin = Admin::find($id);
        return view('admin.admin.detail', compact('admin'));
    }

    public function delete(Request $request){
        $admin = Admin::find(request('id_admin'));
        try
        {
            $admin->delete();
            return redirect()->route('admin.admin.list')->with(['success' => "\"{$admin->nama}\" has been successfully deleted."]);
        }
        catch(\Exception $e){
            $data = request()->all();
            return redirect()->back()
                ->with(['error' => "Failed to delete \"{$admin->nama}\". Cause: {$e->getMessage()}"])
                ->with('data', $data)->withInput();
        }
    }
}
