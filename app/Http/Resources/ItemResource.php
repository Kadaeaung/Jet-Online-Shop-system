<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BrandResource;
use App\Brand;


class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        $baseurl= URL('/');
        $photo = json_decode($this->photo);
        $photos = $baseurl.'/'.$photo[0];
        return ['Item_id' =>$this->id,
                'Item_name' =>$this->name,
                'codeno' =>$this->codeno,
                'photo' => $photos,
                'photos' =>$photo,
                'Item_Price' =>$this->price,
                'Item_Discount' =>$this->discount,
                'subcategory_id' =>$this->subcategory_id,
                'categoy' =>new BrandResource(Brand::find($this->brand_id)),
                'created_at' =>$this->created_at->format('d-m-Y'),
                'updated_at' =>$this->updated_at->format('d-m-Y'),
               ];
    }
}
