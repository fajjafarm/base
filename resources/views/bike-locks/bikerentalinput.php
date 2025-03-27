@foreach($bikes as $bike)
    <div>
        <h3>{{ $bike->type }} - Status: {{ $bike->status }}</h3>
        <p>Rentals:
        @foreach($bike->bike_rentals as $rental)
            <br>- BikeID: {{ $rental->bike_id }}Order: {{ $rental->order_number }}, Name: {{ $rental->name }}, Duration: {{ $rental->duration }}, Helmet: {{ $rental->helmet_borrowed ? 'Yes' : 'No' }}, Lock: {{ $rental->lock_borrowed ? 'Yes' : 'No' }}
        @endforeach
        </p>

    </div>
@endforeach

<form action="{{ route('bikes.store') }}" method="POST">
    @csrf
    <input type="text" name="bike_id" placeholder="Bike ID">
    <input type="text" name="order_number" placeholder="Order Number">
    <input type="text" name="name" placeholder="Name">
    <input type="number" name="duration" placeholder="Duration">
    <input type="checkbox" name="helmet_borrowed" value="1"> Helmet
    <input type="checkbox" name="lock_borrowed" value="1"> Lock
    <button type="submit">Rent Bike </button>
</form>
   
@endsection