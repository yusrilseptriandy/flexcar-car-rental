<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Requests\BrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax()) {

            $query = Brand::query();

            return DataTables::of($query)
                ->addColumn('action', function ($brand) {
                    return '
                       <div class="flex w-full gap-2">
                        <a class = "focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900" href = "'. route('brands.edit', $brand->slug) .'" >Edit</a>
                        </a>    

                        <form class = "block w-full" action = "'. route('brands.destroy', $brand->id) .'" method = "POST">
                         <button 
                            type="button" 
                            onclick="deleteBrand(\''. route('brands.destroy', $brand->id) .'\')" 
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Delete
                        </button>

                        ' . method_field('delete') . csrf_field() . '
                        </form></div>
                    ';
                })
                ->rawColumns(['action'])
                ->make();

        }

        return view('admin.brands.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']. '-'. Str::random(5));
        Brand::create($data);
        return redirect()->route('brands.index')->with('success', 'Brand created successfully');
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
        $brand = Brand::where('slug', $slug)->firstOrFail();
        return view('admin.brands.edit', compact('brand'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']. '-'. Str::random(5));
        $brand->update($data);
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully');
    }
}
