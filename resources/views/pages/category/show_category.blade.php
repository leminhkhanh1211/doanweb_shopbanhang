@extends('layout')
@section('content')

<div class="features_items"><!--features_items-->
	
		{{-- <!-- Nút chia sẻ của Facebook -->
<a href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}" target="_blank">
    <button class="btn btn-primary">Chia sẻ trên Facebook</button>
</a><!-- Nút thích của Facebook -->
<a href="https://www.facebook.com/plugins/like.php?href={{ $url_canonical }}&width=70&layout=button_count&action=like&size=small&share=false" target="_blank">
    <button class="btn btn-primary">Thích trên Facebook</button>
</a> --}}
						<div class="fb-share-button" data-href="http://localhost/shopbanhang" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
						<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>

						@foreach ($category_name as $key => $name) 
						<h2 class="title text-center">{{$name->category_name}}</h2>
						@endforeach
					
						@foreach($category_by_id as $key => $product)
						<a href="{{ url('/chi-tiet-san-pham/'.$product->product_slug) }}">
							
						
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<form>
                                                @csrf
                                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
											<input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}">
                                                <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                                <h2>{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h2>
                                                <p>{{$product->product_name}}</p>

                                             
                                             </a>
                                            <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
                                            </form>

										</div>
										
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Yêu Thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
									</ul>
								</div>
							</div>
						</div> 
						@endforeach 
						
					</div><!--features_items-->
					<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div>
					<ul class="pagination pagination-sm m-t-none m-b-none">
						{!!$category_by_id->links()!!}
					 </ul>
                  
@endsection