@extends('layouts.vertical', ['title' => 'Water Meter Readings'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Water Meter Readings'])
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
    <div class="row">
<div class="card">
                <div class="card-header d-flex align-items-center justify-content-between border-bottom border-light">
                    <h4 class="header-title">Location:{{ $plantroomID }} {{ $plantroomName }}</h4>
                    <div>
                        <a href="{{ route('water-meter-readings.create', ['plantroomID' => $plantroomID ])}}" class=" btn btn-success bg-gradient"><i
                                class="ti ti-plus me-1"></i> Add a Water Meter Reading</a>
                        
                    </div>
                </div>

            <div class="card">
            <div class="card-body">
            <div dir="ltr">
            

            {!! $chart->container() !!}
 
 <script src="{{ $chart->cdn() }}"></script>

 {{ $chart->script() }}
 </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
                
            </div>
</div>
<div class="table-responsive-sm">
<table class="table table-striped mb-0 table-sm">
    <thead>
<tr class="table-dark">
            <th>Reading</th>
            <th>Difference (l/day)</th>
            <th>Result </th>
            <th>Logged by</th>
            <th>Reading Time</th>
            
                   </tr>
    </thead>
    <tbody>
    
   
    @foreach ($readings as $key => $reading)  
        <tr>
            <td>
            {{ $reading->meter_reading }}    
            </td>
            <td>
            {{ $reading->difference }}
            </td>
            <td>
            @if($reading->difference < '999')<button type="button" class="btn btn-soft-info">Low Water Usage</button>@endif
            @if($reading->difference >= '1000' && $reading->difference < '2500')<button type="button" class="btn btn-soft-success">Normal Water Usage</button>@endif 
            @if($reading->difference >= '2500')<button type="button" class="btn btn-soft-danger">Abnormal Water Usage</button>@endif   
            </td>
            <td> <button type="button" tabindex="0" class="btn btn-info" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" data-bs-content="{{ $reading->logged_by }}" data-bs-original-title="Reading Logged By">
            <iconify-icon icon="solar:people-nearby-broken" class="fs-20 me-1" alt="{{ $reading->logged_by }}"></iconify-icon>
                    </button></td>
            <td>{{ $reading->created_at }}</td>
            
          
        </tr>
        @endforeach
    </tbody>
</table>
    </div>
    </div></div>
@endsection



