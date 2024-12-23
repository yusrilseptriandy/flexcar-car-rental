<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            <a href="{{ route('bookings.index') }}" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
                </svg>
                Booking Details
            </a>
        </h2>
    </x-slot>

    <div class="py-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Left Column - Personal Information --}}
                <div>
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Booking Information</h2>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Customer Details</h3>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <span class="text-gray-600">Name:</span>
                                    <p class="font-semibold">{{ $booking->name ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-600">Email:</span>
                                    <p class="font-semibold">{{ $booking->user->email ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-600">Address:</span>
                                    <p class="font-semibold">{{ $booking->address ?? 'N/A' }}</p>
                                    <p class="font-semibold">zip code :  {{ $booking->zip ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-600">City:</span>
                                    <p class="font-semibold">{{ $booking->city ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Booking Details</h3>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <span class="text-gray-600">Booking ID:</span>
                                    <p class="font-semibold">#{{ $booking->id }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-600">Status:</span>
                                    <span class="
                                        px-3 py-1 rounded-full text-sm font-bold 
                                        {{ $booking->status == 'PENDING' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($booking->status == 'SUCCESS' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}
                                    ">
                                        {{ $booking->status }}
                                    </span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Payment Methode:</span>
                                    <span class="px-3 py-1 rounded-full text-sm font-bold 
                                        {{

                                            $booking->payment_method == 'cash' ? 'bg-green-200 text-green-800' : 'bg-blue-100 text-blue-800'

                                         }}
                                          ">
                                        {{ $booking->payment_method }}
                                    </span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Start Date:</span>
                                    <p class="font-semibold">{{ $booking->start_date ? $booking->start_date->format('d M Y') : 'N/A' }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-600">End Date:</span>
                                    <p class="font-semibold">{{ $booking->end_date ? $booking->end_date->format('d M Y') : 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column - Item Details --}}
                <div>
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Item Details</h2>
                    
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <span class="text-gray-600">Item Name:</span>
                                <p class="font-semibold">{{ $booking->item->name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <span class="text-gray-600">Brand:</span>
                                <p class="font-semibold">{{ $booking->item->brand->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Pricing</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <span class="text-gray-600">Price per Day:</span>
                                <p class="font-semibold">Rp {{ number_format($booking->item->price ?? 0, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <span class="text-gray-600">Total Price:</span>
                                <p class="font-semibold text-blue-700">Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <a href="{{ route('bookings.edit', $booking->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                            Edit Booking
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>