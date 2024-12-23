<x-front-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">My Orders</h2>
        <div class="space-y-4">
            @foreach($bookings as $booking)
                <div class="bg-white rounded-lg shadow border overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="text-xl font-semibold text-gray-900">Booking #{{ $booking->id }}</h5>
                            <span class="px-4 py-2 rounded-full text-sm font-semibold
                                @if($booking->status === 'pending') 
                                    bg-yellow-100 text-yellow-800
                                @elseif($booking->status === 'SUCCESS')
                                    bg-green-300 text-green-800
                                @elseif($booking->status === 'cancel')
                                    bg-red-100 text-red-800
                                @endif
                            ">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-gray-600">
                                        {{ $booking->start_date->format('d M Y') }} - {{ $booking->end_date->format('d M Y') }}
                                    </span>
                                </div>
                                
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <span class="text-black font-bold">{{ $booking->item->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                    <span class="text-gray-600">{{ ucfirst($booking->payment_method) }}</span>
                                </div>
                                
                                <div class="flex items-center">
                                    
                                    <span class="font-medium text-gray-900">Rp.{{ number_format($booking->total_price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-front-layout>