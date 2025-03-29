@extends('layouts.vertical', ['title' => 'Add Plantroom'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Super Admin', 'title' => 'Add Plantroom'])

    <div class="container mt-4 mb-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">Add New Plantroom</h2>
                <form action="{{ route('superadmin.plantroom.store') }}" method="POST">
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
                        <label for="plantroom_name" class="form-label">Plantroom Name</label>
                        <input type="text" class="form-control @error('plantroom_name') is-invalid @enderror" 
                               name="plantroom_name" value="{{ old('plantroom_name') }}" required>
                        @error('plantroom_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Next: Add Components</button>
                </form>
            </div>
        </div>
    </div>
@endsection