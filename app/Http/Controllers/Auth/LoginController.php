<?php

namespace App\Http\Controllers\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle user login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            // Authentication passed and user has the "admin" role, redirect to admin panel
            return redirect()->intended('/home');
        } else {
            // Authentication passed, but user does not have the "admin" role, redirect to regular home
            return redirect()->intended('/home');
        }
    } else {
        // Authentication failed, redirect back to the login form with an error message
        return redirect()->back()->withInput()->withErrors(['email' => 'Invalid credentials']);
    }
}

    /**
     * Handle user logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Clear the user's session data
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the desired page after logout
        return redirect()->intended('/');
    }
}
