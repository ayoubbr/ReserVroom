<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --success-color: #059669;
            --danger-color: #dc2626;
            --text-primary: #1f2937;
            --text-secondary: #4b5563;
            --border-color: #e5e7eb;
            --background-light: #f9fafb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--background-light);
            color: var(--text-primary);
            line-height: 1.5;
            padding: 2rem;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .create-room-btn {
            background: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .create-room-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 2rem 0 1rem;
            color: var(--text-primary);
        }

        .table-container {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8fafc;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--text-primary);
            border-bottom: 2px solid var(--border-color);
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-secondary);
        }

        tr:hover {
            background: #f8fafc;
        }

        .status {
            padding: 0.375rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-block;
        }

        .status-available,
        .status-accepted {
            background: #dcfce7;
            color: var(--success-color);
        }

        .status-unavailable,
        .status-rejected {
            background: #fee2e2;
            color: var(--danger-color);
        }

        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background: #e0f2fe;
            color: var(--primary-color);
        }

        .btn-edit:hover {
            background: #bae6fd;
        }

        .btn-delete {
            background: #fee2e2;
            color: var(--danger-color);
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        .btn-accept {
            background: #dcfce7;
            color: var(--success-color);
        }

        .btn-accept:hover {
            background: #bbf7d0;
        }

        .btn-reject {
            background: #fee2e2;
            color: var(--danger-color);
        }

        .btn-reject:hover {
            background: #fecaca;
        }

        @media (max-width: 1024px) {
            .table-container {
                overflow-x: auto;
            }

            body {
                padding: 1rem;
            }
        }

        @media (max-width: 640px) {
            .dashboard-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <div class="dashboard-header">
            <h1 class="page-title">Admin Dashboard</h1>
            <a href="{{ route('rooms.create') }}" class="create-room-btn">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create New Room
            </a>
        </div>

        <h2 class="section-title">Rooms Management</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>City</th>
                        <th>Price</th>
                        <th>Seats</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr>
                            <td>{{ $room->id }}</td>
                            <td>{{ $room->title }}</td>
                            <td>{{ $room->city }}</td>
                            <td>${{ number_format($room->price, 2) }}</td>
                            <td>{{ $room->seats }}</td>
                            <td>
                                <span class="status status-{{ strtolower($room->status) }}">
                                    {{ $room->status }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-edit">Edit</a>
                                    <a href="{{ route('rooms.delete', $room->id) }}" class="btn btn-delete">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h2 class="section-title">Reservations Management</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Room</th>
                        {{-- <th>User</th> --}}
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->id }}</td>
                            <td>{{ $reservation->room->title }}</td>
                            {{-- <td>{{ $reservation->user->name }}</td> --}}
                            <td>{{ date('d-M-Y H:i', strtotime($reservation->check_in)) }}</td>
                            <td>{{ date('d-M-Y H:i', strtotime($reservation->check_out)) }} </td>
                            <td>
                                <span class="status status-{{ strtolower($reservation->status) }}">
                                    {{ $reservation->status }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    @if ($reservation->status === 'Pending')
                                        <form action="{{ route('reservations.accept', $reservation->id) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-accept">Accept</button>
                                        </form>
                                        <form action="{{ route('reservations.reject', $reservation->id) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-reject">Reject</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
