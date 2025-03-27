@extends('layouts.vertical', ['title' => 'Backwash Record for'.$poolName])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Backwash Records'])
    <div class="container mt-5">
   
@if(session('success'))
    <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
@endif

<div class="card">
                <div class="card-header d-flex align-items-center justify-content-between border-bottom border-light">
                    <h4 class="header-title">Backwash List for {{$poolName}} </h4>
                    <div>
                        <a href="{{ route('backwashes.create', ['poolID' => $poolID ])}}" class="btn btn-success bg-gradient"><i
                                class="ti ti-plus me-1"></i> Record a Backwash</a>
                        
                    </div>
                </div>
<div class="table-responsive-sm">
<table class="table table-striped mb-0 table-sm">
    <thead>
        <tr class="table-dark">
            <th colspan="3">Filter Backwashed?</th>
            <th colspan="6">Filter Pressures Before/After</th>
            <th colspan="3">Pump Status</th>
            <th colspan="3">Baskets Cleaned?</th>
            <th colspan="4">&nbsp;</th>
</tr>
<tr class="table-dark">
            <th>F1.</th>
            <th>F2</th>
            <th>F3</th>
            <th>F1 B</th>
            <th>F1 A</th>
            <th>F2 B</th>
            <th>F2 A</th>
            <th>F3 B</th>
            <th>F3 A</th>
            <th>P1</th>
            <th>P2</th>
            <th>P3</th>
            <th>B1</th>
            <th>B2</th>
            <th>B3</th>
            <th>Reason</th>
            <th>Issues</th>
            <th>Signed</th>
            <th>Created At</th>
                   </tr>
    </thead>
    <tbody>
        @foreach($backwashes as $backwash)
        <tr>
            <td>
            @if($backwash->filter1_backwashed == 1)<div class="btn btn-soft-success btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:check-circle-broken" class="fs-20 me-1"></iconify-icon></div>@endif
            @if($backwash->filter1_backwashed == 0)<div class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:alarm-turn-off-broken" class="fs-20 me-1"></iconify-icon></div>@endif    
            </td>
            <td>
            @if($backwash->filter2_backwashed == 1)<div class="btn btn-soft-success btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:check-circle-broken" class="fs-20 me-1"></iconify-icon></div>@endif
            @if($backwash->filter2_backwashed == 0)<div class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:alarm-turn-off-broken" class="fs-20 me-1"></iconify-icon></div>@endif    
            </td>
            <td>
            @if($backwash->filter3_backwashed == 1)<div class="btn btn-soft-success btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:check-circle-broken" class="fs-20 me-1"></iconify-icon></div>@endif
            @if($backwash->filter3_backwashed == 0)<div class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:alarm-turn-off-broken" class="fs-20 me-1"></iconify-icon></div>@endif    
            </td>
            <td>{{ $backwash->filter1_before_pressure }}</td>
            <td>{{ $backwash->filter1_after_pressure }}</td>
            <td>{{ $backwash->filter2_before_pressure }}</td>
            <td>{{ $backwash->filter2_after_pressure }}</td>
            <td>{{ $backwash->filter3_before_pressure }}</td>
            <td>{{ $backwash->filter3_after_pressure }}</td>
            <td>
            @if($backwash->pump1_status == 'Running')<div class="btn btn-soft-success btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:check-circle-broken" class="fs-20 me-1"></iconify-icon></div>@endif
            @if($backwash->pump1_status == 'Off - Standby')<div class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:alarm-turn-off-broken" class="fs-20 me-1"></iconify-icon></div>@endif 
            @if($backwash->pump1_status == 'Off - Maintenance')<div class="btn btn-soft-warning btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:shield-warning-broken" class="fs-20 me-1"></iconify-icon></div>@endif   
            </td>
            <td>
            @if($backwash->pump2_status == 'Running')<div class="btn btn-soft-success btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:check-circle-broken" class="fs-20 me-1"></iconify-icon></div>@endif
            @if($backwash->pump2_status == 'Off - Standby')<div class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:alarm-turn-off-broken" class="fs-20 me-1"></iconify-icon></div>@endif 
            @if($backwash->pump2_status == 'Off - Maintenance')<div class="btn btn-soft-warning btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:shield-warning-broken" class="fs-20 me-1"></iconify-icon></div>@endif   
            </td>
            <td>
            @if($backwash->pump3_status == 'Running')<div class="btn btn-soft-success btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:check-circle-broken" class="fs-20 me-1"></iconify-icon></div>@endif
            @if($backwash->pump3_status == 'Off - Standby')<div class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:alarm-turn-off-broken" class="fs-20 me-1"></iconify-icon></div>@endif 
            @if($backwash->pump3_status == 'Off - Maintenance')<div class="btn btn-soft-warning btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:shield-warning-broken" class="fs-20 me-1"></iconify-icon></div>@endif   
            </td>
            <td>
            @if($backwash->basket1_cleaned == '1')<div class="btn btn-soft-success btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:check-circle-broken" class="fs-20 me-1"></iconify-icon></div>@endif
            @if($backwash->basket1_cleaned == '0')<div class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:alarm-turn-off-broken" class="fs-20 me-1"></iconify-icon></div>@endif 
            </td>
            <td>
            @if($backwash->basket2_cleaned == '1')<div class="btn btn-soft-success btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:check-circle-broken" class="fs-20 me-1"></iconify-icon></div>@endif
            @if($backwash->basket2_cleaned == '0')<div class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:alarm-turn-off-broken" class="fs-20 me-1"></iconify-icon></div>@endif 
            </td>
            <td>
            @if($backwash->basket3_cleaned == '1')<div class="btn btn-soft-success btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:check-circle-broken" class="fs-20 me-1"></iconify-icon></div>@endif
            @if($backwash->basket3_cleaned == '0')<div class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><iconify-icon icon="solar:alarm-turn-off-broken" class="fs-20 me-1"></iconify-icon></div>@endif 
             </td>
            <td>{{ $backwash->reason_for_backwash }}</td>
            <td>


            <button type="button" tabindex="0" class="btn btn-info" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" data-bs-content="{{ $backwash->issues ?? 'None' }}" data-bs-original-title="Backwash Info">
                        Info
                    </button></td>


            <td>
            <button type="button" tabindex="0" class="btn btn-info" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" data-bs-content="{{ $backwash->performed_by }}" data-bs-original-title="Backwash Logged By">
            <iconify-icon icon="solar:people-nearby-broken" class="fs-20 me-1" alt="{{ $backwash->performed_by }}"></iconify-icon>
                    </button></td>
            <td>{{ $backwash->created_at }}</td>
          
        </tr>
        @endforeach
    </tbody>
</table></div>
    </div>
@endsection