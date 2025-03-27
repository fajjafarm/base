@extends('layouts.vertical', ['title' => 'Bike Lock Log'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Bike Lock Log'])
    
   
@if(session('success'))
    <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
@endif

<div class="card">



        <div class="col-md-6">
            <div class="card border-secondary border">
            <div class="container">
        <h1>Log Training Session</h1>
        
        <form method="POST" action="{{ route('training.store') }}">
            @csrf
            
            <div class="form-group">
                <label>Type</label>
                <select name="type" class="form-control">
                    <option value="Pool Rescue">Pool Rescue</option>
                    <option value="First Aid">First Aid</option>
                    <option value="Departmental">Departmental</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label>Custom Type (if Other)</label>
                <input type="text" name="custom_type" class="form-control">
            </div>

            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Duration (hours)</label>
                <input type="number" name="duration" step="0.25" class="form-control" required>
            </div>
            <div class="form-group">
    <label>Location</label>
    <input type="text" name="location" class="form-control" required>
</div>

<div class="form-group">
    <label>Pool Depth (meters)</label>
    <input type="number" name="pool_depth" step="0.1" class="form-control">
</div>

<div class="form-group">
    <label>Equipment Used</label>
    @foreach(['Rope', 'Pole', 'Ruth Lee Manikin', 'Orange Manikin', 'First Aid Kit', 'Other'] as $equipment)
        <div class="form-check">
            <input type="checkbox" name="equipment_used[]" value="{{ $equipment }}"
                class="form-check-input">
            <label>{{ $equipment }}</label>
        </div>
    @endforeach
    <input type="text" name="custom_equipment" class="form-control" 
        placeholder="Specify if Other is selected">
</div>

<div class="form-group">
    <label>Trainer</label>
    <input type="text" name="trainer" class="form-control" required>
</div>
<div class="form-group">
    <label>Employees</label>
    @foreach($users as $user) 
        <div class="form-check">
            <input type="checkbox" name="users[]" value="{{ $user->id }}" >
                class="form-check-input">
            <label>{{ $user->full_name }}</label>
            <textarea name="comments[{{ $user->id }}]" 
                class="form-control" 
                placeholder="Comments for {{ $user->full_name }}"></textarea>
        </div>
    @endforeach
</div>

            <button type="submit" class="btn btn-primary">Save Training Session</button>
        </form>
    </div>
   
@endsection