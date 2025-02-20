<!-- resources/views/reservations/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Create Reservation</title>
    <style>
        .reservation-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .room-card {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .room-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .room-details {
            padding: 20px;
        }

        .room-name {
            font-size: 24px;
            color: #333;
            margin: 0 0 10px 0;
        }

        .room-description {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .room-features {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #555;
        }

        .room-price {
            font-size: 24px;
            color: #4CAF50;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .form-title {
            text-align: center;
            color: #333333;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555555;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 4px;
            font-size: 16px;
            color: #333333;
        }

        .form-control:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.2);
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="reservation-container">
        <div class="room-card">
            <img src="{{ $room->photo }}" alt="{{ $room->title }}" class="room-image">
            <div class="room-details">
                <h1 class="room-name">{{ $room->title }}</h1>
                <p class="room-description">{{ $room->description }}</p>
                <div class="room-features">
                    <div class="feature">
                        <span>👥</span> {{ $room->seats }} Guests
                    </div>
                    <div class="feature">
                        <span>🛏️</span> {{ $room->status }}
                    </div>
                    <div class="feature">
                        <span>🌆</span> {{ $room->city }}
                    </div>
                    <div class="feature">
                        <span>⭐</span> {{ $room->rating }}
                    </div>
                </div>
                <div class="room-price">
                    ${{ number_format($room->price, 2) }} / day
                </div>
            </div>
        </div>

        <h2 class="form-title">Create New Reservation</h2>
        
        <form method="POST" action="{{ route('reservations.store') }}">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            
            <div class="form-group">
                <label for="check_in">Check-in Date and Time:</label>
                <input 
                    type="datetime-local" 
                    id="check_in" 
                    name="check_in" 
                    class="form-control"
                    value="{{ old('check_in') }}"
                    min="{{ date('Y-m-d\TH:i') }}"
                    required
                >
                @error('check_in')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="check_out">Check-out Date and Time:</label>
                <input 
                    type="datetime-local" 
                    id="check_out" 
                    name="check_out" 
                    class="form-control"
                    value="{{ old('check_out') }}"
                    min="{{ date('Y-m-d\TH:i') }}"
                    required
                >
                @error('check_out')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="submit-btn">Create Reservation</button>
        </form>
    </div>

    <script>
        // Ensure check-out date is after check-in date
        document.getElementById('check_in').addEventListener('change', function() {
            document.getElementById('check_out').min = this.value;
        });
    </script>
</body>
</html>