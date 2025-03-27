@extends('layouts.vertical', ['title' => 'Thermal Suite Checks'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Thermal Suite Checks'])
    
   
@if(session('success'))
    <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
@endif

<div class="card">



        <div class="col-md-6">
            <div class="card border-secondary border">
                <div class="card-body">
                


                <h1>Thermal Suites</h1>
        <a href="{{ route('thermal-suites.create') }}" class="btn btn-primary mb-3">Add New Suite</a>

        @foreach ($suites as $suite)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $suite->name }} ({{ $suite->location }})</h5>
                    <p>Check every: {{ $suite->check_frequency_minutes }} minutes</p>
                    <p>Last checked: {{ $suite->thermalChecks->last()?->checked_at?->diffForHumans() ?? 'Never' }}</p>
                    @if($suite->thermalChecks->last())
                        <p>Last status: {{ ThermalCheck::statusOptions()[$suite->thermalChecks->last()->status] }}</p>
                        <p>Checked by: {{ $suite->thermalChecks->last()->user->name ?? 'Unknown' }}</p>
                    @endif
                    
                    <form action="{{ route('thermal-suites.check', $suite) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <select name="status" class="form-control" required>
                                <option value="">Select Status</option>
                                @foreach(ThermalCheck::statusOptions() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="notes" class="form-control" placeholder="Notes (optional)"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Record Check</button>
                    </form>
                </div>
            </div>
        @endforeach


            </div><!-- end card-body-->
                </div> <!-- end card-bordery-->
            </div> <!-- end column-->
            </div><!-- end card-body-->
            
    </div>
    <!-- end row -->
   
@endsection