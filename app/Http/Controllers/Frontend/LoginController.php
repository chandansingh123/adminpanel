<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Gmopx\LaravelOWM\LaravelOWM;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected   $weatherService;

    public function __construct( LaravelOWM $weatherService)
    {
         $this->middleware('guest:web',['except' => ['logout']]);
         $this->weatherService=$weatherService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('_frontend.login.login')->with([
            'weather' => $this->weatherService->getCurrentWeather($query=['lat'=> 32.5833, 'lon'=> 86.8464], $lang = 'en', $units = 'metric', $cache = false, $time = 600)]);
        // return view('frontend.login.login')->with([
        //     'weather' => $this->weatherService->getCurrentWeather($query=['lat'=> 32.5833, 'lon'=> 86.8464], $lang = 'en', $units = 'metric', $cache = false, $time = 600)]);
    }

    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'phone'   => 'required',
            'password' => 'required|min:6'
        ]);

        // Attempt to log the user in
        if (Auth::guard('web')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('home'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->with('flash_danger', 'These credentials do not match our records.')->withInput($request->only('phone', 'remember'));
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect('/login');
    }
}
