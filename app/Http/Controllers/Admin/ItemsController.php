<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Type;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax()) {

            $query = Item::with('brand', 'type');

            return DataTables::of($query)
                ->addColumn('thumbnail', function ($item) {
                    return '<img src="' . $item->getThumbnailAttribute() . '" class="h-12 w-20  object-contain rounded" alt="' . $item->name . '"/>';
                })
                ->addColumn('action', function ($items) {
                    return '
                       <div class="flex w-full gap-2">
                        <a class = "focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900" href = "'. route('items.edit', $items->slug) .'" >Edit</a>
                        </a>    

                        <form class = "block w-full" action = "'. route('items.destroy', $items->id) .'" method = "POST">
                         <button 
                            type="button" 
                            onclick="deleteBrand(\''. route('items.destroy', $items->id) .'\')" 
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Delete
                        </button>

                        ' . method_field('delete') . csrf_field() . '
                        </form></div>
                    ';
                })
                ->rawColumns(['action', 'thumbnail'])
                ->make();

        }

        return view('admin.items.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $types = Type::all();
        return view('admin.items.create', compact('brands', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        {
            
            $data = $request->validate([
                'name' => 'required',
                'type_id' => 'required|integer|exists:types,id',
                'brand_id' => 'required|integer|exists:brands,id',
                'features' => 'nullable|string|max:500',
                'price' => 'required|numeric|min:0',
                'photos' => 'nullable|array',
                'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $data['slug'] = Str::slug($data['name']. '-'. Str::random(5));

            if ($request->hasFile('photos')) {

                $photos = [];

                foreach ($request->photos as $photo) {
                    $photoPath = $photo->store('assets/item', 'public');
                    array_push($photos, $photoPath);
                }                
            }

            $data['photos'] = json_encode($photos);

            Item::create($data);

            return redirect()->route('items.index')->with('success', 'Item created successfully');

        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $item = Item::where('slug', $slug)->firstOrFail();
        $brands = Brand::all();
        $types = Type::all();
        return view('admin.items.edit', compact('item', 'brands', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $data = $request->validate([
            'name' => 'required',
            'type_id' => 'required|integer|exists:types,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'features' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Cari item berdasarkan slug
        $item = Item::where('slug', $slug)->firstOrFail();
        
        
        if ($request->hasFile('photos')) {

            $photos = [];

            foreach ($request->photos as $photo) {
                $photoPath = $photo->store('assets/item', 'public');
                array_push($photos, $photoPath);
            }  
            
            $data['photos'] = json_encode($photos);
        }else{
            $data['photos'] = $item->photos;
        }
        // Update data item
        $item->update($data);
    
        return redirect()->route('items.index')->with('success', 'Item updated successfully');
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);
        return redirect()->route('items.index')->with('success', 'Item deleted successfully');
    }
}