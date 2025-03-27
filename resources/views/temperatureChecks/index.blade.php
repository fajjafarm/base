@extends('layouts.app')

@section('content')
    <h1>Temperature Checks</h1>
    <a href="{{ route('temperatureChecks.index') }}" class="btn btn-primary mb-3">Submit New Temperature Check</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Location</th>
                <th>Temperature</th>
                <th>Checked By</th>
                <th>Created At</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($temperatureChecks as $check)
                <tr>
                    <td>{{ $check->id }}</td>
                    <td>{{ $check->location_id }}</td>
                    <td>{{ $check->temperature }}</td>
                    <td>{{ $check->checked_by }}</td>
                    <td>{{ $check->created_at }}</td>
                    <td>notes tbc</td>
                    <td>
                        <a href="{{ route('temperatureChecks.index', $check->id) }}">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $temperatureChecks->links() }}
@endsection