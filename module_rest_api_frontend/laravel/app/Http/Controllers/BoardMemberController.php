<?php

namespace App\Http\Controllers;

use App\Models\BoardMember;
use App\Models\Board;
use App\Models\Actor;
use Illuminate\Http\Request;

class BoardMemberController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'username' => 'required'
        ]);

        //get actor
        $actor = Actor::where('username', $request->username)->first();

        //get actor id by username input
        $create = BoardMember::create([
            'actor_id' => $actor->id,
            'board_id' => $id
        ]);

        return response()->json(['message'=> 'Add member success'], 200);
    }


    public function destroy($board_id, $actor_id)
    {
        //get board member by board_id and actor_id
        $board = BoardMember::where('board_id', $board_id)->where('actor_id', $actor_id)->first();

        $board->delete();

        return response()->json(['message'=> 'Remove member success'], 200);
    }
}
