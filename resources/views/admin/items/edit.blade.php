<x-app-layout>
<x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            <a href="" class="flex items-center " onclick="window.history.go(-1) ; return false;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
                    </svg>

                    Edit Item
            </a>
        </h2>
    </x-slot>

    <div class="mt-3">
        

    <form class="max-w-4xl p-8 rounded-md mx-auto  bg-white" action="{{ route('items.update', $item->slug) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama <span class="text-red-500">*</span></label>
            <input 
            value="{{ old('name', $item->name) }}" 
            type="text" 
            name="name" 
            id="name"
                required 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                placeholder="Innova Reborn"  />
                
        @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        </div>

        <div class="mb-5">
            <label for="name_brand" class="block mb-2 text-sm font-medium text-gray-900">Pilih Brand <span class="text-red-500">*</span></label>

            <select 
            name="brand_id" id="brand_id"
            required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        
            <option 
                value="" 
                disabled 
                selected 
                class="text-gray-400">-- Pilih Merek / Brand --
            </option>

            @foreach ($brands as $brand)
            <option 
                value="{{ $brand->id }}" 
                {{ 
                    old('brand_id', $item->brand_id) == $brand->id ? 'selected' : '' 
                }}>
                {{ $brand->name }}
             </option>
            @endforeach

            </select>
        
                
            @error('name_brand')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="name_type" class="block mb-2 text-sm font-medium text-gray-900">Pilih Type <span class="text-red-500">*</span></label>

            <select 
            name="type_id" id="type_id"
            required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        
            <option value="" disabled selected class="text-gray-400">-- Pilih Type --</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ old('type_id', $item->type_id) == $type->id ? 'selected' : '' }}>
                {{ $type->name }}
            </option>
            @endforeach

            </select>
        
                
            @error('name_brand')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Harga <span class="text-red-500">*</span></label>
            <input value="{{ old('price', $item->price) }}" 
            required
            type="number" 
            name="price" 
            id="price"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
             />
                <span class="text-xs text-gray-800 italic pl-2">Harga ini merupakan sewa per hari</span>
            @error('features')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="features" class="block mb-2 text-sm font-medium text-gray-900">Fitur</label>
            <input 
            value="{{ old('features', $item->features) }}" 
            type="text" 
            name="features" 
            id="features"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
             />
                
        @error('features')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        </div>

        <div class="mb-5">
            <label for="photos" class="block mb-2 text-sm font-medium text-gray-900">Foto</label>
            <input value="{{ old('photos') }}" 
                type="file" 
                name="photos[]" 
                id="features"
                multiple
                accept="image/jpeg, image/png, image/jpg"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
             />
             
                
        @error('features')
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

    <script>
    function formatRupiah(element) {
        let value = element.value.replace(/\D/g, ''); 
        let formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(value);
        element.value = formatted.replace('Rp', 'Rp '); 
    }
</script>
</x-app-layout>