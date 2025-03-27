@extends('layouts.vertical', ['title' => 'Add Equipment and PPE Checks'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Add Equipment and PPE Checks'])
    <div class="container mt-5">
    @if(session('success'))  
        <div class="alert alert-success">{{ session('success') }} </div>
    @endif
    @if(session('error'))  
    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <iconify-icon icon="solar:danger-triangle-bold-duotone" class="fs-20 me-1"></iconify-icon>
                        <div class="lh-1"><strong>Error - </strong> {{ session('error') }}</div>
                    </div>
    @endif
    <form action="{{ route('equipment-check') }}" method="POST">
        @csrf        
        <div class="mb-3">
            <label for="equipment_location" class="form-label">Location</label>
            <select class="form-select" id="equipment_location" name="equipment_location" required>
                <option value="">Select Location</option>
                @foreach($equipmentLocations as $location)
                    <option value="{{ $location }}">{{ $location }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="equipment_type" class="form-label">Equipment Type</label>
            <select class="form-select" id="equipment_type" name="equipment_type" required>
                <option value="">Select Equipment</option>
                @foreach($equipmentTypes as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="conditon" class="form-label">conditon</label>
            <select class="form-select" id="conditon" name="conditon" required>
                <option value="">status</option>
                <option value="">Checked - Okay</option>
                <option value="">Checked - Not Okay</option>
                <option value="">Not able to complete Check - Reschedule</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="comments" class="form-label">Comments</label>
            <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

