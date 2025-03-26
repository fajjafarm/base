<?php
namespace App\Http\Controllers;

use App\Models\BikeHelmets;
use App\Models\BikeRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BikeHelmetController extends Controller
{
    public function index()
    {
       // $mountainbikes = Bike::where('type', 'mountain')->get();
        $bikehelmets = BikeHelmets::all();
        

        return view('bike-helmets.index', compact('bikehelmets'));
    }

    public function store(Request $request)
    {
        // Logic to create a new rental
        $bikehelmets = BikeHelmets::find($request->helmet_id);
        $bikehelmets->status = 'hired';
        $bikehelmets->save();

        BikeRental::create([
            'bike_id' => $request->bike_id,
            'order_number' => $request->order_number,
            'name' => $request->name,
            'duration' => $request->duration,
            'helmet_borrowed' => $request->helmet_borrowed ?? false,
            'lock_borrowed' => $request->lock_borrowed ?? false,
        ]);

        return redirect()->route('bike-helmets.index')->with('status', 'Bike helmet rented successfully!');
    }

    public function updateBikeHelmetStatus(Request $request, $helmet_id)
    {
        $bikehelmet = BikeHelmets::find($helmet_id);
        $bikehelmet->status = $request->status;
        $bikehelmet->save();
        return redirect()->back()->with('status', 'bike helmet Lock status updated!');
    }
}