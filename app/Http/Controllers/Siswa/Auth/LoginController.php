<?php

namespace App\Http\Controllers\Siswa\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
        |--------------------------------------------------------------------------
        | Login Controller
        |--------------------------------------------------------------------------
        |
        | This controller handles authenticating users for the application and
        | redirecting them to your home screen. The controller uses a trait
        | to conveniently provide its functionality to your applications.
        |
        */

    /**
     * Max login attempts allowed.
     */
    public $maxAttempts = 5;

    /**
     * Number of minutes to lock the login.
     */
    public $decayMinutes = 3;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'siswa/home';

    protected $username = 'username';

    /**
     * Only guests for "siswa" guard are allowed except
     * for logout.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:siswa')->except('logout');
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('siswa.auth.login');
    }

    /**
     * Login the admin.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        //check if the user has too many login attempts.
//        if ($this->hasTooManyLoginAttempts($request)){
//            //Fire the lockout event
//            $this->fireLockoutEvent($request);
//
//            //redirect the user back after lockout.
//            return $this->sendLockoutResponse($request);
//        }

        //attempt login.
        if(Auth::guard('siswa')->attempt($request->only('username','password'),$request)){
            //Authenticated, redirect to the intended route
            //if available else admin dashboard.
            Log::info('logged-in');

            return redirect()
                ->to(route('siswa.home'))
                ->with('status','You are Logged in as Siswa!');
        }

        //keep track of login attempts from the user.
//        $this->incrementLoginAttempts($request);

        //Authentication failed, redirect back with input.
        return $this->loginFailed();
    }

    /**
     * Logout the admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('siswa')->logout();
        return redirect()
            ->route('siswa.login')
            ->with('status','Siswa has been logged out!');
    }

    /**
     * Redirect back after a failed login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed(){
        return redirect()
            ->to(route('siswa.login'))
            ->withInput()
            ->with('error','Login failed, please try again!');
    }

    /**
     * Username used in ThrottlesLogins trait
     *
     * @return string
     */
    public function username(){
        return 'username';
    }
}
