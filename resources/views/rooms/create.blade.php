<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Room</title>
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ URL::asset('css/create.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                <div class="max-w-md mx-auto">
                    <div class="flex items-center space-x-5">
                        <div class="h-14 w-14 bg-blue-100 rounded-full flex flex-shrink-0 justify-center items-center text-blue-500">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="block pl-2 font-semibold text-xl text-gray-700">
                            <h2 class="leading-relaxed">Create New Room</h2>
                            <p class="text-sm text-gray-500 font-normal leading-relaxed">Enter the room details below</p>
                        </div>
                    </div>
                    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" class="divide-y divide-gray-200">
                        @csrf
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="flex flex-col">
                                <label class="leading-loose">Room Title</label>
                                <input type="text" name="title" required 
                                    class="px-4 py-2 border focus:ring-blue-500 focus:border-blue-500 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none">
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose">Description</label>
                                <textarea name="description" required
                                    class="px-4 py-2 border focus:ring-blue-500 focus:border-blue-500 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none"
                                    rows="4"></textarea>
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose">Number of Seats</label>
                                <input type="number" name="seats" required min="1"
                                    class="px-4 py-2 border focus:ring-blue-500 focus:border-blue-500 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none">
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose">City</label>
                                <input type="text" name="city" required
                                    class="px-4 py-2 border focus:ring-blue-500 focus:border-blue-500 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none">
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose">Price per Night</label>
                                <input type="number" name="price" required min="0" step="0.01"
                                    class="px-4 py-2 border focus:ring-blue-500 focus:border-blue-500 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none">
                            </div>
                            {{-- <div class="flex flex-col">
                                <label class="leading-loose">Price per Night</label>
                                <input type="datetime-local" name="date" required min="0" step="0.01"
                                    class="px-4 py-2 border focus:ring-blue-500 focus:border-blue-500 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none">
                            </div> --}}
                            <div class="flex flex-col">
                                <label class="leading-loose">Room Photo</label>
                                <input type="text" name="photo" required
                                class="px-4 py-2 border focus:ring-blue-500 focus:border-blue-500 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none">
                            </div>
                        </div>
                        <div class="pt-4 flex items-center space-x-4">
                            <button type="button" onclick="window.history.back()" 
                                class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg> Cancel
                            </button>
                            <button type="submit" 
                                class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none hover:bg-blue-600">
                                Create Room
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>