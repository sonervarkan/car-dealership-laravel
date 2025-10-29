<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    // REGISTER
    public function showRegister(){
        $roles = Roles::all();
        return view('register', compact('roles'));
    }

    public function register(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required',
            'role_id' => 'required|numeric|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect('/login')->with('success', 'Kayıt başarılı! Giriş yapabilirsiniz.');
    }

    // LOGIN
    public function showLogin(){
        return view('login');
    }

    public function login(Request $request){
        // validate() metodunun döndürdüğü değer sadece doğrulanmış verilerdir.
        // Auth::attempt() metodu, diziyi direkt olarak kabul eder.
        $credentials = $request->validate([
            'email' => 'required|email',
            // Auth::attempt otomatik olarak parolayı hashlenmiş haliyle karşılaştırır.
            'password' => 'required|string',
        ]);

        if(Auth::attempt($credentials)){
            // Oturum yenileme (Session Fixation önlemek için iyi bir pratik)
            $request->session()->regenerate();
            return redirect()->intended('/'); // intended() kullanıcıyı gelmek istediği yere yönlendirir
        }else{
            // Hata mesajını `withErrors` veya `with` metotları ile gönderin.
            // Bu, Blade içinde `$errors->all()` ile yakalanabilir.
            return back()->withErrors([
                'email' => 'Girilen e-posta veya parola hatalıdır.',
            ])->onlyInput('email'); // Sadece e-posta alanını doldurur
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
