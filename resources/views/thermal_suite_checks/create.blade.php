@extends('layouts.vertical', ['title' => 'Thermal Suite Checks'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Thermal Suite Checks'])

    <body>

@if(session('success'))  
        <div class="alert alert-success">{{ session('success') }} </div>
    @endif
    @if(session('error'))  
    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <iconify-icon icon="solar:danger-triangle-bold-duotone" class="fs-20 me-1"></iconify-icon>
                        <div class="lh-1"><strong>Error - </strong> {{ session('error') }}</div>
                    </div>
    @endif

<div class="alert alert-info">
{{ $thermalSuite->thermal_name }} Last checked: {{ $timeSinceLastCheck }}
</div>
<h3>The {{ $thermalSuite->thermal_name }} is currently:</h3><br/><br/>
<form method="POST" action="{{ route('thermal_suite_checks.store', $thermalSuite->id) }}">
    @csrf

    <div class="mb-3">
        <button type="submit" name="status" value="occupied_okay" 
                class="btn btn-success mr-2">Occupied - Okay</button>
        <button type="submit" name="status" value="occupied_issue" 
                class="btn btn-warning mr-2">Occupied - Issue</button>
        <button type="submit" name="status" value="empty_okay" 
                class="btn btn-primary mr-2">Empty - Okay</button>
        <button type="submit" name="status" value="empty_issue" 
                class="btn btn-danger">Empty - Issue</button>
    </div>

    <div class="form-group">
        <label for="extra_info">Extra Information</label>
        <textarea name="extra_info" 
                  class="form-control @error('extra_info') is-invalid @enderror"
                  rows="3">{{ old('extra_info') }}</textarea>
        @error('extra_info')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</form>
 <!-- Previous Checks Section 2-->
 <div class="mt-5">
            <h3>Previous Checks</h3>
            @if($thermalSuite->checks()->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Gap</th>
                                <th>Notes</th>
                                <th>Check Time</th>
                                <th>User ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $previousCheck = null;
                            @endphp
                            @foreach($checks as $check)
                                <tr>
                                <td>
                                        @switch($check->status)
                                            @case('occupied_okay')
                                                <span class="badge bg-success">Occupied - Okay</span>
                                                @break
                                            @case('occupied_issue')
                                                <span class="badge bg-warning">Occupied - Issue</span>
                                                @break
                                            @case('empty_okay')
                                                <span class="badge bg-primary">Empty - Okay</span>
                                                @break
                                            @case('empty_issue')
                                                <span class="badge bg-danger">Empty - Issue</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($previousCheck)
                                     
                                        {{ round((Carbon\Carbon::parse($check->checked_at)->diffInMinutes($previousCheck->checked_at)),0) }} mins
                                        @else
                                       {{ $timeSinceLastCheck}}                                         @endif
                                    </td>
                                    <td>{{ $check->extra_info ?? '-' }}</td>
                                    <td>{{ Carbon\Carbon::parse($check->checked_at)->format('H:i:s d-m-Y') }}</td>
                                    <td>{{ $check->user_id }}</td>

                                    
                                </tr>
                                @php
                                    $previousCheck = $check;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $checks->links() }}
                </div>
            @else
                <p>No previous checks recorded.</p>
            @endif
        </div>
    </div>
    </div>
</body>
@endsection
