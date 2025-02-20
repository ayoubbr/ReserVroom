<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations</title>
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
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.875rem;
            color: var(--gray-dark);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--gray-medium);
            font-size: 1rem;
        }

        .reservations-grid {
            display: grid;
            gap: 1.5rem;
        }

        .reservation-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .reservation-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-light);
        }

        .room-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-dark);
        }

        .reservation-id {
            font-size: 0.875rem;
            color: var(--gray-medium);
        }

        .reservation-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .detail-group {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .detail-label {
            font-size: 0.875rem;
            color: var(--gray-medium);
        }

        .detail-value {
            font-weight: 500;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-align: center;
            display: inline-block;
        }

        .status-accepted {
            background-color: rgba(34, 197, 94, 0.1);
            color: var(--success);
        }

        .status-pending {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .status-rejected {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .status-completed {
            background-color: var(--gray-light);
            color: var(--gray-dark);
        }

        .reservation-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-light);
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            text-align: center;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .btn-outline {
            border: 1px solid var(--gray-medium);
            color: var(--gray-dark);
        }

        .btn-outline:hover {
            background-color: var(--gray-light);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .reservation-details {
                grid-template-columns: 1fr;
            }

            .reservation-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .empty-state-text {
            color: var(--gray-medium);
            margin-bottom: 1rem;
        }
    </style>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">My Reservations</h1>
            <p class="page-subtitle">View and manage your room bookings</p>
        </div>

        <div class="reservations-grid">
            @forelse ($reservations as $reservation)
                <div class="reservation-card">
                    <div class="reservation-header">
                        <div>
                            <h2 class="room-title">{{ $reservation->room->title }}</h2>
                            <span class="reservation-id">Reservation #{{ $reservation->id }}</span>
                        </div>
                        <span class="status-badge status-{{ strtolower($reservation->status) }}">
                            {{ $reservation->status }}
                        </span>
                    </div>

                    <div class="reservation-details">
                        <div class="detail-group">
                            <span class="detail-label">Check-in</span>
                            <span class="detail-value">{{ date('D, M d, Y', strtotime($reservation->check_in)) }}</span>
                            <span class="detail-value">{{ date('h:i A', strtotime($reservation->check_in)) }}</span>
                        </div>

                        <div class="detail-group">
                            <span class="detail-label">Check-out</span>
                            <span
                                class="detail-value">{{ date('D, M d, Y', strtotime($reservation->check_out)) }}</span>
                            <span class="detail-value">{{ date('h:i A', strtotime($reservation->check_out)) }}</span>
                        </div>

                        <div class="detail-group">
                            <span class="detail-label">Location</span>
                            <span class="detail-value">{{ $reservation->room->city }}</span>
                        </div>

                        <div class="detail-group">
                            <span class="detail-label">Total Price</span>
                            <span class="detail-value">${{ number_format($reservation->room->price, 2) }}</span>
                        </div>
                    </div>

                    <div class="reservation-actions">
                        @if ($reservation->status === 'Pending')
                            <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST"
                                style="width: 100%;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="width: 100%;">Cancel
                                    Reservation</button>
                            </form>
                        @endif
                        <a href="{{ route('rooms.show', $reservation->room->id) }}" class="btn btn-primary"
                            style="width: 100%;">View Room Details</a>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p class="empty-state-text">You don't have any reservations yet.</p>
                    <a href="{{ route('rooms.index') }}" class="btn btn-primary">Browse Rooms</a>
                </div>
            @endforelse
        </div>
    </div>
</body>

</html>
