<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function store(Request $request, $board_id, $list_id)
    {
        $request->validate([
            'task' => 'required'
        ]);

        // way to replace arr.length in php
        $cards = Card::all();
        $length = 0;
        foreach($cards as $card){
            $length++;
        }

        //create and every add 1 for order from sum cards
        $create = Card::create([
            'task' => $request->task,
            'list_id' => $list_id,
            'order' => $length + 1
        ]);

        return response()->json(['message'=> 'Create card success', 'data' => $create], 200);
    }

    public function update(Request $request, $board_id, $list_id, $card_id)
    {
        $request->validate([
            'task' => 'required'
        ]);

        // get the card
        $card = Card::where('id',$card_id)->where('list_id', $list_id)->first();

        $card->update([
            'task' => $request->task,
        ]);

        return response()->json(['message'=> 'Update card success'], 200);
    }

    public function destroy($board_id, $list_id, $card_id)
    {
        // get card
        $card = Card::where('id',$card_id)->where('list_id', $list_id)->first();

        $card->delete();

        return response()->json(['message'=> 'Delete card success'], 200);
    }

    public function moveToDown($card_id)
    {
        // replace array.length
        $cardCheck = Card::all();
        $length = 0;
        foreach($cardCheck as $boardListCheck){
            $length++;
        }

        // get card
        $card = Card::where('id', $card_id)->first();

        //checker
        if($card->order >= $length)  return response()->json(["message" => 'Max up']);

        // lest 1 the card more 1
        $cardMore1 = Card::where('order', $card->order + 1)->first();
        $cardMore1->update([
            'order' => $cardMore1->order - 1,
        ]);

        // add 1 current card
        $card->update([
            'order' => $card->order + 1,
        ]);

        return response()->json(['message'=> 'Move to down success'], 200);
    }

    public function moveToUp($card_id)
    {
        // get card
        $card = Card::where('id', $card_id)->first();

        //checker
        if($card->order <= 1)  return response()->json(["message" => 'Max down']);

        // add 1 the card lest 1
        $cardLess1 = Card::where('order', $card->order - 1)->first();
        $cardLess1->update([
            'order' => $cardLess1->order = 1,
        ]);

        // lest 1 the current card
        $card->update([
            'order' => $card->order - 1,
        ]);

        return response()->json(['message'=> 'Move to up success'], 200);
    }

    public function moveToAnotherList($card_id, $list_id) {
        // get card
        $card = Card::where('id', $card_id)->first();

        // update the list_id
        $card->update([
            'list_id' => $list_id,
        ]);

        return response()->json(['message'=> 'Move to another list success'], 200);

    }
}
