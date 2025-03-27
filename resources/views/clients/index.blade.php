@extends('layouts.vertical', ['title' => 'Client List'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Client List'])
    <div class="container mt-5">
   
@if(session('success'))
    <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
@endif

<a href="{{ route('clients.create') }}">Add a new Client</a>
<div class="table-responsive-sm">
<table class="table table-striped mb-0 table-sm">
    <thead>
        <tr class="table-dark">
            <th>Company Name</th>
            <th>Contact Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Website</th>
            <th>Address</th>
            <th>Pools</th>
            <th>Users</th>
            <th>Schedules</th>
            <th>Equipment</th>
            <th>Since</th>
</tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{ $client->company_name }}</td>
            <td>{{ $client->client_contact }} </td>
            <td>{{ $client->client_phone }}</td>
            <td>{{ $client->client_email }}</td>
            <td>{{ $client->company_website }}</td>
            <td><button type="button" tabindex="0" class="btn btn-info" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" data-bs-content="{{ $client->company_address }}  ?? 'None' }} {{ $client->company_post_code }} ?? 'None'" data-bs-original-title="Backwash Info">
                        Address
                    </button></td>
            <td><div class="btn btn-soft-warning btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:shield-warning-broken" class="fs-20 me-1"></iconify-icon></td>
            <td><button type="button" tabindex="0" class="btn btn-info" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" data-bs-content="{{ $client->description ?? 'None' }} VAT: {{ $client->vat_number ?? 'None' }} REG:{{ $client->company_registration_number ?? 'None' }}" data-bs-original-title="Backwash Info">
             Description</button></td>
             <td>                                    <div class="hstack gap-1 justify-content-end">
                                        <a href="{{ route('pools.create', ['clientID' => $client->client_id ])}}"
                                            class="btn btn-soft-primary btn-icon btn-sm rounded-circle"> <i
                                                class="ti ti-eye"></i></a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i
                                                class="ti ti-edit fs-16"></i></a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-soft-danger btn-icon btn-sm rounded-circle"> <i
                                                class="ti ti-trash"></i></a>
                                    </div></td>
                                    <td>                                    <div class="hstack gap-1 justify-content-end">
                                        <a href="javascript:void(0);"
                                            class="btn btn-soft-primary btn-icon btn-sm rounded-circle"> <i
                                                class="ti ti-eye"></i></a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i
                                                class="ti ti-edit fs-16"></i></a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-soft-danger btn-icon btn-sm rounded-circle"> <i
                                                class="ti ti-trash"></i></a>
                                    </div></td>
                                    <td>                                    <div class="hstack gap-1 justify-content-end">
                                        <a href="javascript:void(0);"
                                            class="btn btn-soft-primary btn-icon btn-sm rounded-circle"> <i
                                                class="ti ti-eye"></i></a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i
                                                class="ti ti-edit fs-16"></i></a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-soft-danger btn-icon btn-sm rounded-circle"> <i
                                                class="ti ti-trash"></i></a>
                                    </div></td>
            <td>{{ $client->created_at }}</td>
          
        </tr>
        @endforeach
    </tbody>
</table></div>
    </div>
@endsection