@extends('layouts.vertical', ['title' => 'Specify Components for ' . $plantroom->plantroom_name])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Super Admin', 'title' => 'Specify Plantroom Components'])

    <div class="container mt-4 mb-5">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">Specify Components for {{ $plantroom->plantroom_name }}</h2>
                <form action="{{ route('superadmin.plantroom.components.count', $plantroom->plantroom_id) }}" method="POST">
                    @csrf
                    <p class="text-muted mb-4">Enter the number of each component type in this plantroom.</p>

                    <div class="row g-3">
                        @foreach([
                            'filter' => 'Filters',
                            'strainer' => 'Strainers',
                            'cl_injector' => 'Chlorine Injectors',
                            'ph_injector' => 'pH Injectors',
                            'pac_injector' => 'PAC Injectors',
                            'pump' => 'Pumps'
                        ] as $type => $label)
                            <div class="col-md-4">
                                <label for="counts_{{ $type }}" class="form-label">{{ $label }}</label>
                                <input type="number" 
                                       class="form-control @error("counts.{$type}") is-invalid @enderror" 
                                       name="counts[{{ $type }}]" 
                                       id="counts_{{ $type }}" 
                                       min="0" 
                                       value="{{ old("counts.{$type}", 0) }}" 
                                       required>
                                @error("counts.{$type}")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Proceed to Component Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection