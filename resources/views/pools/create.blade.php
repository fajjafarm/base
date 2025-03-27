@extends('layouts.vertical', ['title' => 'Adda a New Pool'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Add a New Pool'])
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
        <h2>Add a New Pool for {{$companyName}} </h2>
        <form action="{{ route('pools.store') }}" method="POST">
        @csrf
        <div class="mb-3">
        <input type="hidden" id="client_id" name="client_id" value="{{$clientID}}" />
        </div>
        <div class="mb-3">
            <label for="pool_name">Pool Name:</label>
            <input type="text" name="pool_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="pool_type">Pool Type:</label>
            <input type="text" name="pool_type" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="length">Length:</label>
            <input type="number" step="0.01" name="length" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="width">Width:</label>
            <input type="number" step="0.01" name="width" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="depth">Depth:</label>
            <input type="number" step="0.01" name="depth" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="volume">Volume:</label>
            <input type="number" step="0.01" name="volume" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="ideal_dpd1">Ideal DPD1:</label>
            <input type="number" step="0.01" name="ideal_dpd1" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="ideal_ph">Ideal PH:</label>
            <input type="number" step="0.01" name="ideal_ph" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="ideal_alk">Ideal Alkalinity:</label>
            <input type="number" step="0.01" name="ideal_alk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="ideal_calc">Ideal Calcium:</label>
            <input type="number" step="0.01" name="ideal_calc" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="ideal_water_temp">Ideal Water Temp:</label>
            <input type="number" step="0.01" name="ideal_water_temp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="ideal_air_temp">Ideal Air Temp:</label>
            <input type="number" step="0.01" name="ideal_air_temp" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection