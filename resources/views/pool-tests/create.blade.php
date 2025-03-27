@extends('layouts.vertical', ['title' => 'Submit a Pool Test'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Submit a Pool Test'])
    
    @if($errors->any())
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('warning'))
<div class="alert alert-danger d-flex align-items-center" role="alert">{{ session('warning') }}</div>
@endif

<div class="card">

               <div class="col-lg-6">
            <div class="card">
               

                <div class="card-body">
                <h4 class="header-title">Pool Test for {{$pools->pool_name}} </h4></br>
                <form method="POST" action="{{ route('pool-tests.store', $pool_id) }}" class="mb-8">
                @csrf
                        <div class="mb-3">
                        <input type="hidden" name="pool_id" value="{{$pool_id}}">
                        <label>DPD1</label>
                    <input type="number" name="dpd1" step="0.01" class="form-control" placeholder="Enter DPD1 Reading" required>

                        </div>
                        <div class="mb-3">
                        <label>DPD3</label>
                    <input type="number" name="dpd3" step="0.01" class="form-control" placeholder="Wait 2 mins then enter DPD3 reading" required>

                        </div>

                        <div class=" mb-3">
                        <label>pH</label>
                    <input type="number" name="ph" step="0.01" class="form-control" required>

                        </div>
                        
                        <div class=" mb-3">
                    <label>Sample Location</label>
                    <select name="sample_location" class="form-select">
                    <option value="Control Panel">Control Panel</option>
                    <option value="Pool">Pool</option>
                    
                        
                        
                    </select>
                </div>
                <div class=" mb-3">
                    <label>Action Taken</label>
                    <select name="action_taken" class="form-select">
                        <option value="None">None</option>
                        <option value="Changed Chlorine">Changed Chlorine</option>
                        <option value="Changed Acid">Changed Acid</option>
                        <option value="Changed PAC">Changed PAC</option>
                        <option value="Recalibrated Controller">Recalibrated Controller</option>
                        <option value="Backwashed">Backwashed</option>
                        <option value="Supervisor Notified">Supervisor Notified</option>
                        <option value="Code Brown">Code Brown</option>
                        <option value="Code Yellow">Code Yellow</option>
                        <option value="Shocked">Shocked</option>
                    </select>
                </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end col -->




         <!-- Results Table -->
         <div class="table-responsive-sm">
         <table class="table table-striped mb-0 table-sm">
    <thead>
                <tr class="table-dark">
                <th >Gap</th>
                    <th >DPD1</th>
                    <th >DPD3</th>
                    <th >CCL</th>
                    <th >pH</th>
                    <th >Location</th>
                    <th >Status</th>
                    <th >Action</th>
                    <th >Date/Time</th>
                </tr>
            </thead>
            <tbody>
            @if(!empty($tests))
                @foreach($tests as $index => $test)
                    <tr>
                    <td class=>
                            @if($index < $tests->count() - 1)
                                <?php
                                    $current = $test->created_at;
                                    $next = $tests[$index + 1]->created_at;
                                    $diff = $current->diff($next);
                                    echo sprintf('%dh %dm', $diff->h + ($diff->d * 24), $diff->i);
                                ?>
                            @endif
                        </td>
                        <td >{{ $test->dpd1 }}</td>
                        <td >{{ $test->dpd3 }}</td>
                        <td >{{ $test->ccl }}</td>
                        <td >{{ $test->ph }}</td>
                        <td >{{ $test->sample_location }}</td>
                        <td >{{ $test->status }}</td>
                        <td >{{ $test->action_taken }}</td>

                        <td >{{ $test->created_at }}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>

        <div class="mt-4">
            {{ $tests->links() }}
        </div>
        
           <!-- end card-body-->
            
   
   
@endsection