<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $room->title }} - Room Details</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --gray-light: #f3f4f6;
            --gray-medium: #9ca3af;
            --gray-dark: #374151;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--gray-light);
            color: var(--gray-dark);
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .room-details {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .room-image {
            position: relative;
            height: 400px;
            overflow: hidden;
        }

        .room-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status-badge {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .status-available {
            color: var(--success);
        }

        .status-booked {
            color: var(--danger);
        }

        .status-pending {
            color: var(--warning);
        }

        .room-content {
            padding: 2rem;
        }

        .room-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .room-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--gray-dark);
            margin-bottom: 0.5rem;
        }

        .room-location {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-medium);
            font-size: 1.125rem;
        }

        .room-price {
            text-align: right;
        }

        .price-amount {
            font-size: 2rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .price-period {
            color: var(--gray-medium);
        }

        .room-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
            padding: 2rem 0;
            border-top: 1px solid var(--gray-light);
            border-bottom: 1px solid var(--gray-light);
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .detail-label {
            font-size: 0.875rem;
            color: var(--gray-medium);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .detail-value {
            font-size: 1.25rem;
            font-weight: 500;
        }

        .room-description {
            margin-bottom: 2rem;
            font-size: 1.125rem;
            color: var(--gray-dark);
            line-height: 1.8;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .rating-stars {
            color: var(--warning);
            font-size: 1.25rem;
        }

        .rating-value {
            font-weight: 600;
            font-size: 1.125rem;
        }

        .booking-form {
            background: var(--gray-light);
            padding: 2rem;
            border-radius: 1rem;
            margin-top: 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-label {
            font-weight: 500;
            color: var(--gray-dark);
        }

        .form-control {
            padding: 0.75rem;
            border: 1px solid var(--gray-medium);
            border-radius: 0.5rem;
            font-size: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 1rem 2rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .room-header {
                flex-direction: column;
                gap: 1rem;
            }

            .room-price {
                text-align: left;
            }

            .room-image {
                height: 300px;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <div class="room-details">
            <div class="room-image">
                <img src="{{ $room->photo }}" alt="{{ $room->title }}">
                <span class="status-badge status-{{ strtolower($room->status) }}">
                    {{ $room->status }}
                </span>
            </div>

            <div class="room-content">
                <div class="room-header">
                    <div>
                        <h1 class="room-title">{{ $room->title }}</h1>
                        <div class="room-location">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $room->city }}
                        </div>
                    </div>
                    <div class="room-price">
                        <div class="price-amount">${{ $room->price }}</div>
                        <div class="price-period">per night</div>
                    </div>
                </div>

                <div class="rating">
                    <div class="rating-stars">
                        @for ($i = 0; $i < floor($room->rating); $i++)
                            ★
                        @endfor
                        @for ($i = floor($room->rating); $i < 5; $i++)
                            ☆
                        @endfor
                    </div>
                    <div class="rating-value">{{ $room->rating }} / 5</div>
                </div>

                <div class="room-details-grid">
                    <div class="detail-item">
                        <span class="detail-label">Capacity</span>
                        <span class="detail-value">{{ $room->seats }} guests</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status</span>
                        <span class="detail-value">{{ $room->status }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">City</span>
                        <span class="detail-value">{{ $room->city }}</span>
                    </div>
                </div>

                <div class="room-description">
                    {{ $room->description }}
                </div>
                <div class="booking-form">
                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label" for="check_in">Check-in Date</label>
                                <input type="datetime-local" id="check_in" name="check_in" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="check_out">Check-out Date</label>
                                <input type="datetime-local" id="check_out" name="check_out" class="form-control"
                                    required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Book Now</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
