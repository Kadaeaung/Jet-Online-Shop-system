<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BrandResource;
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
        $result=BrandResource::collection($brands);
        $message='Brand retrieved successfully.';
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
               $validator =Validator::make($request->all(),['name'=>'required|string|max:255|unique:brand',
                                                    'logo'=>'required|mimes:jpeg,bmp,png,jpg']);


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
            $name=$request->name;
            $logo=$request->logo;
            //file Upload
                $imageName =time().'.'.$logo->extension();
            
                $logo->move(public_path('images/brand'),$imageName);
            
                $filepath ='images/brand/'.$imageName;
            
                        //data insert
            
                $brand =new Brand;
                $brand->name =$name;
                $brand->logo =$filepath;
                $brand->save();

                $status=200;
                $message='Brand create successful.';
                $result =new BrandResource($brand);

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
                 $brand=Brand::find($id);
        if(is_null($brand))
        {
            #404
            $status = 404;
            $message = 'Brand not found.';

            $response = [
                'status' => $status,
                'success' =>false,
                'message' =>$message
            ];
            return response()->json($response);
        }else
        {
                $status=200;
                $message='Brand retrieved successfully';
                $result= new BrandResource($brand);
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
           $brand=Brand::find($id);

        $name=$request->name;
        $newlogo=$request->logo;
        $oldlogo=$brand->logo;

        if ($request->hasfile('logo')) {

            $imageName =time().'.'.$newlogo->extension();
            
            $newlogo->move(public_path('images/brand'),$imageName);
            
            $filepath ='images/brand/'.$imageName;

            if (\File::exists(public_path($oldlogo))) {
                \File::delete(public_path($oldlogo));
            }
  
        }else{
            $filepath=$oldlogo;
        }

        //Data update
       
        $brand->name=$name;
        $brand->logo=$filepath;
        $brand->save();




        $status=200;
        $result= new BrandResource($brand);
        $message='Brand update successfully.';

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
        $brand=Brand::find($id);

        if (is_null($brand)) {
            #404
            $status=404;
            $message='Brand not foumd';

            $response=[
                'status'=>$status,
                'success'=>false,
                'message'=>$message,

            ];
            return response()->json($response);
        }

        else{

        $oldlogo=$brand->photo;

             if (\File::exists(public_path($oldlogo))) {
                \File::delete(public_path($oldlogo));
            }

            $brand->delete();

            $status=200;
        
        $message='Brand delete successfully.';

        $response=[
            'success'=>true,
            'status'=>$status,
            'message'=>$message,
           
        ];

        return response()->json($response);

            }
    }
}
