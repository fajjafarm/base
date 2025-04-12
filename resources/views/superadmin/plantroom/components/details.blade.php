@extends('layouts.vertical', ['title' => 'Enter Component Details for ' . $plantroom->plantroom_name])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Super Admin', 'title' => 'Enter Component Details'])

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
                <h2 class="card-title mb-4">Enter Details for {{ $plantroom->plantroom_name }} Components</h2>
                <form action="{{ route('superadmin.plantroom.components.store', $plantroom->plantroom_id) }}" method="POST">
                    @csrf
                    @php $index = 0; @endphp
                    @foreach($counts as $type => $count)
                        @if($count > 0)
                            <h5 class="mt-4 mb-3">{{ ucfirst(str_replace('_', ' ', $type)) }}s ({{ $count }})</h5>
                            @for($i = 0; $i < $count; $i++)
                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Name/Number</label>
                                        <input type="text" 
                                               class="form-control @error("components.{$index}.number") is-invalid @enderror" 
                                               name="components[{{ $index }}][number]" 
                                               value="{{ old("components.{$index}.number") }}" 
                                               placeholder="e.g., Main {{ ucfirst($type) }}" 
                                               required>
                                        <input type="hidden" name="components[{{ $index }}][type]" value="{{ $type }}">
                                        @error("components.{$index}.number")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Description</label>
                                        <input type="text" 
                                               class="form-control @error("components.{$index}.description") is-invalid @enderror" 
                                               name="components[{{ $index }}][description]" 
                                               value="{{ old("components.{$index}.description") }}" 
                                               placeholder="e.g., Located near main valve">
                                        @error("components.{$index}.description")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @php $index++; @endphp
                            @endfor
                        @endif
                    @endforeach

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Save All Components</button>
                        <a href="{{ route('superadmin.plantroom.components.create', $plantroom->plantroom_id) }}" 
                           class="btn btn-secondary">Back to Counts</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection