<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;


class BoardController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boards = Board::all();

        return response()->json(['message'=> 'Success get all board', 'data' => $boards], 200);
   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        //get data actor is loginging
        $token = $request->query('token');
        $dataLogin = Controller::dataLogin($token);

        // create board
        $create = Board::create([
            'name' => $request->name,
            'creator_id' => $dataLogin->id
        ]);

        return response()->json(['message'=> 'Create board success', 'data' => $create], 200);
   
   
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $board = Board::where('id', $id)->with('members')->with('lists', function($query){
            $query->with('cards');
        })->first();

        return response()->json(['message'=> 'Success get single board', 'data' => $board], 200);
   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board $board)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        //get board
        $board = Board::where('id', $id)->first();

        //update board
        $board->update([
            'name' => $request->name,
        ]);

        return response()->json(['message'=> 'Update board success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //get board
        $board = Board::where('id', $id)->first();

        //delete board
        $board->delete();

        return response()->json(['message'=> 'Delete success'], 200);
   
    }
}
