@extends('layouts.vertical', ['title' => 'Add a new Thermal Suite'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Add a new Thermal Suite'])
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
</div>
    <div class="container mt-5">
        <h1>Add New Thermal Suite</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('thermal-suites.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="client_id">Client</label>
                <select name="client_id" class="form-control @error('client_id') is-invalid @enderror">
                    <!-- Populate with your clients -->
                    <option value="1">1</option>
                </select>
                @error('client_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="thermal_name">Thermal Name</label>
                <input type="text" name="thermal_name" class="form-control @error('thermal_name') is-invalid @enderror" 
                       value="{{ old('thermal_name') }}">
                @error('thermal_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="thermal_type">Thermal Type</label>
                          <select class="form-select" name="thermal_type" aria-label="Example select with button addon">
                <option value="Mixed:Sauna/Steamroom/Loungers" >Mixed:Sauna/Steamroom/Loungers</option>
                <option value="Mixed:Sauna/Steamroom" >Mixed:Sauna/SteamRoom</option>
                <option value="Sauna" >Sauna</option>
                <option value="SteamRoom" >SteamRoom</option>
                <option value="Loungers" >Loungers</option>
            </select>
            </div>

            <div class="form-group">
                <label for="sauna_temp">Sauna Temperature (°C)</label>
                <input type="number" step="0.01" name="sauna_temp" 
                       class="form-control @error('sauna_temp') is-invalid @enderror" 
                       value="{{ old('sauna_temp') }}">
                @error('sauna_temp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="steamroom_temp">Steam Room Temperature (°C)</label>
                <input type="number" step="0.01" name="steamroom_temp" 
                       class="form-control @error('steamroom_temp') is-invalid @enderror" 
                       value="{{ old('steamroom_temp') }}">
                @error('steamroom_temp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="lounger_temp">Lounger Temperature (°C)</label>
                <input type="number" step="0.01" name="lounger_temp" 
                       class="form-control @error('lounger_temp') is-invalid @enderror" 
                       value="{{ old('lounger_temp') }}">
                @error('lounger_temp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="check_interval">Check Interval (minutes)</label>
                <input type="number" name="check_interval" 
                       class="form-control @error('check_interval') is-invalid @enderror" 
                       value="{{ old('check_interval') }}">
                @error('check_interval')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea name="notes" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Add Thermal Suite</button>
        </form>
    </div>
@endsection