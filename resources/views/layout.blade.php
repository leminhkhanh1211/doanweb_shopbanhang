
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="{{ $meta_desc }}">
	<meta name="keywords" content="{{ $meta_keywords }}"/>
	<meta name="robots" content="INDEX, FOLLOW"/>
	<link rel="canonical" href="{{ $url_canonical }}" />
    <meta name="author" content="">
	<link rel="icon" type="image/x-icon" href="" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	  {{-- <meta property="og:image" content="{{$image_og}}" />   --}}
      {{-- <meta property="og:site_name" content="http://localhost/shopbanhang" />
      <meta property="og:description" content="{{$meta_desc}}" />
      <meta property="og:title" content="{{$meta_title}}" />
      <meta property="og:url" content="{{$url_canonical}}" />
      <meta property="og:type" content="website" /> --}}
    <!--//-------Seo--------->

    <title>{{ $meta_title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">

    <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/prettyPhoto.css') }}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/price-range.css') }}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/responsive.css') }}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/sweetalert2.min.css') }}" rel="stylesheet"> 
	

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ asset('public/frontend/images/ico/favicon.ico') }}">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	
	<header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href=""><i class="fa fa-phone"></i> 0932023992</a></li>
                                <li><a href="https://www.facebook.com/profile.php?id=61552035991952"><i class="fa fa-facebook"></i> decorphong.com</a></li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="{{asset('public/frontend/images/logodecor.png')}}" style="width: 100px; height: 50px;" alt="" /></a>
                        </div>
                       
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                               
                               
                                <?php
                                   $customer_id = Session::get('customer_id');
                                   $shipping_id = Session::get('shipping_id');
                                   if($customer_id!=NULL && $shipping_id==NULL){ 
                                 ?>
                                  <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                
                                <?php
                                 }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                 ?>
                                 <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                 <?php 
                                }else{
                                ?>
                                 <li><a href="{{URL::to('/dang-nhap')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                 }
                                ?>
                                

                                <li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                <?php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){ 
                                 ?>
                                  <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                
                                <?php
                            }else{
                                 ?>
                                 <li><a href="{{URL::to('/dang-nhap')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                 <?php 
                             }
                                 ?>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category as $key => $danhmuc)
                                        <li><a href="{{URL::to('/danh-muc/'.$danhmuc->slug_category_product)}}">{{$danhmuc->category_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										@foreach($category_post as $key => $danhmucbaiviet)
                                       <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}">{{ $danhmucbaiviet->cate_post_name }}</a></li>
										@endforeach
                                    </ul>
                                    
                                </li> 
                                <li><a href="{{URL::to('/gio-hang')}}">Giỏ hàng</a></li>
                                <li><a href="{{URL::to('/lien-he')}}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    {{-- <div class="col-sm-5">
                        <form action="{{URL::to('/tim-kiem')}}" method="POST">
                            {{csrf_field()}}
                        <div class="search_box pull-right">
                            <input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm"/>
                            <input type="submit" style="margin-top:0;color:#666" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">
                        </div>
                        </form>
                    </div> --}}
					<div class="col-sm-5">
						<div class="search_box pull-right">
							<form action="{{ url('/tim-kiem') }}" method="POST" class="search-form">
								@csrf
								<div class="input-group">
									<input type="text" class="form-control" name="keywords_submit" placeholder="Tìm kiếm sản phẩm...">
									<div class="input-group-append">
										<button class="btn btn-primary" type="submit" name="search_items">
											<i class="fa fa-search"></i> <!-- Icon tìm kiếm -->
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<section id="slider">
		<div class="container">
			<div id="slider-carousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
					<li data-target="#slider-carousel" data-slide-to="1"></li>
					<li data-target="#slider-carousel" data-slide-to="2"></li>
				</ol>
	
				<!-- Carousel Items -->
				<div class="carousel-inner">
					
					@php 
                            $i = 0;
                        @endphp
                        @foreach($slider as $key => $slide)
                            @php 
                                $i++;
                            @endphp
                            <div class="item {{$i==1 ? 'active' : '' }}">
                               
                                <div class="slider-image">
                                    <img alt="{{$slide->slider_desc}}" src="{{asset('public/uploads/slider/'.$slide->slider_image)}}" class="img img-responsive">
                                   
                                </div>
                            </div>
                        @endforeach  
				</div>
	
				<!-- Left and right controls -->
				<a href="#slider-carousel" class="carousel-control-prev" data-slide="prev">
					<i class="fa fa-chevron-left"></i>
				</a>
				<a href="#slider-carousel" class="carousel-control-next" data-slide="next">
					<i class="fa fa-chevron-right"></i>
				</a>
				
			</div>
		</div>
	</section>
	
    
	{{-- <section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục sản phẩm</h2>
						<div class="panel-group category-products" id="accordian">
							@foreach($category as $key => $cate)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="{{ url('/danh-muc-san-pham/'.$cate->slug_category_product) }}">
											<i class="fa fa-tags"></i> {{$cate->category_name}}
										</a>
									</h4>
								</div>
							</div>
							@endforeach
						</div>
						
						<div class="brands_products">
							<h2>Thương hiệu sản phẩm</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									@foreach($brand as $key => $brand)
									<li>
										<a href="{{ url('/thuong-hieu-san-pham/'.$brand->brand_slug) }}">
											<i class="fa fa-star"></i> {{$brand->brand_name}}
										</a>
									</li>
									@endforeach
								</ul>
							</div>
						</div>
						<!--/brands_products-->
						
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					
					@yield('content')
					
					
					
					
				</div>
			</div>
		</div>
	</section> --}}
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2 id="toggle-category">Danh mục sản phẩm</h2>
						
						<div class="panel-group category-products" id="category-list" style="max-height: 0; opacity: 0;">
							@foreach($category as $key => $cate)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="{{ url('/danh-muc-san-pham/'.$cate->slug_category_product) }}">
											<i class="fa fa-tags"></i> {{$cate->category_name}}
										</a>
									</h4>
								</div>
							</div>
							@endforeach
						</div>
						<div class="brands_products">
							<h2 id="toggle-brand">Thương hiệu sản phẩm</h2>
							<div class="panel-group brands" id="brand-list" style="max-height: 0; opacity: 0;">
								@foreach($brand as $key => $brand)
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a href="{{ url('/thuong-hieu-san-pham/'.$brand->brand_slug) }}">
												<i class="fa fa-star"></i> {{ $brand->brand_name }}
											</a>
										</h4>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<div class="brands_products">
							<h2>Sản phẩm yêu thích</h2>
							<div class="brands-name">
									<div id="row_wishlist" class="row_wishlist" style="background-color: #fff ; padding-bottom:50px;">

									</div>
							
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-9 padding-right">
					@yield('content')
				</div>
			</div>
		</div>
	</section>
	
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>D</span>ecor shop</h2>
							
						</div>
					</div>
					
					
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Dịch vụ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Hỗ trợ trực tuyến</a></li>
								<li><a href="#">Liên hệ với chúng tôi</a></li>
								<li><a href="#">Tình trạng đơn hàng</a></li>
								<li><a href="#">Thay đổi vị trí</a></li>
								<li><a href="#">Câu hỏi thường gặp</a></li>
							</ul>

						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Danh mục</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Gương</a></li>
								<li><a href="#">Bàn</a></li>
								<li><a href="#">Ghế</a></li>
								<li><a href="#">Đồng hồ</a></li>
								<li><a href="#">Đèn</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Chính sách</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Điều khoản sử dụng</a></li>
								<li><a href="#">Chính sách bảo mật</a></li>
								<li><a href="#">Chính sách hoàn tiền</a></li>
								<li><a href="#">Hệ thống thanh toán</a></li>
								<li><a href="#">Hệ thống hỗ trợ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Về Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Thông tin công ty</a></li>
								<li><a href="#">Cơ hội nghề nghiệp</a></li>
								<li><a href="#">Vị trí cửa hàng</a></li>
								<li><a href="#">Chương trình cộng tác</a></li>
								<li><a href="#">Bản quyền</a></li>
							</ul>
						</div>
					</div>
					
					
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2024 Decor Shop</p>
					
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	


   <!-- Đảm bảo jQuery được tải trước Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('public/frontend/js/price-range.js') }}"></script>
<script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('public/frontend/js/main.js') }}"></script>
<script src="{{ asset('public/frontend/js/sweetalert2.all.min.js') }}"></script>

{{-- <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css
" rel="stylesheet"> --}}



{{-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=2339123679735877&autoLogAppEvents=1"></script> --}}
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v21.0"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
 $(document).ready(function () {
    load_comment();

    function load_comment() {
        var product_id = $('.comment_product_id').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: '{{ url("/load-comment") }}',
            method: 'POST',
            data: { product_id: product_id, _token: _token },
            success: function (response) {
                $('#comment_show').html(response.output); // Hiển thị nội dung bình luận
            },
            error: function (xhr, status, error) {
                console.error("Lỗi: " + error); // Debug nếu có lỗi
            }
        });
    }
    $('.send-comment').click(function(){
        var product_id = $('.comment_product_id').val();
        var comment_name = $('.comment_name').val();
        var comment_content = $('.comment_content').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: '{{ url("/send-comment") }}',
            method: 'POST',
            data: { product_id: product_id ,comment_name:comment_name , comment_content:comment_content, _token: _token},
            success: function (response) {
                $('#notify_comment').html('<span class="text text-success">Thêm bình luận thành công,bình luận đang chờ duyệt</span>');
                load_comment();
                $('#notify_comment').fadeOut(9000);
                $('.comment_name').val('');
                $('.comment_content').val('');
            },
            error: function (xhr, status, error) {
                console.error("Lỗi: " + error); // Debug nếu có lỗi
            }
        });
        
    })
    
});

</script>


<script type="text/javascript">
    $(document).ready(function () {
        $('.send_order').click(function () {
            Swal.fire({
                title: "Xác nhận đơn hàng",
                text: "Đơn hàng sẽ không được hoàn trả khi đặt, bạn có muốn đặt không?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Cảm ơn, Mua hàng",
                cancelButtonText: "Đóng, chưa mua"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Thu thập dữ liệu từ form
                    var shipping_email = $('.shipping_email').val();
                    var shipping_name = $('.shipping_name').val();
                    var shipping_address = $('.shipping_address').val();
                    var shipping_phone = $('.shipping_phone').val();
                    var shipping_notes = $('.shipping_notes').val();
                    var shipping_method = $('.payment_select').val();
                    var order_fee = $('.order_fee').val();
                    var order_coupon = $('.order_coupon').val();
                    var _token = $('input[name="_token"]').val();

                    // Gửi yêu cầu AJAX
                    $.ajax({
                        url: '{{url('/confirm-order')}}',
                        method: 'POST',
                        data: {
                            shipping_email: shipping_email,
                            shipping_name: shipping_name,
                            shipping_address: shipping_address,
                            shipping_phone: shipping_phone,
                            shipping_notes: shipping_notes,
                            _token: _token,
                            order_fee: order_fee,
                            order_coupon: order_coupon,
                            shipping_method: shipping_method
                        },
                        success: function () {
                            Swal.fire({
                                title: "Đơn hàng",
                                text: "Đơn hàng của bạn đã được gửi thành công",
                                icon: "success",
                                timer: 3000, // Tự động đóng sau 3 giây
                                showConfirmButton: false
                            });

                            // Tự động reload trang sau 3 giây
                            setTimeout(function () {
                                location.reload();
                            }, 3000);
                        },
                        error: function () {
                            Swal.fire({
                                title: "Lỗi",
                                text: "Không thể gửi đơn hàng. Vui lòng thử lại!",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Đóng",
                        text: "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng",
                        icon: "info",
                        confirmButtonText: "OK"
                    });
                }
            });
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.add-to-cart').click(function() {

            var id = $(this).data('id_product');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();

            if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
            } else {
                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        _token: _token,
                        cart_product_quantity: cart_product_quantity
                    },
                    success: function() {
                        const cartImage = "{{ asset('public/frontend/images/CART.webp') }}";

                        Swal.fire({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                            showCancelButton: true,
                            cancelButtonText: "Xem tiếp",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Đi đến giỏ hàng",
                            closeOnConfirm: false,
                            width: 450, // Độ rộng của popup
                            padding: "3em", // Khoảng cách bên trong
                            color: "#FF6347", // Màu chữ
                            background: "#fff", // Nền
                            backdrop: `
                                rgba(0, 0, 0, 0.5)
                                url('${cartImage}')
                                right
                                no-repeat
                            `,
                            didRender: () => {
                                const swalElement = document.querySelector('.swal2-popup');
                                const titleElement = document.querySelector('.swal2-title');

                                // Điều chỉnh font chữ
                                if (titleElement) {
                                    titleElement.style.fontSize = '20px';
                                }

                                // Điều chỉnh vị trí popup
                                if (swalElement) {
                                    swalElement.style.margin = '100px';
                                }
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ url('/gio-hang') }}";
                            }
                        });
                    }
                });
            }
        });
    })

</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.choose').on('change',function(){
		var action = $(this).attr('id');
		var ma_id = $(this).val();
		var _token = $('input[name="_token"]').val();
		var result = '';
	   
		if(action=='city'){
			result = 'province';
		}else{
			result = 'wards';
		}
		$.ajax({
			url : '{{url('/select-delivery-home')}}',
			method: 'POST',
			data:{action:action,ma_id:ma_id,_token:_token},
			success:function(data){
			   $('#'+result).html(data);     
			}
		});
	});
	});
	  
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.calculate_delivery').click(function () {
            var matp = $('.city').val();
            var maqh = $('.province').val();
            var xaid = $('.wards').val();
            var _token = $('input[name="_token"]').val();

            if (matp == '' || maqh == '' || xaid == '') {
                Swal.fire({
                    title: "Lỗi",
                    text: "Làm ơn chọn đầy đủ thông tin để tính phí vận chuyển.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            } else {
                Swal.fire({
                    title: "Đang tính phí vận chuyển...",
                    text: "Vui lòng chờ trong giây lát.",
                    icon: "info",
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '{{url('/calculate-fee')}}',
                    method: 'POST',
                    data: { matp: matp, maqh: maqh, xaid: xaid, _token: _token },
                    success: function () {
                        Swal.fire({
                            title: "Thành công",
                            text: "Phí vận chuyển đã được tính.",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Reload trang sau khi thông báo thành công
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function () {
                        Swal.fire({
                            title: "Lỗi",
                            text: "Không thể tính phí vận chuyển. Vui lòng thử lại.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                });
            }
        });
    });
</script>
<script>
	
	document.getElementById('toggle-category').addEventListener('click', function () {
    const categoryList = document.getElementById('category-list');
    categoryList.classList.toggle('open');
    categoryList.style.maxHeight = categoryList.classList.contains('open') ? categoryList.scrollHeight + "px" : "0";
    categoryList.style.opacity = categoryList.classList.contains('open') ? "1" : "0";
});

document.getElementById('toggle-brand').addEventListener('click', function () {
    const brandList = document.getElementById('brand-list');
    brandList.classList.toggle('show');
    brandList.style.maxHeight = brandList.classList.contains('show') ? brandList.scrollHeight + "px" : "0";
    brandList.style.opacity = brandList.classList.contains('show') ? "1" : "0";
});

</script>

<script>
    // JavaScript để xử lý sự kiện nhấp chuột
document.getElementById('account-icon').addEventListener('click', function(event) {
    event.stopPropagation(); // Ngăn chặn sự kiện nhấp chuột lan truyền
    var submenu = document.getElementById('account-submenu');
    submenu.style.display = (submenu.style.display === 'none' || submenu.style.display === '') ? 'block' : 'none'; // Hiện/ẩn submenu
});

// Đóng submenu khi nhấp ra bên ngoài
window.addEventListener('click', function(event) {
    var submenu = document.getElementById('account-submenu');
    if (submenu.style.display === 'block') {
        submenu.style.display = 'none'; // Ẩn submenu
    }
});
</script>
<script type="text/javascript">
	function view(){
    if(localStorage.getItem('data') != null){
        var data = JSON.parse(localStorage.getItem('data'));
        data.reverse();
        document.getElementById('row_wishlist').style.overflow = 'scroll';
        document.getElementById('row_wishlist').style.height = '600px';
        for(i=0; i<data.length; i++){
            var name = data[i].name;
            var price = data[i].price;
            var image = data[i].image;
            var url = data[i].url;

            $("#row_wishlist").append('<div class="row" style="margin:10px 0 "><div class="col-md-4"><img src="'+image+'" width="100%"></div><div class="col-md-8 info_wishlist"><p>'+name+'</p><p style="color:#FF980F">'+price+'</p><a href="'+url+'">Đặt hàng</a></div></div>');
        }
    }
	}
	view();
	function add_wistlist(clicked_id) {
    var id = clicked_id;
    var name = document.getElementById('wishlist_productname' + id)?.value || '';
    var price = document.getElementById('wishlist_productprice' + id)?.value || '';
    var image = document.getElementById('wishlist_productimage' + id)?.src || '';
    var url = document.getElementById('wishlist_producturl' + id)?.href || '';

    var newItem = {
        'url': url,
        'id': id,
        'name': name,
        'price': price,
        'image': image
    };

    // Kiểm tra và khởi tạo localStorage
    if (!localStorage.getItem('data')) {
        localStorage.setItem('data', '[]');
    }

    // Lấy dữ liệu từ localStorage và xử lý lỗi JSON
    let old_data;
    try {
        old_data = JSON.parse(localStorage.getItem('data')) || [];
    } catch (error) {
        console.error("Dữ liệu localStorage không hợp lệ. Reset dữ liệu.", error);
        old_data = [];
        localStorage.setItem('data', '[]');
    }

    // Kiểm tra sản phẩm đã tồn tại trong wishlist
    var matches = old_data.filter(obj => obj.id == id);

    if (matches.length) {
        alert('Sản phẩm bạn đã yêu thích, nên không thể thêm');
    } else {
        old_data.push(newItem);
        $("#row_wishlist").append(`
            <div class="row" style="margin:10px 0">
                <div class="col-md-4">
                    <img src="${newItem.image}" width="100%">
                </div>
                <div class="col-md-8 info_wishlist">
                    <p>${newItem.name}</p>
                    <p style="color:#FF980F">${newItem.price}</p>
                    <a href="${newItem.url}">Đặt hàng</a>
                </div>
            </div>
        `);
        localStorage.setItem('data', JSON.stringify(old_data));
    }
}

</script>



</body>
</html>