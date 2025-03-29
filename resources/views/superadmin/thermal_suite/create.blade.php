@extends('layouts.vertical', ['title' => 'Add Thermal Suite'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Super Admin', 'title' => 'Add Thermal Suite'])

    <div class="container mt-4 mb-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">Add New Thermal Suite</h2>
                <form action="{{ route('superadmin.thermal_suite.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="client_id" class="form-label">Client</label>
                        <select class="form-select @error('client_id') is-invalid @enderror" name="client_id" required>
                            <option value="">Select Client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->client_id }}">{{ $client->company_name }}</option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="thermal_name" class="form-label">Thermal Suite Name</label>
                        <input type="text" class="form-control @error('thermal_name') is-invalid @enderror" 
                               name="thermal_name" value="{{ old('thermal_name') }}" required>
                        @error('thermal_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="thermal_type" class="form-label">Type</label>
                        <input type="text" class="form-control @error('thermal_type') is-invalid @enderror" 
                               name="thermal_type" value="{{ old('thermal_type') }}" required>
                        @error('thermal_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sauna_temp" class="form-label">Sauna Temp</label>
                        <input type="number" step="0.01" class="form-control @error('sauna_temp') is-invalid @enderror" 
                               name="sauna_temp" value="{{ old('sauna_temp') }}" required>
                        @error('sauna_temp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="steamroom_temp" class="form-label">Steamroom Temp</label>
                        <input type="number" step="0.01" class="form-control @error('steamroom_temp') is-invalid @enderror" 
                               name="steamroom_temp" value="{{ old('steamroom_temp') }}" required>
                        @error('steamroom_temp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lounger_temp" class="form-label">Lounger Temp</label>
                        <input type="number" step="0.01" class="form-control @error('lounger_temp') is-invalid @enderror" 
                               name="lounger_temp" value="{{ old('lounger_temp') }}" required>
                        @error('lounger_temp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="check_interval" class="form-label">Check Interval (minutes)</label>
                        <input type="number" class="form-control @error('check_interval') is-invalid @enderror" 
                               name="check_interval" value="{{ old('check_interval') }}" required>
                        @error('check_interval')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  name="notes" rows="4">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add Thermal Suite</button>
                </form>
            </div>
        </div>
    </div>
@endsection