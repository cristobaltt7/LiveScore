<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->with('error', 'Credenciales incorrectas.'); // Este es el que usas en el login.blade.php
}


    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'secret_question' => 'required|string|max:255',
            'secret_answer' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // <-- esto
            'secret_question' => $request->secret_question,
            'secret_answer' => $request->secret_answer,

        ]);

        Auth::login($user);
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
public function showForgotPassword()
{
    return view('auth.forgot-password');
}

public function verifySecretAnswer(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'secret_answer' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Usuario no encontrado.']);
    }

    if ($user->secret_answer !== $request->secret_answer) {
        return back()->withErrors(['secret_answer' => 'La respuesta secreta no es correcta.']);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('login')->with('status', 'Contraseña actualizada correctamente. Ahora puedes iniciar sesión.');
}


}
