@extends('layouts.vertical', ['title' => 'Log a Backwash'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Log a Backwash'])
    <div class="container mt-5">
    @if(session('success'))  
        <div class="alert alert-success">{{ session('success') }}   </div>
    @endif
    @if(session('notgood'))  
    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <iconify-icon icon="solar:danger-triangle-bold-duotone" class="fs-20 me-1"></iconify-icon>
                        <div class="lh-1"><strong>Error - </strong> {{ session('notgood') }}</div>
                    </div>
    @endif
        <h2>Log an Action</h2>
        <form action="{{ route('actionlog.store') }}" method="POST">
            @csrf
            <input type="hidden" name="test_id" value="{{ $testId }}">
            <input type="hidden" name="logged_by" value="{{ $logged_by }}">
            
            <div class="mb-3">
            <label for="action_type" class="form-label">Action Type</label>
            <select class="form-select" id="action_type" name="action_type" required>
                <option value="">Select Action Type</option>
                @foreach($actionTypes as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
            </div>
            <div class="mb-3">
            <label for="escalation" class="form-label">Escalated to</label>
            <select class="form-select" id="escalation" name="escalation" required>
                <option value="">Select Escalation Type</option>
                @foreach($escalationTypes as $escalation)
                    <option value="{{ $escalation }}">{{ $escalation }}</option>
                @endforeach
            </select>
            </div>
            <div class="mb-3">
            <label for="progress" class="form-label">Progress</label>
            <select class="form-select" id="progress" name="progress" required>
                <option value="">Select Progress</option>
                @foreach($progressTypes as $progress)
                    <option value="{{ $progress }}">{{ $progress }}</option>
                @endforeach
            </select>
            </div>
            <div class="mb-3">
                <label for="comments" class="form-label">Comments:</label>
                <textarea name="comments" id="comments" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection