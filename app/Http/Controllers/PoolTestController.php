<?php 
namespace App\Http\Controllers;

use App\Models\PoolTest;
use App\Models\PoolList;
use Illuminate\Http\Request;

class PoolTestController extends Controller
{
    public function index($pool_id)
    {
        $tests = PoolTest::with(['pool', 'user'])
        ->where('pool_id', $pool_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $pools = PoolList::findOrFail($pool_id);
        
        return view('pool-tests.create', compact('tests', 'pools', 'pool_id'));
    }

    public function store(Request $request, $pool_id)
{
    $validated = $request->validate([
        'pool_id' => 'required|ulid|exists:pool_list,pool_id',
        'dpd1' => 'required|numeric|min:0',
        'dpd3' => 'required|numeric|min:0',
        'ph' => 'required|numeric|min:0|max:14',
        'sample_location' => 'required|string',
        'action_taken' => 'required|string'
    ]);

   // dd($validated); // Dump validated data to confirm it passes

    $validated['ccl'] = $request->dpd3 - $request->dpd1;
    $validated['user_id'] = auth()->id() ?? throw new \Exception('User not authenticated');

          // Calculate status based on readings
          $status = 'Normal';
          $dpd1 = $validated['dpd1'];
          $ccl = $validated['ccl'];
          $ph = $validated['ph'];
  
          $needsSupervisor = false;
          if ($dpd1 < 1.5 || $dpd1 > 3 || 
              $ccl > 1 || $ccl > ($dpd1 / 2) || 
              $ph < 7.2 || $ph > 7.7) {
              $status = 'Inform Supervisor';
              $needsSupervisor = true;
          }
  
          $validated['status'] = $status;
  
          PoolTest::create($validated);
  
          // Return different messages based on whether supervisor attention is needed
          if ($needsSupervisor) {
              return redirect()->route('pool-tests.create', $pool_id)
                  ->with('warning', 'Pool test recorded successfully but readings are out of range - please inform a supervisor');
          }

    return redirect()->route('pool-tests.create', $pool_id)
        ->with('success', 'Pool test recorded successfully');
}
}