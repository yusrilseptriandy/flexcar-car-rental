<x-front-layout>
     <!-- Hero -->
     <!-- <section class="  flex justify-center items-center relative">
        <form action="" class="flex justify-center items-center w-full">
        <div class="w-full max-w-sm min-w-[200px]">
                <div class="relative flex items-center">
            
                <input
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-10 pr-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                placeholder="Find your car..." 
                />
                
                <button
                class="rounded-md bg-black py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                type="button"
                >
                Search
                </button> 
            </div>
            </div>            
        </form>
        </section> -->

        <!-- Popular Cars -->
        <section class="p-6">
            <div class="container relative py-[100px]">
                <header class="mb-[30px]">
                    <h2 class="font-bold text-dark text-[26px] mb-1">
                        Popular Cars
                    </h2>
                </header>

                <!-- Cars -->
               

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
                @foreach ($datas as $data)
                    <!-- Card -->
                     <div class=" bg-white shadow rounded-lg p-2 border">
                    <div>
                        <img src= "{{ $data->thumbnail }}" class="rounded"/>
                    </div>
                    <div class="p-4">
                        <h6 class="mb-2 text-slate-800 text-xl font-semibold">
                        {{ $data->name }}
                        </h6>
                        <p class="text-slate-600 leading-normal font-light">
                        {{ $data->features }}
                        </p>
                        <p class="text-green-800 leading-normal font-bold">Rp. {{ number_format($data->price, 0, ',', '.') }} /day</p>
                    </div>
                    <a href="{{ route('front.detail', $data->slug) }}" class="px-4 pb-4 pt-0 mt-2">
                        <button class="rounded-md bg-black py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        Details
                        </button>
                    </a>
                    </div>  
                @endforeach
                    
                </div>

            </div>
        </section>

        
   
</x-front-layout>