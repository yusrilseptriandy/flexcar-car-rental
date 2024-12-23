<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <x-slot name="script">
    
        <script>
           let datatable = $('#dataTable').DataTable({
               processing: true,
               serverSide: true,
               stateSave: true,
               ajax: "{!! url()->current() !!}",
               
             
               columns: [
                   {data: 'id', 
                    name: 'id'},

                    {data: 'thumbnail', 
                    name: 'thumbnail',
                    orderable: false, 
                    searchable: false, },

                   {data: 'name', 
                    name: 'name'},

                    {data: 'price', 
                    name: 'price',
                    render: function(data, type, row) {
                        return 'Rp ' + data.toLocaleString();
                    }
                },

                   {data: 'type.name', 
                    name: 'type.name',},

                    {data: 'brand.name', 
                     name: 'brand.name',},

                   {data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false, 
                    width : '15%'},
               ]
           })
        </script>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('items.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    + Create Item
                </a>
            </div>

            <div class="overflow-hidden shadow bg-white rounded-xl ">
                <div class="px-4 py-5 bg-white">
                    <table id="dataTable">
                        <thead>
                            <tr class="text-left">
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Type</th>
                                <th>Brand</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>