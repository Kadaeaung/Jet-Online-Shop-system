<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use App\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
           $items = Item::all();
        $result=ItemResource::collection($items);
        $message='Item retrieved successfully.';
        $status=200;
        $response= [
            'status' =>$status,
            'success' => true,
            'message' => $message,
            'data' => $result,
        ];
        return response()->json($response);
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
         $validator =Validator::make($request->all(),['name'=>'required|string|max:255|unique:item']
                                                    );


        if ($validator->fails()) {
            $status=400;
            $message='Validation Error.';

            $response=[
                'status'=>$status,
                'success'=>false,
                'message'=>$message,
                'data'=>$validator->errors(),
            ];
            return response()->json($response);
        }
        else{ 

            $name = $request->name;
            $codeno=$request->codeno;
            $unitprice = $request->price;
            $discount = $request->discount;
            $description = $request->description;
            $brand = $request->brand_id;
            $subcategory = $request->subcategory_id;

            $photo=$request->photo;


            $imageName =time().'.'.$photo->extension();
            
                $photo->move(public_path('images/item'),$imageName);
            
                $filepath ='images/item/'.$imageName;

            

       //data insert
            
                $item =new Item;
                $item->name =$name;
                $item->price=$unitprice;
                $item->discount=$discount;
                $item->description=$description;
                $item->codeno=$codeno;
                $item->brand_id=$brand;
                $item->subcategory_id=$subcategory;

                $item->photo =$filepath;
                $item->save();


                $status=200;
                $message='Item create successful.';
                $result =new ItemResource($item);

                $response=[
                    'success'=>true,
                    'status'=>$status,
                    'message'=>$message,
                    'data'=>$result,
                ];

                return response()->json($response);

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
         $item=Item::find($id);
        if(is_null($item))
        {
            #404
            $status = 404;
            $message = 'Item not found.';

            $response = [
                'status' => $status,
                'success' =>false,
                'message' =>$message
            ];
            return response()->json($response);
        }else
        {
                $status=200;
                $message='Item retrieved successfully';
                $result= new ItemResource($subcategory);
    $response = [
                'status' => $status,
                'success' =>true,
                'message' =>$message,
                'data' =>$result
            ];
            return response()->json($response);
        }
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
          $item=Item::find($id);

        $name = $request->name;
            $codeno=$request->codeno;
            $unitprice = $request->price;
            $discount = $request->discount;
            $description = $request->description;
            $brand = $request->brand_id;
            $subcategory = $request->subcategory_id;

            $newphoto=$request->photo;
            $oldphoto=$item->oldphoto;


        if ($request->hasfile('photo')) {

            $imageName =time().'.'.$newphoto->extension();
            
            $newphoto->move(public_path('images/category'),$imageName);
            
            $filepath ='images/category/'.$imageName;

            if (\File::exists(public_path($oldphoto))) {
                \File::delete(public_path($oldphoto));
            }
  
        }else{
            $filepath=$oldphoto;
        }

        //Data update
       

                $item->name =$name;
                $item->price=$unitprice;
                $item->discount=$discount;
                $item->description=$description;
                $item->codeno=$codeno;
                $item->brand_id=$brand;
                $item->subcategory_id=$subcategory;

                $item->photo =$filepath;
                $item->save();


        $status=200;
        $result= new ItemResource($item);
        $message='Item update successfully.';

        $response=[
            'success'=>true,
            'status'=>$status,
            'message'=>$message,
            'data'=>$result,
        ];
        return response()->json($response);
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
            $item=Item::find($id);

        if (is_null($item)) {
            #404
            $status=404;
            $message='Item not foumd';

            $response=[
                'status'=>$status,
                'success'=>false,
                'message'=>$message,

            ];
            return response()->json($response);
        }

        else{

        $oldphoto=$item->photo;

             if (\File::exists(public_path($oldphoto))) {
                \File::delete(publGETic_path($oldphoto));
            }

            $item->delete();

            $status=200;
        
        $message='Item delete successfully.';

        $response=[
            'success'=>true,
            'status'=>$status,
            'message'=>$message,
           
        ];

        return response()->json($response);

            }

    }
}
