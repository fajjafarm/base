@extends('layouts.vertical', ['title' => 'Super Admin Dashboard'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Super Admin', 'title' => 'Dashboard'])

    <div class="container mt-4 mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-12 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Manage Plantrooms</h5>
                        <a href="{{ route('superadmin.plantroom.create') }}" class="btn btn-primary">Add Plantroom</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Manage Pools</h5>
                        <a href="{{ route('superadmin.pool.create') }}" class="btn btn-primary">Add Pool</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Manage Thermal Suites</h5>
                        <a href="{{ route('superadmin.thermal_suite.create') }}" class="btn btn-primary">Add Thermal Suite</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Water Meter Locations</h5>
                        <a href="{{ route('superadmin.water_meter.create') }}" class="btn btn-primary">Add Location</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Manage Team Members</h5>
                        <a href="{{ route('superadmin.team_member.create') }}" class="btn btn-primary">Add Team Member</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Plantroom List with Add Components Links -->
        <div class="card shadow-sm mt-4">
            <div class="card-header">
                <h4 class="header-title">Plantrooms</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-striped table-sm mb-0">
                        <thead>
                            <tr class="table-dark">
                                <th>Name</th>
                                <th>Client</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $plantrooms = \App\Models\PlantroomList::with('client')->get();
                            @endphp
                            @forelse($plantrooms as $plantroom)
                                <tr>
                                    <td>{{ $plantroom->plantroom_name }}</td>
                                    <td>{{ $plantroom->client->company_name ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('superadmin.plantroom.components.create', $plantroom->plantroom_id) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="ti ti-plus me-1"></i> Add Components
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No plantrooms found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection