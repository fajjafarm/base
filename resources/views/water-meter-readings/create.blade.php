@extends('layouts.vertical', ['title' => 'Add a Water Meter Reading'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Add a Water Meter Reading'])
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
    <h1>Add Water Meter Reading ({{$plantroomName}})</h1>
    <form action="{{ route('water-meter-readings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
        <input type="number" name="meter_reading" placeholder="Meter Reading" required></div>
        <input type="hidden" id="plantroom_id" name="plantroom_id" value="{{$plantroomID}}" />
        <div class="mb-3">
        <button type="submit">Submit Reading</button></div>
    </form>
    </div>
@endsection