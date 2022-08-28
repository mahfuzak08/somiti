<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    /**
     * Display a listing of the brands.
     *
     * @return \Illuminate\Http\Response
     */
    public function brands()
    {
        $data["brands"] = Brands::all();
        return view('admin.inventory.brands')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * or
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function brandForm($id=null){
        $data = array();
        $data["brands"] = array();
        if($id !== null && $id > 0){
            $data["brands"] = Brands::where('id', $id)->get();
            $data["type"] = "edit";
        }
        else{
            $data["type"] = "add";
        }

        return view('admin.inventory.brand-add')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     * or
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function brandSave(Request $request)
    {
        $this->validate($request, [
            'brand_name' => ['required', 'string', 'max:255'],
        ]);
        
        $save_data = array(
            'brand_name' => $request->brand_name
        );
        try {
            if($request->id){
                Brands::where('id', $request->id)->update($save_data);
                $request->session()->flash('status','Brand update successfully.');
            }
            else{
                Brands::insert($save_data);
                $request->session()->flash('status','Brand added successfully.');
            }
        
            return redirect('/inventory/brands');
        } catch (\Illuminate\Database\QueryException $e) {
            // dd($e);
            return redirect('/inventory/brands/brandForm');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function brandRemove($id, Request $request){
        if(Brands::where('id', $id)->delete())
            $request->session()->flash("status", "Brand delete successfully!!!");
        else
            $request->session()->flash("status", "Brand delete error!!!");
        
        return redirect('/inventory/brands');
    }
    
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $data["categories"] = Categories::all();
        return view('admin.inventory.categories')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        //
    }
}
