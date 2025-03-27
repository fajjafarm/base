@extends('layouts.vertical', ['title' => 'Bike Rental Log'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Bike Rental Log'])
    
   
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
            <th colspan="3">Mountain Bikes</th>
            </tr>
<tr class="table-dark">
            <th>#</th>
            <th>Size</th>
            <th>Status</th>
            
</tr>
<tbody>
        @foreach($mountainbikes as $mountainbike)
        <tr>
        <td>{{$mountainbike->id}}</td>
            <td>{{$mountainbike->size}}</td>
            
            <td>        <form method="POST" action="{{ route('bikes.update', $mountainbike->id) }}">
            @csrf
            @method('PUT')
            <div class="input-group">
            <select class="form-select" name="status" aria-label="Example select with button addon">
                <option value="ready for hire" @if($mountainbike->status == 'ready for hire') selected @endif>Ready for Hire</option>
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
            <div class="card">

        <!-- start hybrids-->
        <div class="col-md-6">
            <div class="card border-primary border border-dashed">
                <div class="card-body">
                <div class="table-responsive-sm">
<table class="table table-striped mb-0 table-sm">
    <thead>
        <tr class="table-dark">
            <th colspan="3">Hybrid Bikes</th>
            </tr>
<tr class="table-dark">
            <th>#</th>
            <th>Size</th>
            <th>Status</th>
            
</tr>
<tbody>
                @foreach($hybrids as $hybrid)
        <tr>
        <td>{{$hybrid->id}}</td>
            <td>{{$hybrid->size}}</td>
            
            <td>        <form method="POST" action="{{ route('bikes.update', $hybrid->id) }}">
            @csrf
            @method('PUT')
            <div class="input-group">
            <select class="form-select" name="status" aria-label="Example select with button addon">
                <option value="ready for hire" @if($hybrid->status == 'ready for hire') selected @endif>Ready for Hire</option>
                <option value="hired" @if($hybrid->status == 'hired') selected @endif>Hired</option>
                <option value="awaiting check" @if($hybrid->status == 'awaiting check') selected @endif>Awaiting Check</option>
                <option value="awaiting maintenance" @if($hybrid->status == 'awaiting maintenance') selected @endif>Maintenance</option>
                <option value="reserved" @if($hybrid->status == 'reserved') selected @endif>Reserved</option>
            </select>
            <button class="btn btn-outline-secondary" type="submit">Update</button></div>
        </form></td>

            </tr>
            @endforeach
            </table></div>
            </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="card">
<!-- start ebikes-->
<div class="col-md-6">
            <div class="card border-primary border border-dashed">
                <div class="card-body">
                <div class="table-responsive-sm">
                <table class="table table-striped mb-0 table-sm">
    <thead>
        <tr class="table-dark">
            <th colspan="3">e-Bikes</th>
            </tr>
<tr class="table-dark">
            <th>#</th>
            <th>Size</th>
            <th>Status</th>
            
</tr>
<tbody>
                @foreach($ebikes as $ebike)
        <tr>
        <td>{{$ebike->id}}</td>
            <td>{{$ebike->size}}</td>
            
            <td>        <form method="POST" action="{{ route('bikes.update', $ebike->id) }}">
            @csrf
            @method('PUT')
            <div class="input-group">
            <select class="form-select" name="status" >
            <option value="ready for hire" @if($ebike->status == 'ready for hire') selected @endif>Ready for Hire</option>
                <option value="hired" @if($ebike->status == 'hired') selected @endif>Hired</option>
                <option value="awaiting check" @if($ebike->status == 'awaiting check') selected @endif>Awaiting Check</option>
                <option value="awaiting maintenance" @if($ebike->status == 'awaiting maintenance') selected @endif>Maintenance</option>
                <option value="reserved" @if($ebike->status == 'reserved') selected @endif>Reserved</option>
            </select>
            <button class="btn btn-outline-secondary" type="submit">Update</button></div>
        </form></td>

            </tr>
            @endforeach
            </table></div>
            </div></div></div>

        </div> <!-- end col-->
        <div class="card">
        <!-- start kids-->
        <div class="col-md-6">
            <div class="card border-success border">
                <div class="card-body">
                <div class="table-responsive-sm">
<table class="table table-striped mb-0 table-sm">
    <thead>
        <tr class="table-dark">
            <th colspan="3">Kids Bikes</th>
            </tr>
<tr class="table-dark">
            <th>#</th>
            <th>Size</th>
            <th>Status</th>
           
</tr>
<tbody>
                @foreach($kids as $kid)
        <tr>
        <td>{{$kid->id}}</td>
            <td>{{$kid->size}}</td>
            
            <td>        <form method="POST" action="{{ route('bikes.update', $kid->id) }}">
            @csrf
            @method('PUT')
<div class="input-group">
            <select class="form-select" name="status" >
               <option value="ready for hire" @if($kid->status == 'ready for hire') selected @endif> Ready for Hire</option>
                <option value="hired" @if($kid->status == 'hired') selected @endif>Hired</option>
                <option value="awaiting check" @if($kid->status == 'awaiting check') selected @endif >Awaiting Check</option>
                <option value="awaiting maintenance" @if($kid->status == 'awaiting maintenance') selected @endif> Awaiting Maintenance</option>
                <option value="reserved" @if($kid->status == 'reserved') selected @endif>Reserved</option>
            </select><button class="btn btn-outline-secondary" type="submit">Update</button></div>
            
            
        </form></td>

            </tr>
            @endforeach
            </table></div>
            </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row -->
   
@endsection