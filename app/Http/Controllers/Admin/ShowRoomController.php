<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\ShowRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowRoomController extends Controller
{
    //
    public function index(Request $request)
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

public function calculateTotal(Request $request)
{

    $range = $request->input('range');
    $total = 0;

    switch ($range) {
        case 'today':
            $total = ShowRoom::whereDate('created_at', Carbon::today())->sum('price');
            break;

        case 'this_week':
            $total = ShowRoom::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('price');
            break;

        case 'this_month':
            $total = ShowRoom::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('price');
            break;

        case 'this_year':
            $total = ShowRoom::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('price');
            break;

        case 'custom':
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            if ($start_date && $end_date) {
                $total = ShowRoom::whereBetween('created_at', [$start_date, $end_date])->sum('price');
            }
            break;

        default:
            $total = ShowRoom::whereDate('created_at', Carbon::today())->sum('price');
            break;
    }

    // Return the total as a JSON response
    return response()->json(['total' => $total]);
}
}
