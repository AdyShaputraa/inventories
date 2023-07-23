<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;
use Carbon\Carbon;
use App\Models\User;
use Mail;
use SendsPasswordResetEmails;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function index(Request $request) {
        return view('login.index', [ 'title' => 'login' ]);
        $remember = $request->has('remember');
        return $this->guard()->attempt($this->credentials($request), $remember);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username'=>'required',
            'password'=> 'required'
        ]);
        $remember = $request->has('remember');
        
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        } else {
            return redirect()->back()->withInput()->withErrors([
                'username' => 'Invalid credentials',
            ]);
        }
        return back()->with('error', 'Authentication error');
    }

    public function ForgotPassword() {
        return view('auth.forgot-password');
    } 
    
    public function ForgetPasswordStore(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send('auth.forget-password', ['token' => $token], function($message) use($request) {
            $message->to($request->email);
            $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
            $message->subject('Reset Password');
        });
        return back()->with('success', 'We have emailed your password reset link!');
    }

    public function ResetPassword($token) {
        return view('auth.resset-password', ['token' => $token]);
    }
    
    public function ResetPasswordStore(Request $request) {
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $update = DB::table('password_resets')->where(['token' => $request->token])->first();
        if(!$update){
            return back()->withInput()->with('error', 'Invalid token !');
        }
        $user = User::where('email', $update->email)->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $update->email ])->delete();

        return redirect('/login')->with('success', 'Your password has been successfully changed !');
    }
    
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
