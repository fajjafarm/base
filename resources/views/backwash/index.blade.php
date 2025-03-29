@extends('layouts.vertical', ['title' => 'Backwash Records for ' . $plantroom->plantroom_name])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Plantrooms', 'title' => 'Backwash Records'])

    <div class="container mt-4 mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-header d-flex align-items-center justify-content-between border-bottom border-light">
                <h4 class="header-title">Backwash List for {{ $plantroom->plantroom_name }}</h4>
                <div>
                    <a href="{{ route('backwashes.create', $plantroom->plantroom_id) }}" 
                       class="btn btn-success bg-gradient">
                        <i class="ti ti-plus me-1"></i> Record a Backwash
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-striped table-sm mb-0">
                        <thead>
                            <tr class="table-dark">
                                <th>Component</th>
                                <th>Action</th>
                                <th>Pressure Before</th>
                                <th>Pressure After</th>
                                <th>Reason</th>
                                <th>Notes</th>
                                <th>Signed</th>
                                <th>Performed At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($backwashes as $backwash)
                                <tr>
                                    <td>
                                        {{ $backwash->component ? 
                                            ucfirst($backwash->component->component_type) . ' ' . $backwash->component->component_number : 
                                            'General' }}
                                    </td>
                                    <td>
                                        @if($backwash->pressure_before || $backwash->pressure_after)
                                            Backwashed
                                        @elseif($backwash->strainer_action)
                                            {{ ucfirst($backwash->strainer_action) }}
                                        @elseif($backwash->injector_action)
                                            {{ ucfirst($backwash->injector_action) }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $backwash->pressure_before ?? 'N/A' }}</td>
                                    <td>{{ $backwash->pressure_after ?? 'N/A' }}</td>
                                    <td>{{ $backwash->reason }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" 
                                                data-bs-toggle="popover" data-bs-placement="left" 
                                                data-bs-trigger="focus" 
                                                data-bs-content="{{ $backwash->notes ?? 'None' }}" 
                                                data-bs-title="Notes">
                                            Info
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" 
                                                data-bs-toggle="popover" data-bs-placement="left" 
                                                data-bs-trigger="focus" 
                                                data-bs-content="{{ $backwash->user ? $backwash->user->name : 'Unknown' }}" 
                                                data-bs-title="Logged By">
                                            <iconify-icon icon="solar:people-nearby-broken" class="fs-20"></iconify-icon>
                                        </button>
                                    </td>
                                    <td>{{ $backwash->performed_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
                popoverTriggerList.map(function (popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl);
                });
            });
        </script>
    @endpush
@endsection