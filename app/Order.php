<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    //
    use SoftDeletes;

   protected $fillable=[

   	'orderdate','voucherno','total','note','status','user_id'

   ];
      public function item(){
    	return $this->belongsToMany('App\Item','orderdetails','order_id','item_id')->withPivot('qty') -> withTimestamps();;
    	
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }


}
