@extends('layouts.vertical', ['title' => $waterMeter ? 'Water Meter Readings for ' . $waterMeter->location : 'Water Meter Readings'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Water Meters', 'title' => $waterMeter ? 'Readings for ' . $waterMeter->location : 'Select a Water Meter'])

    <div class="container mt-4 mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Please correct the errors below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Add Reading Form -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header border-bottom border-light">
                <h4 class="header-title">Add New Reading</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('water-meter.readings.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        @if(!$waterMeter)
                            <div class="col-md-4">
                                <label for="water_meter_id" class="form-label fw-semibold">Water Meter</label>
                                <select class="form-select @error('water_meter_id') is-invalid @enderror" 
                                        name="water_meter_id" id="water_meter_id" required>
                                    <option value="">Select a Water Meter</option>
                                    @foreach($waterMeters as $meter)
                                        <option value="{{ $meter->water_meter_id }}" {{ old('water_meter_id') == $meter->water_meter_id ? 'selected' : '' }}>
                                            {{ $meter->location }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('water_meter_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @else
                            <input type="hidden" name="water_meter_id" value="{{ $waterMeter->water_meter_id }}">
                        @endif
                        <div class="col-md-4">
                            <label for="reading_value" class="form-label fw-semibold">Reading Value (m³)</label>
                            <input type="number" step="0.01" 
                                   class="form-control @error('reading_value') is-invalid @enderror" 
                                   name="reading_value" id="reading_value" 
                                   value="{{ old('reading_value') }}" 
                                   placeholder="e.g., 123.45" required>
                            @error('reading_value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="reading_date" class="form-label fw-semibold">Reading Date</label>
                            <input type="datetime-local" 
                                   class="form-control @error('reading_date') is-invalid @enderror" 
                                   name="reading_date" id="reading_date" 
                                   value="{{ old('reading_date', now()->format('Y-m-d\TH:i')) }}" required>
                            @error('reading_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="notes" class="form-label fw-semibold">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      name="notes" id="notes" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Add Reading</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Readings Table and Chart (only if a meter is selected) -->
        @if($waterMeter)
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex align-items-center justify-content-between border-bottom border-light">
                    <h4 class="header-title">Readings for {{ $waterMeter->location }}</h4>
                </div>
                <div class="card-body">
                    <!-- Bar Chart -->
                    <div class="mb-4">
                        <h5 class="fw-semibold text-muted">Daily Water Usage</h5>
                        <canvas id="waterUsageChart" height="100"></canvas>
                    </div>

                    <!-- Readings Table -->
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-sm mb-0">
                            <thead>
                                <tr class="table-dark">
                                    <th>Reading Date</th>
                                    <th>Reading Value (m³)</th>
                                    <th>Usage Since Last (m³)</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($readings as $index => $reading)
                                    <tr>
                                        <td>{{ $reading->reading_date->format('Y-m-d H:i:s') }}</td>
                                        <td>{{ number_format($reading->reading_value, 2) }}</td>
                                        <td>
                                            @if($index < $readings->count() - 1)
                                                @php
                                                    $previous = $readings[$index + 1];
                                                    $usage = $reading->reading_value - $previous->reading_value;
                                                @endphp
                                                {{ $usage >= 0 ? number_format($usage, 2) : 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($reading->notes)
                                                <button type="button" class="btn btn-info btn-sm" 
                                                        data-bs-toggle="popover" data-bs-placement="left" 
                                                        data-bs-trigger="focus" 
                                                        data-bs-content="{{ $reading->notes }}" 
                                                        data-bs-title="Notes">
                                                    Info
                                                </button>
                                            @else
                                                None
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No readings found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('js')
        @if($waterMeter)
            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Initialize popovers
                    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
                    popoverTriggerList.forEach(el => new bootstrap.Popover(el));

                    // Bar chart
                    const ctx = document.getElementById('waterUsageChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [@json($chartData)->pluck('date')],
                            datasets: [{
                                label: 'Daily Water Usage (m³)',
                                data: [@json($chartData)->pluck('usage')],
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Usage (m³)'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Date'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true
                                }
                            }
                        }
                    });
                });
            </script>
        @endif
    @endpush
@endsection