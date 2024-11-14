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
        // Check if this is an AJAX request for filtering data
        if ($request->ajax()) {
            // Filter data based on the selected range
            if ($request->range === 'today') {
                $data = ShowRoom::whereDate('created_at', now())->orderBy('created_at', 'desc')->get();
            } elseif ($request->range === 'yesterday') {
                $data = ShowRoom::whereDate('created_at', now()->subDay())->orderBy('created_at', 'desc')->get();
            } elseif ($request->range === 'custom') {
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $data = ShowRoom::whereBetween('created_at', [$start_date, $end_date])
                                ->orderBy('created_at', 'desc')->get();
            } else {
                // Default case: show all data
                $data = ShowRoom::orderBy('created_at', 'desc')->get();
            }
    
            // Return the filtered data as JSON for AJAX
            return response()->json(['records' => $data]);
        }
    
        // For the initial page load, fetch all data
        $data = ShowRoom::orderBy('created_at', 'desc')->get();
    
        // Return the view with all records
        return view("admin.showroom.index", compact('data'));
    }
    

    public function storeCardPartKindPrice(Request $request)
{
    $counter = ShowRoom::count() + 1; // Update based on your logic
// dd($request->names);
    $partKindPrice = new ShowRoom();
    $partKindPrice->name = $request->names;
    $partKindPrice->part = $request->part;
    $partKindPrice->kind = $request->kind;
    $partKindPrice->price = $request->price;
    $partKindPrice->save();

    return response()->json([
        'counter' => $counter,
        'name' => $partKindPrice->name,
        'part' => $partKindPrice->part,
        'kind' => $partKindPrice->kind,
        'price' => $partKindPrice->price
    ]);
}
public function update(Request $request, $id)
{
    $part = ShowRoom::find($id);
    
    if ($part) {
        $part->name = $request->input('name');
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
    // return redirect()->back();
}

public function calculateTotal(Request $request)
{
    $range = $request->input('range');
    $total = 0;
    $records = [];

    switch ($range) {
        case 'today':
            $records = ShowRoom::whereDate('created_at', Carbon::today())->get();
            $total = $records->sum('price');
            break;

        case 'yesterday':
            $records = ShowRoom::whereDate('created_at', Carbon::yesterday())->get();
            $total = $records->sum('price');
            break;

        case 'this_week':
            $records = ShowRoom::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            $total = $records->sum('price');
            break;

        case 'this_month':
            $records = ShowRoom::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
            $total = $records->sum('price');
            break;

        case 'this_year':
            $records = ShowRoom::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
            $total = $records->sum('price');
            break;

        case 'custom':
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            if ($start_date && $end_date) {
                $records = ShowRoom::whereBetween('created_at', [$start_date, $end_date])->get();
                $total = $records->sum('price');
            }
            break;

        default:
            $records = ShowRoom::whereDate('created_at', Carbon::today())->get();
            $total = $records->sum('price');
            break;
    }

    // Return the total and records as a JSON response
    return response()->json(['total' => $total, 'records' => $records]);
}

}
