<x-front-layout>
  <!-- Main Content -->
  <section class="min-h-screen bg-gray-100 py-16">
    <div class="container p-2 mx-auto px-4">
      <!-- Header -->
      <header class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-900 mb-3">
          Ready to Drive?
        </h2>
        <p class="text-lg text-gray-600">Complete your booking in just a few steps</p>
      </header>

      <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
        <!-- Form Card -->
        <div class="w-full lg:w-1/2 max-w-2xl">
          <form action="{{ route('front.checkout.store', $item->slug) }}" class="backdrop-blur-sm bg-white/90 shadow-2xl p-8 rounded" x-data="app" method="POST" id="checkoutForm">
            @csrf
            @method('post')
            
            <!-- Form Grid -->
            <div class="space-y-8">
              <!-- Personal Information Section -->
              <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-6">Personal Information</h3>
                <div class="space-y-6">
                  <!-- Full Name -->
                  <div>
                    <label for="fullname" class="block text-sm font-medium text-gray-700 mb-2">
                      Full Name
                    </label>
                    <input type="text" name="name" id="fullname" required
                           class="w-full px-6 py-4 rounded border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary transition duration-200"
                           placeholder="Enter your full name"
                           value="{{ Auth::user()->name }}">
                  </div>

                  <!-- Date Selection -->
                  <!-- RESULT DATES FROM-UNTIL -->
            <div class="col-span-2 grid-cols-2 gap-y-6 gap-x-4 lg:gap-x-[30px] hidden">
              <!-- Result Date From [HIDDEN] -->
              <div class="flex flex-col col-span-1 gap-3">
                <label for="" class="text-base font-semibold text-dark">
                  From (result)
                </label>
                <input type="text" name="start_date" id="dateFrom" required
                       class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                       placeholder="Select Date" readonly x-model="dateFromYmd">
              </div>
              <!-- Result Date Until [HIDDEN] -->
              <div class="flex flex-col col-span-1 gap-3">
                <label for="" class="text-base font-semibold text-dark">
                  Until (result)
                </label>
                <input type="text" name="end_date" id="dateUntil" required
                       class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                       placeholder="Select Date" readonly x-model="dateToYmd">
              </div>
            </div>

            <!-- START: INPUT DATE -->
            <div class="col-span-2 grid grid-cols-2 gap-y-6 gap-x-4 lg:gap-x-[30px] relative"
                 @keydown.escape="closeDatepicker()" @click.outside="closeDatepicker()">
              <!-- Date From -->
              <div class="flex flex-col col-span-1 gap-3">
                <label for="" class="text-base font-semibold text-dark">
                  From
                </label>
                <input readonly type="text"
                       class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                       placeholder="Select Date" @click="endToShow = 'from'; init(); showDatepicker = true"
                       x-model="outputDateFromValue">
              </div>
              <!-- Date Until -->
              <div class="flex flex-col col-span-1 gap-3">
                <label for="" class="text-base font-semibold text-dark">
                  Until
                </label>
                <input readonly type="text"
                       class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                       placeholder="Select Date" @click="endToShow = 'to'; init(); showDatepicker = true"
                       x-model="outputDateToValue">
              </div>

              <!-- START: Date-Range Picker -->
              <div class="absolute p-5 mt-2 bg-white rounded-[18px] top-full border border-grey w-full z-50 shadow-[0_22px_50px_0_rgba(212,214,218,0.25)]"
                   x-show="showDatepicker" x-transition>
                <div class="flex flex-col items-center">

                  <div class="w-full mb-5">
                    <div class="flex items-center justify-center gap-1">
                      <button type="button"
                              class="inline-flex p-1 mr-2 transition duration-100 ease-in-out rounded-full cursor-pointer hover:bg-gray-200"
                              @click="if (month == 0) {year--; month=11;} else {month--;} getNoOfDays()">
                        <svg class="inline-flex w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                      </button>
                      <span x-text="MONTH_NAMES[month]" class="text-base font-semibold text-dark"></span>
                      <span x-text="year" class="text-base font-semibold text-dark"></span>
                      <button type="button"
                              class="inline-flex p-1 ml-2 transition duration-100 ease-in-out rounded-full cursor-pointer hover:bg-gray-200"
                              @click="if (month == 11) {year++; month=0;} else {month++;}; getNoOfDays()">
                        <svg class="inline-flex w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                      </button>
                    </div>
                  </div>

                  <div class="flex flex-wrap w-full mb-3 -mx-1">
                    <template x-for="(day, index) in DAYS" :key="index">
                      <div style="width: 14.26%" class="px-1">
                        <div x-text="day" class="text-sm font-medium text-center text-dark">
                        </div>
                      </div>
                    </template>
                  </div>

                  <div class="flex flex-wrap -mx-1">
                    <template x-for="blankday in blankdays">
                      <div style="width: 14.28%" class="p-1 text-sm text-center border border-transparent">
                      </div>
                    </template>
                    <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                      <div style="width: 14.28%">
                        <div @click="getDateValue(date, false)" @mouseover="getDateValue(date, true)" x-text="date"
                             class="p-1 text-sm leading-loose text-center transition duration-100 ease-in-out cursor-pointer"
                             :class="{
                                 'font-bold': isToday(date) == true,
                                 'bg-primary text-white rounded-l-full': isDateFrom(
                                     date) == true,
                                 'bg-primary text-white rounded-r-full': isDateTo(date) ==
                                     true,
                                 'bg-[#E2E1FF]': isInRange(date) == true
                             }">
                        </div>
                      </div>
                    </template>
                  </div>
                </div>
              </div>
              <!-- END: Date-Range Picker -->
            </div>
            <!-- END: INPUT DATE -->
              </div>

              <!-- Delivery Information Section -->
              <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-6">Delivery Details</h3>
                <div class="space-y-6">
                  <!-- Address -->
                  <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                      Delivery Address
                    </label>
                    <input type="text" name="address" id="address" required
                           class="w-full px-6 py-4 rounded border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary transition duration-200"
                           placeholder="Enter your delivery address">
                  </div>

                  <!-- City and Postal Code -->
                  <div class="grid grid-cols-2 gap-4">
                    <div>
                      <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                        City
                      </label>
                      <input type="text" name="city" id="city" required
                             class="w-full px-6 py-4 rounded border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary transition duration-200"
                             placeholder="Enter city name">
                    </div>
                    <div>
                      <label for="postCode" class="block text-sm font-medium text-gray-700 mb-2">
                        Postal Code
                      </label>
                      <input type="number" name="zip" id="postCode" required
                             class="w-full px-6 py-4 rounded border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary transition duration-200"
                             placeholder="Enter postal code">
                    </div>
                  </div>
                </div>

            

              <!-- Submit Button -->
              <button type="submit" 
                      class="w-full mt-3 bg-black hover:bg-primary/90 text-white py-4 px-8 rounded font-semibold transition duration-200 flex items-center justify-center gap-2 group">
                Continue
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition duration-200" 
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
              </button>
            </div>
          </form>
        </div>

     
      </div>
    </div>
  </section>

  <script src="/js/dateRangePicker.js"></script>
  <script>
    // on checkoutButton click, submit the form
    $('#checkoutButton').click(function() {
      $('#checkoutForm').submit();
    });
  </script>
</x-front-layout>