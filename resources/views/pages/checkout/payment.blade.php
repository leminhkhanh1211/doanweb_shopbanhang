@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>

        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        
        <div class="table-responsive cart_info">
            <?php 
                $content = Cart::getContent();
                $subtotal = 0;
                foreach ($content as $item) {
                    $subtotal += $item->price * $item->quantity;
                }

                $taxCondition = Cart::getCondition('VAT 10%');
                $tax = $taxCondition ? $taxCondition->getCalculatedValue($subtotal) : 0;
                $total = $subtotal + $tax;
            ?>
            @if(count($content) > 0)
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
                                        {{-- <input type="text" name="cart_quantity" value="{{ $v_content->quantity }}" class="form-control cart_quantity_input" size="2">
                                        <input type="hidden" name="product_id" value="{{ $v_content->id }}"> --}}
                                        <input type="submit" value="Cập nhật" name="updated_qty" class="btn btn-warning btn-sm" style="font-weight: bold;">
                                    </form>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{ number_format($v_content->price * $v_content->quantity, 0, ',', '.') . ' vnđ' }}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{ url('delete-to-cart/'.$v_content->id) }}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Giỏ hàng của bạn hiện đang trống.</p>
            @endif
        </div>
        <h4 style="margin: 40px 0;font-size: 20px;">Chọn hình thức thanh toán</h4>
        <form action="{{ url('/order-place') }}" method="POST">
            @csrf
        <div class="payment-options">
            <span>
                <label><input name="payment_option" value="1" type="radio"> Trả bằng thẻ ATM</label>
            </span>
            <span>
                <label><input name="payment_option" value="2" type="radio"> Nhận tiền mặt</label>
            </span>
            <span>
                <label><input name="payment_option" value="3" type="radio"> Thanh toán thẻ ghi nợ</label>
            </span>
            <input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm" style="font-weight: bold;">
        </div>
        </form>
    </div>
</section>
@endsection
