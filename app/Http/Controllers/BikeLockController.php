<?php
namespace App\Http\Controllers;

use App\Models\BikeLocks;
use App\Models\BikeRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BikeLockController extends Controller
{
    public function index()
    {
       // $mountainbikes = Bike::where('type', 'mountain')->get();
        $bikelocks = BikeLocks::all();
        

        return view('bike-locks.index', compact('bikelocks'));
    }

    public function store(Request $request)
    {
        // Logic to create a new rental
        $bikelock = BikeLocks::find($request->lock_id);
        $bikelock->status = 'hired';
        $bikelock->save();

        BikeRental::create([
            'bike_id' => $request->bike_id,
            'order_number' => $request->order_number,
            'name' => $request->name,
            'duration' => $request->duration,
            'helmet_borrowed' => $request->helmet_borrowed ?? false,
            'lock_borrowed' => $request->lock_borrowed ?? false,
        ]);

        return redirect()->route('bike-locks.index')->with('status', 'Bike Lock rented successfully!');
    }

    public function updateBikeLockStatus(Request $request, $lock_id)
    {
        $bikelock = BikeLocks::find($lock_id);
        $bikelock->status = $request->status;
        $bikelock->save();
        return redirect()->back()->with('status', 'bikelock Lock status updated!');
    }
}