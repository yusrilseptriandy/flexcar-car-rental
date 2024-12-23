<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            <a href="" class="flex items-center" onclick="window.history.go(-1); return false;">
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
                </svg>
                Edit Brand
            </a>
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('brands.update', $brand->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold">Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $brand->name) }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                            required
                        >
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="focus:outline-none text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-blue-300 font-medium rounded text-sm px-5 py-2.5">
                            Update Brand
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
