@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="active">Giỏ hàng của bạn</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <?php 
                $content = Cart::getContent();
                $subtotal = 0;
                foreach ($content as $item) {
                    $subtotal += $item->price * $item->quantity; // Tính subtotal từ giá và số lượng
                }

                // Tính toán thuế
                $taxCondition = Cart::getCondition('VAT 10%');
                $tax = $taxCondition ? $taxCondition->getCalculatedValue($subtotal) : 0;

                // Tính toán tổng giá
                $total = $subtotal + $tax;
            ?>        
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Mô tả</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $v_content)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{ url('public/uploads/product/'.$v_content->attributes->image) }}" width="50" alt="" /></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $v_content->name }}</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>{{ number_format($v_content->price, 0, ',', '.') . ' vnđ' }}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{ url('/update-cart-quantity') }}" method="POST">
                                    @csrf
                                    <input class="cart_quantity_input" type="text" name="cart_quantity" value="{{ $v_content->quantity }}" class="form-control" autocomplete="off" size="2">
                                    <input type="hidden" name="product_id" value="{{ $v_content->id }}">
                                    <input type="submit" value="Cập nhật" name="updated_qty" class="btn btn-warning btn-sm" style="font-weight: bold;">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php 
                                    $subtotal_item = $v_content->price * $v_content->quantity;
                                    echo number_format($subtotal_item, 0, ',', '.') . ' vnđ';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ url('delete-to-cart/'.$v_content->id) }}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
       
        <div class="row">
           
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng <span>{{ number_format($subtotal, 0, ',', '.') }} vnđ</span></li>
                        <li>Thuế <span>{{ number_format($tax, 0, ',', '.') }} vnđ</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{ number_format($total, 0, ',', '.') }} vnđ</span></li>
                    </ul>

                    {{-- <a class="btn btn-default update" href="">Update</a> --}}
                                <?php
									$customer_id = Session::get('customer_id');
									if ($customer_id!=NULL) {
									
								  ?>
								
								
                                <a class="btn btn-default check_out" href="{{ url('/checkout') }}">Thanh toán</a>
								<?php 
									}else {
								  ?>
                                  <a class="btn btn-default check_out" href="{{ url('/login-checkout') }}">Thanh toán</a>
								<?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection
