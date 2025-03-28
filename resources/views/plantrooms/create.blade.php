@extends('layouts.vertical', ['title' => 'Add Plantroom'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Plantrooms', 'title' => 'Add Plantroom'])

    <div class="container mt-4 mb-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">Add Plantroom for {{ $companyName->company_name }}</h2>

                <form action="{{ route('plantroom.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="client_id" value="{{ $clientID }}">

                    <div class="mb-4">
                        <label for="plantroom_name" class="form-label">Plantroom Name</label>
                        <input type="text" class="form-control @error('plantroom_name') is-invalid @enderror" 
                               name="plantroom_name" value="{{ old('plantroom_name') }}" required>
                        @error('plantroom_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @foreach(['filters' => 'Filters', 'strainers' => 'Strainers', 'cl_injectors' => 'Chlorine Injectors', 
                             'ph_injectors' => 'pH Injectors', 'pac_injectors' => 'PAC Injectors'] as $type => $label)
                        <div class="mb-4">
                            <h5>{{ $label }}</h5>
                            @for($i = 0; $i < ($type === 'filters' || $type === 'strainers' ? 10 : 5); $i++)
                                <div class="row g-3 mb-2">
                                    <div class="col-12 col-md-6">
                                        <input type="text" 
                                               class="form-control @error("{$type}.{$i}") is-invalid @enderror" 
                                               name="{{ $type }}[{{ $i }}]" 
                                               value="{{ old("{$type}.{$i}") }}" 
                                               placeholder="{{ $label }} {{ $i + 1 }} Description">
                                        @error("{$type}.{$i}")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endfor
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary btn-lg">Add Plantroom</button>
                </form>
            </div>
        </div>
    </div>
@endsection