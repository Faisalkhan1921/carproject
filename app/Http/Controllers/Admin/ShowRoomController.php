<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShowRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowRoomController extends Controller
{
    //
    public function index()
    {
        $data = ShowRoom::all();
        return view("admin.showroom.index",compact('data'));
    }

    public function storeCardPartKindPrice(Request $request)
{
    $counter = ShowRoom::count() + 1; // Update based on your logic

    $partKindPrice = new ShowRoom();
    $partKindPrice->part = $request->part;
    $partKindPrice->kind = $request->kind;
    $partKindPrice->price = $request->price;
    $partKindPrice->save();

    return response()->json([
        'counter' => $counter,
        'part' => $partKindPrice->part,
        'kind' => $partKindPrice->kind,
        'price' => $partKindPrice->price
    ]);
}
public function update(Request $request, $id)
{
    $part = ShowRoom::find($id);
    
    if ($part) {
        $part->part = $request->input('part');
        $part->kind = $request->input('kind');
        $part->price = $request->input('price');
        $part->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Part not found.']);
}


public function destroy($id)
{
    // Find the car part by ID
    $carPart = ShowRoom::find($id);

    // Check if the car part exists
    if (!$carPart) {
        return response()->json([
            'success' => false,
            'message' => 'Car part not found'
        ], 404);
    }

    // Delete the car part
    $carPart->delete();

    // Return a success response
    return response()->json([
        'success' => true,
        'message' => 'Car part deleted successfully'
    ], 200);
}
}
