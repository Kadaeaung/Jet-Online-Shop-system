<x-frontend>
        <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg subtitle">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2> Promotion </h2>
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
                <div class="col-12">
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
                        @foreach($promotionitems as $promotionitem)
                                @php
                                $photo =json_decode($promotionitem->photo);
                                $photo=$photo[0];
                                $price=$promotionitem->price;
                                $discount=$promotionitem->discount;
                                $name=$promotionitem->name;
                                $codeno=$promotionitem->codeno;
                                $id=$promotionitem->id;
                                @endphp
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{asset($photo)}}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                        
                                        <li><a href="javascript:void(0)" class="addtocartBtn" data-id="{{$id}}" data-name="{{$name}}" data-codeno="{{$codeno}}" data-unitiprice="{{$price}}" data-discount="{{$discount}}" data-photo="{{$photo}}"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__discount__item__text">
                                    <h5><a href="#">{{$name}}</a></h5>

                                    <div class="product__item__price">
                                    @if($discount)
                                        {{$discount}}
                                        
                                    <del class="text-muted">
                                        <span>{{$price}}</span>

                                        </del>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    {!!$promotionitems->links()!!}
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

</x-frontend>