<?php

namespace App\Http\Controllers;

use App\Models\WaterBalanceTest;
use App\Models\PoolList;
use Illuminate\Http\Request;

class WaterBalanceTestController extends Controller
{
    public function index($poolID)
    {
        $balances = WaterBalanceTest::where('pool_id', $poolID)->orderBy('created_at', 'desc')->get();
        // $poolName = PoolList::where('pool_name', $poolID)->get();
        $poolName = PoolList::where('pool_id', $poolID)->value('pool_name');

        return view('water-balance-checks.index', compact('balances' ,'poolID','poolName'));
    }

        public function create($poolID)
        {
            $poolID = $poolID;
            $plantroomID = $poolID;
            $poolName = PoolList::where('pool_id', $poolID)->value('pool_name');
            return view('water-balance-checks.create', compact('plantroomID', 'poolName', 'poolID'));
        }


    public function store(Request $request)
    {
        // Validation would typically go here, e.g., 
        // $request->validate([...]);



        if ($request->input('alkalinity') <= 20 ){
            $af =1;
        }
        if ($request->input('alkalinity') > 20 && $request->input('alkalinity') <= 30){
            $af =1.2;
        }
        if ($request->input('alkalinity') > 30 && $request->input('alkalinity') <= 40){
            $af =1.3;
        }
        if ($request->input('alkalinity') > 40 && $request->input('alkalinity') <= 50){
            $af =1.4;
        }
        if ($request->input('alkalinity') > 50 && $request->input('alkalinity') <= 66){
            $af =1.5;
        }
        if ($request->input('alkalinity') > 66 && $request->input('alkalinity') <= 80){
            $af =1.6;
        }
        if ($request->input('alkalinity') > 80 && $request->input('alkalinity') <= 90){
            $af =1.65;
        }
        if ($request->input('alkalinity') > 90 && $request->input('alkalinity') <= 100){
            $af =1.7;
        }
        if ($request->input('alkalinity') > 100 && $request->input('alkalinity') <= 125){
            $af =1.8;
        }
        if ($request->input('alkalinity') > 125 && $request->input('alkalinity') <= 150){
            $af =1.9;
        }
        if ($request->input('alkalinity') > 150 && $request->input('alkalinity') <= 200){
            $af =2;
        }
        if ($request->input('alkalinity') > 200 && $request->input('alkalinity') <= 250){
            $af =2.1;
        }
        if ($request->input('alkalinity') > 250 && $request->input('alkalinity') <= 300){
            $af =2.2;
        }
        if ($request->input('alkalinity') > 300 && $request->input('alkalinity') <= 350){
            $af =2.25;
        }
        if ($request->input('alkalinity') > 350 && $request->input('alkalinity') <= 400){
            $af =2.3;
        }
        if ($request->input('alkalinity') > 400 && $request->input('alkalinity') <= 500){
            $af =2.4;
        }
        if ($request->input('alkalinity') > 500 && $request->input('alkalinity') <= 550){
            $af =2.45;
        }
        if ($request->input('alkalinity') > 550 && $request->input('alkalinity') <= 600){
            $af =2.5;
        }
        if ($request->input('alkalinity') > 600 && $request->input('alkalinity') <= 700){
            $af =2.55;
        }
        if ($request->input('alkalinity') > 700 && $request->input('alkalinity') <= 800){
            $af =2.55;
        }

        if ($request->input('calcium_hardness') <= 20 ){
            $cf =1;
            }
            if ($request->input('calcium_hardness') > 20 && $request->input('calcium_hardness') <= 30){
            $cf =1.2;
            }
            if ($request->input('calcium_hardness') > 30 && $request->input('calcium_hardness') <= 40){
            $cf =1.3;
            }
            if ($request->input('calcium_hardness') > 40 && $request->input('calcium_hardness') <= 50){
            $cf =1.4;
            }
            if ($request->input('calcium_hardness') > 50 && $request->input('calcium_hardness') <= 66){
            $cf =1.5;
            }
            if ($request->input('calcium_hardness') > 66 && $request->input('calcium_hardness') <= 80){
            $cf =1.6;
            }
            if ($request->input('calcium_hardness') > 80 && $request->input('calcium_hardness') <= 90){
            $cf =1.65;
            }
            if ($request->input('calcium_hardness') > 90 && $request->input('calcium_hardness') <= 100){
            $cf =1.7;
            }
            if ($request->input('calcium_hardness') > 100 && $request->input('calcium_hardness') <= 125){
            $cf =1.8;
            }
            if ($request->input('calcium_hardness') > 125 && $request->input('calcium_hardness') <= 150){
            $cf =1.9;
            }
            if ($request->input('calcium_hardness') > 150 && $request->input('calcium_hardness') <= 200){
            $cf =2;
            }
            if ($request->input('calcium_hardness') > 200 && $request->input('calcium_hardness') <= 250){
            $cf =2.1;
            }
            if ($request->input('calcium_hardness') > 250 && $request->input('calcium_hardness') <= 300){
            $cf =2.2;
            }
            if ($request->input('calcium_hardness') > 300 && $request->input('calcium_hardness') <= 350){
            $cf =2.25;
            }
            if ($request->input('calcium_hardness') > 350 && $request->input('calcium_hardness') <= 400){
            $cf =2.3;
            }
            if ($request->input('calcium_hardness') > 400 && $request->input('calcium_hardness') <= 500){
            $cf =2.4;
            }
            if ($request->input('calcium_hardness') > 500 && $request->input('calcium_hardness') <= 550){
            $cf =2.45;
            }
            if ($request->input('calcium_hardness') > 550 && $request->input('calcium_hardness') <= 600){
            $cf =2.5;
            }
            if ($request->input('calcium_hardness') > 600 && $request->input('calcium_hardness') <= 700){
            $cf =2.55;
            }
            if ($request->input('calcium_hardness') > 700 && $request->input('calcium_hardness') <= 800){
            $cf =2.55;
            }

        $water_balance = $af + $cf +$request->input('ph') ;
        if ($water_balance < 9.6 ){
            $water_balance2 ='Highly Corrosive';
            }
            if ($water_balance >= 9.6 &&  $water_balance <= 10.5){
                $water_balance2 ='Corrosive';
                }
                if ($water_balance > 10.5 &&  $water_balance < 11){
                    $water_balance2 ='Acceptable Balance';
                    }
                    if ($water_balance >= 11 &&  $water_balance < 11.3){
                        $water_balance2 ='Ideal Balance';
                        }
                        if ($water_balance >= 11.3 &&  $water_balance < 11.7){
                            $water_balance2 ='Acceptable Balance';
                            }
                            if ($water_balance >= 11.7 &&  $water_balance <= 12.6){
                                $water_balance2 ='Scale Forming';
                                }
                                if ($water_balance > 12.6){
                                    $water_balance2 ='Highly Scale Forming';
                                    }




        $waterTest = new WaterBalanceTest([
            'alkalinity' => $request->input('alkalinity'),
            'calcium_hardness' => $request->input('calcium_hardness'),
            'ph' => $request->input('ph'),
            'pool_id' => $request->input('pool_id'),
            'water_balance' => $water_balance2,
            'logged_by' => auth()->id() 
        ]);

        $waterTest->save();
        if ($water_balance < 100){
        return redirect()->back()->with('success', 'Water Balance Test Recorded');
        }
        if ($water_balance >= 100){
            return redirect()->back()->with('error', 'Water Balance Test Recorded as being Corrosive, please see supervisor for action');
            }
      //  return response()->json([
      //      'status' => 'success',
       //     'message' => 'Water balance test submitted successfully.',
      //      'data' => $waterTest
       // ]);
    }
}