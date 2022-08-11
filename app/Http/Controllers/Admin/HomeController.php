<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Only Authenticated users for "admin" guard
     * are allowed.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show Admin Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.home.index');
    }

    public function changePassword(Request $request) {
        $success = true;
        $errorMessage = "";

        $admin = Admin::find(Auth::user()->id_admin);

        if ($admin != null)
        {
            $oldPassword = request('old_password');
            $newPassword = request('new_password');
            $newPassword2 = request('retype_new_password');

            // Check if old password given is correct
            if (Hash::check($oldPassword,$admin->password)) {
                // Check if both new password are correct
                if ($newPassword == $newPassword2) {
                    // Save new password
                    $admin->password = bcrypt($newPassword);
                    $admin->save();
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
}
