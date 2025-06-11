@extends('layout')
@section('content')
@foreach($product_details as $key => $value)
    

<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
        <img src="{{ url('/public/uploads/product/'.$value->product_image) }}" alt="" />
           
        </div>
        
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{ $value->product_name}}</h2>
            <p>Mã ID: {{ $value->product_id }}</p>
            <img src="images/product-details/rating.png" alt="" />
            <form action="{{ url('/save-cart') }}" method="POST">
                @csrf
                <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
            <span>
                <span>{{number_format($value->product_price,0,',','.').' VNĐ'}}</span>
                <label>Số lượng:</label>
                <input name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}}" value="1" />
                <input name="productid_hidden" type="hidden" min="1" value="{{ $value->product_id }}" /><br>
                <button type="button"  class="btn btn-default add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
                
                
            </span>
            </form>
            <p><b>Tình trạng:</b> Còn hàng</p>
            <p><b>Điều kiện:</b> Mới 100%</p>
            <p><b>Số lượng kho còn:</b> {{$value->product_quantity}}</p>
            <p><b>Thương hiệu:</b> {{ $value->brand_name }}</p>
            <p><b>Danh mục:</b> {{ $value->category_name }}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->


<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li ><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
           
            <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane " id="details" >
            {{-- <p>{!!$value->product_desc!!}</p> --}}
            <p>{{ strip_tags($value->product_desc) }}</p>
            
            
            
        </div>
        
        <div class="tab-pane " id="companyprofile" >
           
            {{-- <p>{!!$value->product_content!!}</p> --}}
            <p>{{ strip_tags($value->product_content) }}</p>
            
            
        </div>
        
       
        
        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>Admin</a></li>
                    {{-- <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li> --}}
                    <li><a href=""><i class="fa fa-calendar-o"></i>25 DEC 2024</a></li>
                </ul>
                <style type="text/css">
                 .style_comment{
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    background: #F0F0E9;
                    
                 }

                </style>
                <form>
                    @csrf
                    <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{ $value->product_id }}">
                    <div id="comment_show"></div>
                </form>
                
                <p><b>Viết đánh giá của bạn</b></p>
                
                <form action="#">
                   
                        <input style="width: 100%; margin-left:0 " type="text" class="comment_name"  placeholder="Tên bình luận"/>
                       
                    
                    <textarea name="comment" class="comment_content" placeholder="Nội dung bình luận"></textarea>
                    <div id="notify_comment"></div>
                    {{-- <b>Đánh giá sao: </b> <img src="images/product-details/rating.png" alt="" /> --}}
                    <button type="button" class="btn btn-default pull-right send-comment">
                        Gửi bình luận
                    </button>
                   
                </form>
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
        @foreach($relate as $key => $lienquan)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                         <div class="single-products">
                            <div class="productinfo text-center product-related">
                               
                        <form>
                            @csrf
                        <input type="hidden" value="{{$lienquan->product_id}}" class="cart_product_id_{{$lienquan->product_id}}">
                        <input type="hidden" id="wishlist_productname{{$lienquan->product_id}}" value="{{$lienquan->product_name}}" class="cart_product_name_{{$lienquan->product_id}}">
                        <input type="hidden" value="{{$lienquan->product_quantity}}" class="cart_product_quantity_{{$lienquan->product_id}}">
                        <input type="hidden" value="{{$lienquan->product_image}}" class="cart_product_image_{{$lienquan->product_id}}">
                        <input type="hidden" id="wishlist_productprice{{$lienquan->product_id}}" value="{{$lienquan->product_price}}" class="cart_product_price_{{$lienquan->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$lienquan->product_id}}">

                        <a id="wishlist_producturl{{$lienquan->product_id}}" href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_slug)}}">
                            <img id="wishlist_productimage{{$lienquan->product_id}}" src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
                            <h2>{{number_format($lienquan->product_price,0,',','.').' '.'VNĐ'}}</h2>
                            <p>{{$lienquan->product_name}}</p>

                         
                         </a>
                         <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$lienquan->product_id}}" name="add-to-cart">
                            
                        
                        </form>
                            </div>
                          
                        </div>




                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <style type="text/css">
                                    ul.nav.nav-pills.nav-justified li {
                                        text-align: center;
                                        font-size: 13px;
                                    }
                                    .button_wishlist {
                                        border: none;
                                        background: #fff;
                                        color: #3BAFAB;
                                    }
                                    ul.nav.nav-pills.nav-justified li {
                                        color: #3BAFAB;
                                    }
                                    .button_wishlist span:hover {
                                        color: #FF980F;
                                    }
                                    .button_wishlist:focus {
                                        border: none;
                                        outline: none;
                                    }
                                </style>
                            
                        
                            <li>
                                <i class="fa fa-plus-square"></i>
                                <button class="button_wishlist" id="{{ $lienquan->product_id }}" onclick="add_wistlist(this.id);">
                                    <span>Yêu thích</span>
                                </button>
                            </li>
                          
                        </ul>
                        </div>
                    </div>
                </div>
        @endforeach		

            
            </div>
                
        </div>
                
    </div>
</div><!--/recommended_items-->
@endsection