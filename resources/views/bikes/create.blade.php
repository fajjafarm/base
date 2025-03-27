@extends('layouts.vertical', ['title' => 'Submit Water Balance Test'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Submit Water Balance Test'])

    <body>

@if(session('success'))  
        <div class="alert alert-success">{{ session('success') }} </div>
    @endif
    @if(session('error'))  
    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <iconify-icon icon="solar:danger-triangle-bold-duotone" class="fs-20 me-1"></iconify-icon>
                        <div class="lh-1"><strong>Error - </strong> {{ session('error') }}</div>
                    </div>
    @endif


        <form action="{{ route('water-balance-checks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
            <label for="alkalinity">Alkalinity:</label>
            <input type="number" name="alkalinity" id="alkalinity" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
            <label for="calcium_hardness">Calcium Hardness:</label>
            <input type="number" name="calcium_hardness" id="calcium_hardness" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
            <label for="ph">pH:</label>
            <input type="number" name="ph" id="ph" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
                <!-- Here you might want to dynamically populate this if you have many pools -->
                <input type="hidden" id="pool_id" name="pool_id" value="{{$poolID}}" />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
@endsection
