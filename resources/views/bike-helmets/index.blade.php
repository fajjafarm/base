@extends('layouts.vertical', ['title' => 'Bike Helmets Log'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Bike Helmets Log'])
    
   
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
            <th colspan="4">Bike Helmets</th>
            </tr>
<tr class="table-dark">
            <th>#</th>
            <th>Colour</th>
            <th>Size</th>
            <th>Status</th>
            
</tr>
<tbody>
        @foreach($bikehelmets as $bikehelmet)
        <tr>
        <td>{{$bikehelmet->id}}</td>
        <td>{{$bikehelmet->colour}}</td>
            <td>{{$bikehelmet->size}}</td>
            
            <td>        <form method="POST" action="{{ route('bike-helmets.update', $bikehelmet->id) }}">
            @csrf
            @method('PUT')
            <div class="input-group">
            <select class="form-select" name="status" aria-label="Example select with button addon">
                <option value="ready for hire" @if($bikehelmet->status == 'ready for hire') selected @endif>Ready for Hire</option>
                <option value="hired" @if($bikehelmet->status == 'hired') selected @endif>Hired</option>
                <option value="awaiting check" @if($bikehelmet->status == 'awaiting check') selected @endif>Awaiting Check</option>
                <option value="awaiting maintenance" @if($bikehelmet->status == 'awaiting maintenance') selected @endif>Maintenance</option>
                <option value="reserved" @if($bikehelmet->status == 'Reserved') selected @endif>Reserved</option>
                <option value="missing" @if($bikehelmet->status == 'Missing') selected @endif>Missing</option>
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