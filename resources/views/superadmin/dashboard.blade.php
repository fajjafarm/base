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
    </div>
@endsection