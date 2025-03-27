@extends('layouts.vertical', ['title' => 'Log a Backwash'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Log a Backwash'])
    <div class="container mt-5">
    @if(session('success'))  
        <div class="alert alert-success">{{ session('success') }}   </div>
    @endif
    @if(session('notgood'))  
    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <iconify-icon icon="solar:danger-triangle-bold-duotone" class="fs-20 me-1"></iconify-icon>
                        <div class="lh-1"><strong>Error - </strong> {{ session('notgood') }}</div>
                    </div>
    @endif
        <h2>Log a Backwash for {{$poolName}}</h2>
        <form action="{{ route('backwashes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
        <input type="hidden" id="pool_id" name="pool_id" value="{{$poolID}}" />

            <select class="form-select" id="reason_for_backwash" name="reason_for_backwash" required>
                <option value="">Select Reason for Backwash</option>
                @foreach($backwashTypes as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>
        
        @for($i = 1; $i <= 3; $i++)
        <div class="mb-3">
                <label for="filter{{ $i }}_before_pressure">Filter {{ $i }} Before Pressure:</label>
                <input type="number" step="0.01" name="filter{{ $i }}_before_pressure">
                <label for="filter{{ $i }}_after_pressure">Filter {{ $i }} After Pressure:</label>
                <input type="number" step="0.01" name="filter{{ $i }}_after_pressure">
                <label for="filter{{ $i }}_backwashed">Filter Backwash?</label>
            <input type="checkbox" name="filter{{ $i }}_backwashed" value="1">
            <label for="basket{{ $i }}_cleaned">Basket Cleaned?</label>
            <input type="checkbox" name="basket{{ $i }}_cleaned" value="1">
            </div>
        @endfor

      
        <label for="pump1_status" class="form-label">Pump 1 Status</label>
            <select class="form-select" id="pump1_status" name="pump1_status" required>
                <option value="">Select Pump Status</option>
                @foreach($pumpStatus as $pump)
                    <option value="{{ $pump }}">{{ $pump }}</option>
                @endforeach
            </select>
            <label for="pump2_status" class="form-label">Pump 1 Status</label>
            <select class="form-select" id="pump2_status" name="pump2_status" required>
                <option value="">Select Pump Status</option>
                @foreach($pumpStatus as $pump)
                    <option value="{{ $pump }}">{{ $pump }}</option>
                @endforeach
            </select>
            <label for="pump3_status" class="form-label">Pump 1 Status</label>
            <select class="form-select" id="pump3_status" name="pump3_status" required>
                <option value="">Select Pump Status</option>
                @foreach($pumpStatus as $pump)
                    <option value="{{ $pump }}">{{ $pump }}</option>
                @endforeach
            </select>
          
        <div class="mb-3">
            <label for="issues">Issues:</label>
            <textarea name="issues"></textarea>
        </div>
        <button type="submit">Submit</button>
    </form>
    </div>
@endsection