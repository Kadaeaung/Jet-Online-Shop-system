<x-frontend>
	

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                	@foreach($categories as $category)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset($category->photo)}}">
                            <h5><a href="#">{{$category->name}}</a></h5>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Banner Begin -->
    <div class="banner mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="frontend/img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="frontend/img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">

                            	@foreach($latestitems as $latestitem)
                            	@php
                            	$photo =json_decode($latestitem->photo);
                            	$photo=$photo[0];
                                $latest_unitprice = $latestitem->price;
                                $latest_discount= $latestitem->discount;
                            	@endphp

                                <a href="#" class="latest-product__item">
                                	
                                    <div class="latest-product__item__pic">
                                        <img src="{{asset($photo)}}" alt=""style="width:150px; height: 120px; object-fit:cover">
                                    </div>

                                    <div class="latest-product__item__text">

                                        <h6>{{ Str::limit($latestitem->name),20}}</h6>
                                        @if($latest_discount)

                                        <span>{{ $latest_discount }}KS</span>

                                        <del class="text-muted">
                                            {{$latest_unitprice}}
                                        </del>
                                        @else

                                        <span>                                             {{$latest_unitprice}}KS</span>


                                        @endif



                                    </div>
                                   
                                </a>

                                 @endforeach
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                            	@foreach($topitems as $topitem)
                            	@php
                            	$photo =json_decode($topitem->photo);
                            	$photo=$photo[0];
                                $topitemunitprice=$topitem->price;
                                $topitemdiscount=$topitem->discount;
                            	@endphp
                                <a href="#" class="latest-product__item">
                                	
                                    <div class="latest-product__item__pic">
                                        <img src="{{asset($photo)}}" alt=""style="width:150px; height: 120px; object-fit:cover">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ Str::limit($topitem->name,20)}}</h6>

                                        @if($topitemdiscount)
                                        <span>{{$topitemdiscount}}</span>
                                        
                                    <del class="text-muted">
                                            {{$topitemunitprice }}
                                        </del>
                                        @else
                                  <span> {{$topitemunitprice}}KS</span>
                                        @endif

                                    </div>

                                </a>
                                @endforeach

                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Discount Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach($discountitems as $discountitem)
                                @php
                                $photo =json_decode($discountitem->photo);
                                $photo=$photo[0];
                                $price=$discountitem->price;
                                $discount=$discountitem->discount;
                                @endphp
                                <a href="#" class="latest-product__item">
                                    
                                    <div class="latest-product__item__pic">
                                        <img src="{{asset($photo)}}" alt=""style="width:150px; height: 120px; object-fit:cover">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ Str::limit($discountitem->name,20)}}</h6>

                                        @if($discount)
                                        <span>{{$discount}}</span>
                                        
                                    <del class="text-muted">
                                            {{$price}}
                                        </del>
                                        @endif
                                    </div>

                                </a>
                                @endforeach
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

</x-frontend>