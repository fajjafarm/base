@extends('layouts.vertical', ['title' => 'Add a new Client'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Add a new Client'])
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
        <h1>Add New Client</h1>
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="company_name">Company Name:</label>
            <input type="text" name="company_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="company_address">Company Address:</label>
            <textarea name="company_address" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="company_post_code">Company Post Code:</label>
            <input type="text" name="company_post_code" class="form-control" maxlength="20" required>
        </div>
        <div class="mb-3">
            <label for="client_contact">Client Contact:</label>
            <input type="text" name="client_contact" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="client_phone">Client Phone:</label>
            <input type="text" name="client_phone" class="form-control" maxlength="20" required>
        </div>
        <div class="mb-3">
            <label for="client_email">Client Email:</label>
            <input type="email" name="client_email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="company_website">Company Website:</label>
            <input type="url" name="company_website" class="form-control">
        </div>
        <div class="mb-3">
            <label for="vat_number">VAT Number:</label>
            <input type="text" name="vat_number" class="form-control" maxlength="20">
        </div>
        <div class="mb-3">
            <label for="company_registration_number">Company Registration Number:</label>
            <input type="text" name="company_registration_number" class="form-control" maxlength="20">
        </div>
        <div class="mb-3">
            <label for="company_description">Company Description:</label>
            <textarea name="company_description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection