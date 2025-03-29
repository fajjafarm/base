@extends('layouts.vertical', ['title' => 'Log a Backwash for ' . $plantroom->plantroom_name])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Plantrooms', 'title' => 'Log a Backwash'])

    <div class="container mt-4 mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">Log a Backwash for {{ $plantroom->plantroom_name }}</h2>

                <form action="{{ route('backwashes.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plantroom_id" value="{{ $plantroom->plantroom_id }}">

                    <!-- Reason -->
                    <div class="mb-4">
                        <label for="reason" class="form-label fw-semibold">Reason for Backwash</label>
                        <select class="form-select @error('reason') is-invalid @enderror" 
                                id="reason" name="reason" required>
                            <option value="">Select Reason</option>
                            @foreach($reasons as $reason)
                                <option value="{{ $reason }}" {{ old('reason') == $reason ? 'selected' : '' }}>
                                    {{ $reason }}
                                </option>
                            @endforeach
                        </select>
                        @error('reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Filters -->
                    @if($plantroom->components->where('component_type', 'filter')->isNotEmpty())
                        <div class="mb-4">
                            <h5 class="fw-semibold text-muted">Filters</h5>
                            @foreach($plantroom->components->where('component_type', 'filter') as $filter)
                                <div class="row g-3 mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Filter {{ $filter->component_number }} ({{ $filter->description ?? 'No description' }})</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="number" step="0.01" 
                                               class="form-control @error("filters.{$filter->id}.pressure_before") is-invalid @enderror" 
                                               name="filters[{{ $filter->id }}][pressure_before]" 
                                               value="{{ old("filters.{$filter->id}.pressure_before") }}" 
                                               placeholder="Pressure Before">
                                        <input type="hidden" name="filters[{{ $filter->id }}][component_id]" value="{{ $filter->id }}">
                                        @error("filters.{$filter->id}.pressure_before")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="number" step="0.01" 
                                               class="form-control @error("filters.{$filter->id}.pressure_after") is-invalid @enderror" 
                                               name="filters[{{ $filter->id }}][pressure_after]" 
                                               value="{{ old("filters.{$filter->id}.pressure_after") }}" 
                                               placeholder="Pressure After">
                                        @error("filters.{$filter->id}.pressure_after")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Strainers -->
                    @if($plantroom->components->where('component_type', 'strainer')->isNotEmpty())
                        <div class="mb-4">
                            <h5 class="fw-semibold text-muted">Strainers</h5>
                            @foreach($plantroom->components->where('component_type', 'strainer') as $strainer)
                                <div class="row g-3 mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Strainer {{ $strainer->component_number }} ({{ $strainer->description ?? 'No description' }})</label>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-select @error("strainers.{$strainer->id}.action") is-invalid @enderror" 
                                                name="strainers[{{ $strainer->id }}][action]">
                                            <option value="nothing" {{ old("strainers.{$strainer->id}.action") == 'nothing' ? 'selected' : '' }}>Nothing</option>
                                            @foreach($strainerActions as $action)
                                                <option value="{{ $action }}" {{ old("strainers.{$strainer->id}.action") == $action ? 'selected' : '' }}>
                                                    {{ ucfirst($action) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="strainers[{{ $strainer->id }}][component_id]" value="{{ $strainer->id }}">
                                        @error("strainers.{$strainer->id}.action")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Injectors -->
                    @foreach(['cl_injector' => 'Chlorine Injectors', 'ph_injector' => 'pH Injectors', 'pac_injector' => 'PAC Injectors'] as $type => $label)
                        @if($plantroom->components->where('component_type', $type)->isNotEmpty())
                            <div class="mb-4">
                                <h5 class="fw-semibold text-muted">{{ $label }}</h5>
                                @foreach($plantroom->components->where('component_type', $type) as $injector)
                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label class="form-label">Injector {{ $injector->component_number }} ({{ $injector->description ?? 'No description' }})</label>
                                        </div>
                                        <div class="col-12">
                                            <select class="form-select @error("injectors.{$injector->id}.action") is-invalid @enderror" 
                                                    name="injectors[{{ $injector->id }}][action]">
                                                <option value="nothing" {{ old("injectors.{$injector->id}.action") == 'nothing' ? 'selected' : '' }}>Nothing</option>
                                                @foreach($injectorActions as $action)
                                                    <option value="{{ $action }}" {{ old("injectors.{$injector->id}.action") == $action ? 'selected' : '' }}>
                                                        {{ ucfirst($action) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="injectors[{{ $injector->id }}][component_id]" value="{{ $injector->id }}">
                                            @error("injectors.{$injector->id}.action")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach

                    <!-- Notes -->
                    <div class="mb-4">
                        <label for="notes" class="form-label fw-semibold">Notes</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  name="notes" rows="4">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Submit Backwash Log</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection