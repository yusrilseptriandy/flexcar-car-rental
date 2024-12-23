<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bookings') }}
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
                   {data: 'id', name: 'id'},
                   {data: 'name', name: 'name'},
                   {data: 'item.name', name: 'item.name'},
                   {data: 'start_date', name: 'start_date'},
                   {data: 'end_date', name: 'end_date'},
                   {data: 'total_price', name: 'total_price', 
                    render: function(data, type, row) {
                        return 'Rp ' + data.toLocaleString();
                    }
                   },
                   {data: 'payment_method', name: 'payment_method'},
                   {data: 'status', name: 'status'},
                   {data: 'action', name: 'action', orderable: false, searchable: false, width : '15%'},
               ]
           })
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow rounded-xl ">
                <div class="px-4 py-5 bg-white">
                    <table id="dataTable">
                        <thead>
                            <tr class="text-left">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Item</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Price</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
