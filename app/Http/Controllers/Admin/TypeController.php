<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $query = Type::query();

            return DataTables::of($query)
                ->addColumn('action', function ($type) {
                    return '
                       <div class="flex w-full gap-2">
                        <a class = "focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900" href = "'. route('type.edit', $type->slug) .'" >Edit</a>
                        </a>    

                        <form class = "block w-full" action = "'. route('type.destroy', $type->id) .'" method = "POST">
                         <button 
                    type="button" 
                    onclick="deleteBrand(\''. route('type.destroy', $type->id) .'\')" 
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

        return view('admin.type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']. '-'. Str::random(5));
        Type::create($data);
        return redirect()->route('type.index')->with('success', 'Type created successfully');
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
        $type = Type::where('slug', $slug)->firstOrFail();
        return view('admin.type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeRequest $request, Type $type)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']. '-'. Str::random(5));
        $type->update($data);
        return redirect()->route('type.index')->with('success', 'Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('type.index')->with('success', 'Type deleted successfully');
    }
}
