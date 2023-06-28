<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Township;

class TownshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $townships=Township::all();
         return view('backend.township.list',compact('townships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $townships = Township::all();
        return view('backend.township.new',compact('townships'));
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
         $validator= $request->validate(['name' => ['required','string','max:255','unique:townships']]);


        if($validator)
{        $name=$request->name;
        $price=$request->price;

        //Data Insert

        $township=new Township();
        $township->name=$name;
        $township->price=$price;
        $township->save();

        return redirect()->route('backside.township.index')->with("successMsg",'New Township is ADDED is your data');
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
        $township = Township::find($id);
        

        
        return view('backend.township.edit',compact('township'));
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
                     $validator = $request->validate([
            'name' => ['required', 'string', 'max:255']]);

        if($validator)
        {
            $name = $request->name;
            $price = $request->price;

            // Data insert
            $township = Township::find($id);
            $township->name = $name;
            $township->price = $price;
            $township->save();

            return redirect()->route('backside.township.index')->with('successMsg','New Township is ADDED in your data');
        }
        else{
            return Redirect::back()->withErrors($validator);

        }
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
                 $township= Township::find($id);
        $township->delete();

        return redirect()->route('backside.township.index')->with("successMsg",'Existing Township is DELETED in your data');
    }
}
