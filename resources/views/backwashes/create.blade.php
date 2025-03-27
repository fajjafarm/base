@extends('layouts.vertical', ['title' => 'Log a Backwash'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Log a Backwash'])

    <div class="container mt-4 mb-5">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('notgood'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                <iconify-icon icon="solar:danger-triangle-bold-duotone" class="fs-20 me-2"></iconify-icon>
                <div><strong>Error - </strong> {{ session('notgood') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Form Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">Log a Backwash for {{ $poolName }}</h2>

                <form action="{{ route('backwashes.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pool_id" value="{{ $poolID }}">

                    <!-- Reason for Backwash -->
                    <div class="mb-4">
                        <label for="reason_for_backwash" class="form-label fw-semibold">Reason for Backwash</label>
                        <select class="form-select @error('reason_for_backwash') is-invalid @enderror" 
                                id="reason_for_backwash" name="reason_for_backwash" required>
                            <option value="">Select Reason for Backwash</option>
                            @foreach($backwashTypes as $type)
                                <option value="{{ $type }}" {{ old('reason_for_backwash') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('reason_for_backwash')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Filter Sections -->
                    @for($i = 1; $i <= 3; $i++)
                        <div class="row mb-4 g-3">
                            <h5 class="fw-semibold text-muted">Filter {{ $i }}</h5>
                            <div class="col-12 col-md-6">
                                <label for="filter{{ $i }}_before_pressure" class="form-label">Before Pressure</label>
                                <input type="number" step="0.01" 
                                       class="form-control @error("filter{$i}_before_pressure") is-invalid @enderror" 
                                       name="filter{{ $i }}_before_pressure" 
                                       value="{{ old("filter{$i}_before_pressure") }}">
                                @error("filter{$i}_before_pressure")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="filter{{ $i }}_after_pressure" class="form-label">After Pressure</label>
                                <input type="number" step="0.01" 
                                       class="form-control @error("filter{$i}_after_pressure") is-invalid @enderror" 
                                       name="filter{{ $i }}_after_pressure" 
                                       value="{{ old("filter{$i}_after_pressure") }}">
                                @error("filter{$i}_after_pressure")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="filter{{ $i }}_backwashed" value="1" 
                                           id="filter{{ $i }}_backwashed" 
                                           {{ old("filter{$i}_backwashed") ? 'checked' : '' }}>
                                    <label class="form-check-label" for="filter{{ $i }}_backwashed">
                                        Filter Backwashed?
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="basket{{ $i }}_cleaned" value="1" 
                                           id="basket{{ $i }}_cleaned" 
                                           {{ old("basket{$i}_cleaned") ? 'checked' : '' }}>
                                    <label class="form-check-label" for="basket{{ $i }}_cleaned">
                                        Basket Cleaned?
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endfor

                    <!-- Pump Status -->
                    <div class="row mb-4 g-3">
                        <h5 class="fw-semibold text-muted">Pump Status</h5>
                        @for($i = 1; $i <= 3; $i++)
                            <div class="col-12 col-md-4">
                                <label for="pump{{ $i }}_status" class="form-label">Pump {{ $i }} Status</label>
                                <select class="form-select @error("pump{$i}_status") is-invalid @enderror" 
                                        id="pump{{ $i }}_status" name="pump{{ $i }}_status" required>
                                    <option value="">Select Pump Status</option>
                                    @foreach($pumpStatus as $pump)
                                        <option value="{{ $pump }}" {{ old("pump{$i}_status") == $pump ? 'selected' : '' }}>
                                            {{ $pump }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("pump{$i}_status")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endfor
                    </div>

                    <!-- Issues -->
                    <div class="mb-4">
                        <label for="issues" class="form-label fw-semibold">Issues</label>
                        <textarea class="form-control @error('issues') is-invalid @enderror" 
                                  name="issues" rows="4">{{ old('issues') }}</textarea>
                        @error('issues')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Submit Backwash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional: Add some custom CSS for extra polish -->
    @push('css')
        <style>
            .form-label {
                font-size: 0.9rem;
                color: #495057;
            }
            .card {
                border-radius: 12px;
            }
            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
                transition: all 0.3s ease;
            }
            .btn-primary:hover {
                background-color: #0056b3;
                border-color: #0056b3;
            }
            @media (max-width: 576px) {
                .card-body {
                    padding: 1.5rem;
                }
                h2.card-title {
                    font-size: 1.5rem;
                }
            }
        </style>
    @endpush
@endsection