<?php

namespace App\Http\Controllers;

use App\Models\WaterMeterReading;
use App\Models\PoolList;
use App\Models\PlantroomList;
use App\Charts\WaterBalanceChart;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;



class WaterMeterReadingController extends Controller
{
    public function index($plantroomID, LarapexChart $chart)
    {
        $readings = WaterMeterReading::where('plantroom_id', $plantroomID)->orderBy('created_at', 'desc')->get();
        // $poolName = PoolList::where('pool_name', $poolID)->get();
        $plantroomName = PlantroomList::where('plantroom_id', $plantroomID)->value('plantroom_name');
        $watermeterreadings = WaterMeterReading::where('plantroom_id', $plantroomID)->orderBy('created_at', 'asc')->get();
        $i=0;
        $diffs = array();
        $count = 0;
        $prevNum =0;
$diffs = 0;
foreach($watermeterreadings as $i =>$watermeterreading) { 
    
    $diffs = $watermeterreading['meter_reading'] - $prevNum; 
    $prevNum = $watermeterreading['meter_reading'];
    $i++;

} 


        $labels = [];
        $litres = [];

        foreach ($watermeterreadings as $watermeterreading){

            $labels[]=date_format($watermeterreading['created_at'],'d/m/y');
            $litres[]=$watermeterreading['difference'];

        }
        $chart = $chart->barChart()
        ->setTitle('Litres')
        ->addData('litres',  $litres)
        ->setXAxis( $labels);
        
           return view('water-meter-readings.index', compact('readings' ,'plantroomID','plantroomName','chart','labels','litres','diffs'));
    }




    public function create($plantroomID)
    {
        $plantroomID = $plantroomID;
       // $plantroomID = $poolID;
        $plantroomName = PlantroomList::where('plantroom_id', $plantroomID)->value('plantroom_name');
        $WaterMeterReading = WaterMeterReading::all();
        return view('water-meter-readings.create', compact('WaterMeterReading','plantroomID', 'plantroomName'));
    }

    public function store(Request $request)
    {
        $latestreadings =0;
        //enter 0 sum checks for new plantrooms
        $latestreadings = WaterMeterReading::where('plantroom_id', $request->input('plantroom_id'))->orderBy('created_at', 'desc')->firstOrFail();
        
        $diff = $request->input('meter_reading')-$latestreadings->meter_reading;
        WaterMeterReading::create($request->all()+ ['logged_by' => auth()->id()]+ ['difference' => $diff]);
        return redirect()->route('water-meter-readings.index',[$request->input('plantroom_id')])->with('success', 'Reading logged successfully.');
    }

    // Add more methods like show, edit, update, destroy if needed
}