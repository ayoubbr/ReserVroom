<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Room</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --gray-light: #f3f4f6;
            --gray-medium: #9ca3af;
            --gray-dark: #374151;
            --danger: #ef4444;
            --success: #22c55e;
            --warning: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', system-ui, sans-serif;
            background: var(--gray-light);
            color: var(--gray-dark);
            line-height: 1.5;
        }

        .container {
            min-height: 100vh;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 700px;
        }

        .form-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .icon-container {
            width: 3.5rem;
            height: 3.5rem;
            background: #ebf3ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-container svg {
            width: 2rem;
            height: 2rem;
            color: var(--primary-color);
        }

        .form-title {
            font-size: 1.5rem;
            color: var(--gray-dark);
        }

        .form-subtitle {
            font-size: 0.875rem;
            color: var(--gray-medium);
            margin-top: 0.25rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
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

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            flex: 1;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-secondary {
            background: var(--gray-light);
            color: var(--gray-dark);
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        @media (max-width: 640px) {
            .container {
                padding: 1rem;
            }

            .form-card {
                padding: 1.5rem;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <div class="form-card">
            <div class="form-header">
                <div class="icon-container">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
                <div>
                    <h2 class="form-title">Update Room</h2>
                    <p class="form-subtitle">Modify the room details below</p>
                </div>
            </div>

            <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="title">Room Title</label>
                        <input type="text" id="title" name="title" class="form-control"
                            value="{{ $room->title }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="status">Room Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="Available" {{ $room->status === 'Available' ? 'selected' : '' }}
                                class="status-available">Available</option>
                            <option value="Booked" {{ $room->status === 'Booked' ? 'selected' : '' }}
                                class="status-booked">Booked</option>
                            {{-- <option value="pending" {{ $room->status === 'pending' ? 'selected' : '' }} class="status-pending">Pending Reservation</option> --}}
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" required>{{ $room->description }}</textarea>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="seats">Number of Seats</label>
                        <input type="number" id="seats" name="seats" class="form-control" min="1"
                            value="{{ $room->seats }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="city">City</label>
                        <input type="text" id="city" name="city" class="form-control"
                            value="{{ $room->city }}" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="price">Price per Night</label>
                        <input type="number" id="price" name="price" class="form-control" min="0"
                            step="0.01" value="{{ $room->price }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="photo">Room Photo URL</label>
                        <input type="text" id="photo" name="photo" class="form-control"
                            value="{{ $room->photo }}" required>
                    </div>
                </div>

                <div class="button-group">
                    <button type="button" onclick="window.history.back()" class="btn btn-secondary">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Update Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
