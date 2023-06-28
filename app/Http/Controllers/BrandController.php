<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Brand::all();
         return view('backend.brand.list',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.brand.new');
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

         $validator= $request->validate(['name' => ['required','string','max:255','unique:items'],'logo'=>'required|mimes:jpeg,bmp,png,jpg']);

         if($validator)
         {
        $name= $request->name;
        $logo=  $request->logo;
          //dd($name);
       
               // dd($logo);
       
                $logoName=time().'.'.$logo->extension();
               //dd($imageName);
                $logo->move(public_path('images/brand'),$logoName);
       
                $filepath= 'images/brand/'.$logoName;
       
               // //Data Insert
               $brand = new Brand;
               $brand->name = $name;
               $brand->logo= $filepath;
               $brand->save();
               return redirect()->route('backside.brand.index')->with("successMsg",'New Brand is ADDED in your data');
           }
           else{
            return redirect::back()->widthErrors($validator);
           }
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
    public function edit($id)
    {
        //
        $brand= Brand::find($id);
       // dd($category);
        return view('backend.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $name= $request->name;
        $newlogo = $request->logo;
        $oldlogo = $request->oldlogo;
        //dd($name);
        //dd($newphoto);
        //dd($oldphoto);
        if ($request->hasFile('logo')) {

             $imageName=time().'.'.$newlogo->extension();
               //dd($imageName);
               $newlogo->move(public_path('images/brand'),$imageName);
       
               $filepath= 'images/brand/'.$imageName;

               if(\File::exists(public_path($oldlogo)))
               {
                \File::delete(public_path($oldlogo));
               }
        }else
        {
                $filepath=$oldlogo;
         }

         $brand=Brand::find($id);
         $brand->name = $name;
         $brand->logo = $filepath;
         $brand->save();

         return redirect()->route('backside.brand.index')->with("successMsg",'Existing Brand is Updated in your data');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         $brand= Brand::find($id);
        $brand->delete();

        return redirect()->route('backside.brand.index')->with("successMsg",'Existing Brand is DELETED in your data');
    }
    }

