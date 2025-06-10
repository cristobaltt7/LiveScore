<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteTeamController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'football_data_id'   => 'required|integer',
            'transfermarkt_id'   => 'required|integer',
            'team_name'          => 'required|string',
            'team_logo'          => 'required|string',
        ]);

        $user = auth()->user();
        $favorites = json_decode($user->favorite_teams ?? '{}', true);

        $teamId = $request->football_data_id;
        $exists = isset($favorites[$teamId]);

        if ($exists) {
            unset($favorites[$teamId]);
        } else {
            $favorites[$teamId] = [
                'name'              => $request->team_name,
                'logo'              => $request->team_logo,
                'transfermarkt_id'  => $request->transfermarkt_id
            ];
        }

        $user->favorite_teams = json_encode($favorites);
        $user->save();

        return response()->json([
            'favorito' => !$exists
        ]);
    }

    public function index()
    {
        $user = Auth::user();
        $favorites = json_decode($user->favorite_teams ?? '{}', true);
        return view('followed-team', compact('favorites'));
    }

    public function show()
    {
        $favorites = json_decode(auth()->user()->favorite_teams ?? '{}', true);
        return view('followed-team', compact('favorites'));
    }
}
