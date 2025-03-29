@extends('layouts.vertical', ['title' => 'Add Pool'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Super Admin', 'title' => 'Add Pool'])

    <div class="container mt-4 mb-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">Add New Pool</h2>
                <form action="{{ route('superadmin.pool.store') }}" method="POST">
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
                        <label for="pool_name" class="form-label">Pool Name</label>
                        <input type="text" class="form-control @error('pool_name') is-invalid @enderror" 
                               name="pool_name" value="{{ old('pool_name') }}" required>
                        @error('pool_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add Pool</button>
                </form>
            </div>
        </div>
    </div>
@endsection