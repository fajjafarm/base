@extends('layouts.vertical', ['title' => 'Add Components for ' . $plantroom->plantroom_name])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Super Admin', 'title' => 'Add Plantroom Components'])

    <div class="container mt-4 mb-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">Add Components for {{ $plantroom->plantroom_name }}</h2>
                <form action="{{ route('superadmin.plantroom.components.store', $plantroom->plantroom_id) }}" method="POST">
                    @csrf
                    <div id="components">
                        <div class="component mb-3 row g-3">
                            <div class="col-md-3">
                                <select class="form-select @error('components.0.type') is-invalid @enderror" 
                                        name="components[0][type]" required>
                                    <option value="">Select Type</option>
                                    <option value="filter">Filter</option>
                                    <option value="strainer">Strainer</option>
                                    <option value="cl_injector">Chlorine Injector</option>
                                    <option value="ph_injector">pH Injector</option>
                                    <option value="pac_injector">PAC Injector</option>
                                    <option value="pump">Pump</option>
                                </select>
                                @error('components.0.type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control @error('components.0.number') is-invalid @enderror" 
                                       name="components[0][number]" min="1" placeholder="Number" required>
                                @error('components.0.number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control @error('components.0.description') is-invalid @enderror" 
                                       name="components[0][description]" placeholder="Description">
                                @error('components.0.description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger remove-component">Remove</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-component" class="btn btn-secondary mb-3">Add Component</button>
                    <button type="submit" class="btn btn-primary">Save Components</button>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            let componentCount = 1;
            document.getElementById('add-component').addEventListener('click', function () {
                const container = document.getElementById('components');
                const newComponent = `
                    <div class="component mb-3 row g-3">
                        <div class="col-md-3">
                            <select class="form-select" name="components[${componentCount}][type]" required>
                                <option value="">Select Type</option>
                                <option value="filter">Filter</option>
                                <option value="strainer">Strainer</option>
                                <option value="cl_injector">Chlorine Injector</option>
                                <option value="ph_injector">pH Injector</option>
                                <option value="pac_injector">PAC Injector</option>
                                <option value="pump">Pump</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="components[${componentCount}][number]" min="1" placeholder="Number" required>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="components[${componentCount}][description]" placeholder="Description">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-component">Remove</button>
                        </div>
                    </div>`;
                container.insertAdjacentHTML('beforeend', newComponent);
                componentCount++;
            });

            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-component')) {
                    e.target.closest('.component').remove();
                }
            });
        </script>
    @endpush
@endsection