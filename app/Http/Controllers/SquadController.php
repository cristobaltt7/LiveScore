<?php

namespace App\Http\Controllers;

use App\Models\Squad;
use Illuminate\Http\Request;

class SquadController extends Controller
{
    public function create(Request $request)
    {
        $teamId = $request->input('team_id');
        return view('squads.create', ['team_id' => $teamId]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:50',
            'number' => 'nullable|integer|min:1|max:99',
        ]);

        Squad::create($validated);

        return redirect()->route('football.team', $validated['team_id'])->with('success', 'Jugador añadido correctamente');
    }

    public function destroy(Squad $squad)
    {
        $teamId = $squad->team_id;
        $squad->delete();

        return redirect()->route('football.team', $teamId)->with('success', 'Jugador eliminado');
    }
}
