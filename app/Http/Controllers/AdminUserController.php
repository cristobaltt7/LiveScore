<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{

    // Muestra una lista de usuarios, con opción de filtrar por nombre
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->get();

        return view('admin.users.index', compact('users', 'search'));
    }

    // Muestra el perfil completo de un usuario incluyendo sus equipos favoritos
    public function show(User $user)
    {
        $favorites = json_decode($user->favorite_teams ?? '{}', true);
        return view('admin.users.show', compact('user', 'favorites'));
    }

    // Actualiza el rol del usuario (user/admin)
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('status', 'Rol actualizado correctamente.');
    }

    // Actualiza el nombre, email y (opcionalmente) la contraseña del usuario
    public function updateProfile(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('status', 'Perfil actualizado correctamente.');
    }

    // Actualiza la contraseña del usuario
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'Contraseña actualizada correctamente.');
    }

    // Elimina un equipo favorito específico del usuario (por ID)
    public function deleteFavoriteTeam(Request $request, User $user, $teamId)
    {
        $favorites = json_decode($user->favorite_teams ?? '{}', true);

        if (isset($favorites[$teamId])) {
            unset($favorites[$teamId]);
            $user->favorite_teams = json_encode($favorites);
            $user->save();
        }

        return back()->with('status', 'Equipo favorito eliminado.');
    }

    // Elimina completamente un usuario, con confirmación de seguridad
    public function destroy(Request $request, User $user)
    {
        $confirm = $request->input('confirm');

        if ($confirm !== 'ELIMINAR') {
            return back()->withErrors(['confirm' => 'Debes escribir ELIMINAR para confirmar.']);
        }

        $user->delete();

        return redirect()->route('admin.users')->with('status', 'Usuario eliminado.');
    }

    // Elimina un equipo de la lista de favoritos
    public function removeFavorite(User $user, $teamId)
    {
        $favorites = json_decode($user->favorite_teams ?? '{}', true);

        if (isset($favorites[$teamId])) {
            unset($favorites[$teamId]);
            $user->favorite_teams = json_encode($favorites);
            $user->save();
        }

        return back()->with('status', 'Equipo eliminado de favoritos.');
    }
}
