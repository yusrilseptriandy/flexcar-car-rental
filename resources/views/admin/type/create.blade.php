<x-app-layout>
<x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            <a href="" class="flex items-center " onclick="window.history.go(-1) ; return false;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
                    </svg>

                    Buat Type
            </a>
        </h2>
    </x-slot>

    <div class="mt-3">
        

    <form class="max-w-sm mx-auto" action="{{ route('type.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
            <input type="text" name="name" id="name" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                placeholder="MPV"  />
                
        @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        </div>

        <button 
            type="submit" 
            class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center">
            Buat
        </button>

    </form>


    </div>
</x-app-layout>