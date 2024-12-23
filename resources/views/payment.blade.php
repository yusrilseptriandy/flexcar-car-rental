<x-front-layout>
  <section class="bg-darkGrey relative py-16 lg:py-24">
    <div class="container">
      <header class="text-center mb-8">
        <h2 class="font-bold text-2xl text-dark mb-2">
          Checkout & Drive Faster
        </h2>
        <p class="text-base text-secondary">We will help you get ready today</p>
      </header>

      <div class="flex flex-col lg:flex-row items-center gap-10">
        <!-- Form Card -->
        <form action="{{ route('front.payment.update', $booking->id) }}" class="bg-white p-8 pb-12 rounded-3xl max-w-[490px] w-full shadow-lg" method="POST" id="checkoutForm">
          @csrf
          @method('POST')
          <div class="flex flex-col gap-8">
            <!-- Review Order Section -->
            <div class="flex flex-col gap-4">
              <h5 class="text-lg font-semibold text-dark">Review Order</h5>

              <!-- Order Details -->
              <div class="space-y-4">
                <div class="flex justify-between">
                  <p class="text-base text-gray-600">Car choosen</p>
                  <p class="text-base font-semibold">{{$booking->item->name}}</p>
                </div>
                <div class="flex justify-between">
                  <p class="text-base text-gray-600">Total days</p>
                  <p class="text-base font-semibold">{{$booking->start_date->diffInDays($booking->end_date)}}</p>
                </div>
                <div class="flex justify-between">
                  <p class="text-base text-gray-600">Service</p>
                  <p class="text-base font-semibold">Delivery</p>
                </div>
                <div class="flex justify-between">
                  <p class="text-base text-gray-600">Price</p>
                  <p class="text-base font-semibold">{{ number_format($booking->item->price) }}</p>
                </div>
              
                <div class="flex justify-between">
                  <p class="text-base text-gray-600">Grand total</p>
                  <p class="text-base font-semibold text-primary">{{ number_format($booking->total_price) }}</p>
                </div>
              </div>
            </div>

            <!-- Payment Method Section -->
            <div class="flex flex-col gap-4">
                <h5 class="text-lg font-semibold text-dark">Payment Method</h5>
                <div class="relative">
                    <select name="payment_method" id="paymentMethod" class="w-full px-4 py-3 border border-grey rounded-2xl shadow-md focus:ring-primary focus:border-primary transition-all">
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                    </select>
                </div>
                </div>
            <!-- Continue Button -->
            <div class="mt-8">
              <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white py-4 px-8 rounded-full text-lg font-semibold transition duration-200 flex items-center justify-center gap-3 group">
                <p>Continue</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
              </button>
            </div>
          </div>
        </form>

        <!-- Car Image Section (Only on Large Screens) -->
        <div class="hidden lg:block lg:max-w-[45%] lg:ml-12">
          <img src="../assets/images/porsche_small.webp" alt="Porsche Car" class="w-full h-auto rounded-xl shadow-xl">
        </div>
      </div>
    </div>
  </section>
</x-front-layout>
