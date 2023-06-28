<x-frontend>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg subtitle">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        @php
                            $sname =$subcategory->name;
                            @endphp
                        <h2> {{$sname}} </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                                    <ul class="list-group">
                                @foreach($subcategories as $subcategory)

                                @php
                                $sname=$subcategory->name;
                                $id=$subcategory->id;
                                @endphp
                                <li class="list-group-item "><a href="{{route('subcategory',$id)}}">{{$sname}}</a>
                                 </li>
                                 @endforeach
                                
                            </ul>
                        </div>

                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">

                                @foreach($latestitems as $latestitem)
                                @php
                                $id=$latestitem->id;
                                $photo =json_decode($latestitem->photo);
                                $photo=$photo[0];
                                $latest_unitprice = $latestitem->price;
                                $latest_discount= $latestitem->discount;
                                @endphp

                                <a href="{{route('detail',$id)}}" class="latest-product__item">
                                    
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
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0"> A - Z </option>
                                        <option value="0"> Z - A </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>16</span> Products found</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($subcategoryitems as $subcategoryitem)
                        @php

                        $id=$subcategoryitem->id;
                        $name=$subcategoryitem->name;
                        $photos = json_decode($subcategoryitem->photo);
                        $photo=$photos[0];
                        $price=$subcategoryitem->price;
                        $discount=$subcategoryitem->discount;
                        @endphp
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{asset($photo)}}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="{{route('detail',$id)}}"><i class="fa fa-eye"></i></a></li>
                                        
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__discount__item__text">
                                    <h5><a href="#">{{$name}}</a></h5>
                                    <div class="product__item__price">{{$discount}} <span>{{$price}}</span></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
</x-frontend>