<?php

namespace App\Http\Controllers;

use App\Models\BoardList;
use Illuminate\Http\Request;

class BoardListController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        // way to replace array.length in php
        $boardLists = BoardList::all();
        $length = 0;
        foreach($boardLists as $board){
            $length++;
        }

        // create board list, always add 1 from sum boardlist
        $create = BoardList::create([
            'name' => $request->name,
            'board_id' => $id,
            'order' => $length + 1
        ]);

        return response()->json(['message'=> 'Create list success', 'data' => $create], 200);
    }

    public function update(Request $request, $board_id, $list_id )
    {
        $request->validate([
            'name' => 'required'
        ]);

        //get boardlist
        $boardList = BoardList::where('id',$list_id)->where('board_id', $board_id)->first();

        //update boardlist
        $boardList->update([
            'name' => $request->name,
        ]);

        return response()->json(['message'=> 'Update list success'], 200);
    }

    public function destroy($board_id, $list_id)
    {
        //get boardlist
        $boardList = BoardList::where('id', $list_id)->where('board_id', $board_id)->first();

        $boardList->delete();

        return response()->json(['message'=> 'Delete list success'], 200);
    }

    public function moveToRight($board_id, $list_id)
    {
        // replace array.length
        $boardlistsCheck = BoardList::all();
        $length = 0;
        foreach($boardlistsCheck as $boardListCheck){
            $length++;
        }

        // get boardlist
        $boardList = BoardList::where('id', $list_id)->where('board_id', $board_id)->first();

        //checker
        if($boardList->order >= $length)  return response()->json(["message" => 'Max right']);

        // lest 1 the boarlistmore 1
        $boardListMore1 = BoardList::where('order', $boardList->order + 1)->where('board_id', $board_id)->first();
        $boardListMore1->update([
            'order' => $boardListMore1->order - 1,
        ]);

        // add 1 the current boardlist
        $boardList->update([
            'order' => $boardList->order + 1,
        ]);

        return response()->json(['message'=> 'Move right success'], 200);
    }

    public function moveToLeft($board_id, $list_id)
    {
        // get board list
       $boardList = BoardList::where('id', $list_id)->where('board_id', $board_id)->first();

       //checker
       if($boardList->order <= 1)  return response()->json(["message" => 'Max left']);

       // add 1 the boardlistless 1
       $boardListLest1 = BoardList::where('order', $boardList->order - 1)->where('board_id', $board_id)->first();
       $boardListLest1->update([
           'order' => $boardListLest1->order + 1,
       ]);

       // lest 1 the current boardlist
       $boardList->update([
           'order' => $boardList->order - 1,
       ]);

       return response()->json(['message'=> 'Move left success'], 200);
    }
}
