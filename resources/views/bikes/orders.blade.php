@extends('layouts.vertical', ['title' => 'Bike Hire Orders'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Bike Hire Orders'])
    
   
@if(session('success'))
    <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
@endif

<div class="card">



        <div class="col-md-6">
            <div class="card border-secondary border">
                <div class="card-body">
                <div class="table-responsive-sm">
<table class="table table-striped mb-0 table-sm">
    <thead>
        <tr class="table-dark">
            <th colspan="3">Bike Hire Orders</th>
            </tr>
<tr class="table-dark">
            <th>Order #</th>
            <th>Date</th>
            <th>Duration</th>
            <th>Bikes</th>
            <th>Helmets</th>
            <th>Locks</th>
            <th>Status</th>
            
</tr>
<tbody>
        @foreach($orders as $order)
        <tr>
        <td>{{$order->id}}</td>
            <td>{{$order->date}}</td>
            
            <td>        <form method="POST" action="{{ route('bikes.update', $mountainbike->id) }}">
            @csrf
            @method('PUT')
            <div class="input-group">
            <select class="form-select" name="status" aria-label="Example select with button addon">
                <option value="ready for hire" @if($order->status == 'ready for hire') selected @endif>Ready for Hire</option>
                <option value="hired" @if($mountainbike->status == 'hired') selected @endif>Hired</option>
                <option value="awaiting check" @if($mountainbike->status == 'awaiting check') selected @endif>Awaiting Check</option>
                <option value="awaiting maintenance" @if($mountainbike->status == 'awaiting maintenance') selected @endif>Maintenance</option>
                <option value="reserved" @if($mountainbike->status == 'reserved') selected @endif>Reserved</option>
            </select>
            <button class="btn btn-outline-secondary" type="submit">Update</button></div>
</form>
            </tr>
            @endforeach
            </table></div><!-- end table-->
            </div><!-- end card-body-->
                </div> <!-- end card-bordery-->
            </div> <!-- end column-->
            </div><!-- end card-body-->

    </div>
    <!-- end row -->
   
@endsection