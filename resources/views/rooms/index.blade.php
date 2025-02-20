<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Rooms</title>
    {{-- <link rel="stylesheet" href="css/rooms.css"> --}}
    <link rel="stylesheet" href="{{ URL::asset('css/rooms.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <h1 class="page-title">Available Rooms</h1>

        <div class="rooms-grid">
            @if (count($rooms) == 0)
                <h2>No rooms Available for now 😒, Come back later 😊!</h2>
            @endif
            @foreach ($rooms as $room)
                <div class="room-card">
                    <img src="{{ $room->photo }}" alt="{{ $room->title }}" class="room-image">
                    <div class="room-details">
                        <div class="room-header">
                            <h2 class="room-title">{{ $room->title }}</h2>
                            <a href="{{ route('reservations.create', $room->id) }}">Reserve Now</a>
                        </div>

                        <p class="room-description">{{ $room->description }}</p>

                        <div class="room-meta">
                            <span class="room-price">${{ number_format($room->price, 2) }}/Day</span>
                            <span class="room-location">{{ $room->city }}</span>
                        </div>

                        <div class="room-stats">
                            <span>{{ $room->seats }} seats</span>
                            <span class="room-rating">★ {{ number_format($room->rating, 1) }}</span>
                            <span
                                class="status-badge {{ $room->status === 'Available' ? 'status-available' : ($room->status === 'Pending reservation' ? 'status-pending' : 'status-booked') }}">
                                {{ $room->status }}
                            </span>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('reservations.index') }}" class="add-room-btn">See my reservation</a>

    </div>
</body>

</html>
