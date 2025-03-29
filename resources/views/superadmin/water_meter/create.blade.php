@extends('layouts.vertical', ['title' => 'Add Water Meter Location'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Super Admin', 'title' => 'Add Water Meter Location'])

    <div class="container mt-4 mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">Add New Water Meter Location</h2>
                <form action="{{ route('superadmin.water_meter.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="plantroom_id" class="form-label">Associated Plantroom (Optional)</label>
                        <select class="form-select @error('plantroom_id') is-invalid @enderror" name="plantroom_id">
                            <option value="">None (Standalone)</option>
                            @foreach($plantrooms as $plantroom)
                                <option value="{{ $plantroom->plantroom_id }}" {{ old('plantroom_id') == $plantroom->plantroom_id ? 'selected' : '' }}>
                                    {{ $plantroom->plantroom_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('plantroom_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" 
                               name="location" value="{{ old('location') }}" required 
                               placeholder="e.g., Outside Plantroom A, Basement">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  name="description" rows="4" placeholder="Additional details about this water meter">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add Water Meter Location</button>
                </form>
            </div>
        </div>
    </div>
@endsection