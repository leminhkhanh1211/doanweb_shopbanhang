<?php

namespace App\Http\Controllers;

use App\Models\Category_Post;
use App\Models\Coupon;
use App\Models\Slider;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }

        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng');
        }
    }   
    public function gio_hang(Request $request){
        //seo 
        //category post
      $category_post= Category_Post::orderBy('cate_post_id','DESC')->get();
        //slide
       $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

       $meta_desc = "Giỏ hàng của bạn"; 
       $meta_keywords = "Giỏ hàng Ajax";
       $meta_title = "Giỏ hàng Ajax";
       $url_canonical = $request->url();
       //--seo
       $cate_product = DB::table('categories')->where('category_status','0')->orderby('category_id','desc')->get(); 
       $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

       return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
   }
    public function add_cart_ajax(Request $request){
        // Session::forget('cart');
        $data = $request->all();
        print_r($data);
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();

    }  
    public function delete_product($session_id){
        $cart = Session::get('cart');
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>';
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }

    }
    public function update_cart(Request $request)
{
    $data = $request->all();
    $cart = Session::get('cart');
    
    if ($cart) {
        $updatedProducts = [];
        $failedProducts = [];
        
        foreach ($data['cart_qty'] as $key => $qty) {
            foreach ($cart as $session => $val) {
                if ($val['session_id'] == $key) {
                    if ($qty <= $cart[$session]['product_quantity']) {
                        $cart[$session]['product_qty'] = $qty;
                        $updatedProducts[] = $cart[$session]['product_name'];
                    } else {
                        $failedProducts[] = $cart[$session]['product_name'];
                    }
                }
            }
        }

        Session::put('cart', $cart);

        $message = '';
        if (!empty($updatedProducts)) {
            $message .= '<p style="color:blue">Cập nhật thành công: ' . implode(', ', $updatedProducts) . '</p>';
        }
        if (!empty($failedProducts)) {
            $message .= '<p style="color:red">Cập nhật thất bại: ' . implode(', ', $failedProducts) . '</p>';
        }

        return redirect()->back()->with('message', $message);
    }

    return redirect()->back()->with('message', '<p style="color:red">Cập nhật số lượng thất bại</p>');
}

    public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            // Session::destroy();
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa hết giỏ thành công');
        }
    }
    public function save_cart(Request $request)
    {
        $productId = $request->productid_hidden;
        $quantity = $request->qty;

        // Lấy thông tin sản phẩm
        $product_info = DB::table('tbl_product')->where('product_id', $productId)->first();

        // Thêm sản phẩm vào giỏ hàng
        Cart::add([
            'id' => $product_info->product_id,
            'name' => $product_info->product_name,
            'price' => $product_info->product_price,
            'quantity' => $quantity,
            'attributes' => [
                'image' => $product_info->product_image
            ]
        ]);

        // Thêm điều kiện thuế vào giỏ hàng nếu chưa có
        if (Cart::getCondition('VAT 10%') === null) {
            $taxCondition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'VAT 10%',
                'type' => 'tax',
                'target' => 'subtotal',
                'value' => '10%',
            ));
            Cart::condition($taxCondition);
        }

        return Redirect::to('/show-cart');
    }

    public function show_cart(Request $request)
{
    //seo 
    $meta_desc = "Giỏ hàng của bạn"; 
    $meta_keywords = "Giỏ hàng";
    $meta_title = "Giỏ hàng";
    $url_canonical = $request->url();
    $cate_product = DB::table('categories')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
    $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

    // Lấy nội dung giỏ hàng
    $cartItems = Cart::getContent();

    // Tính toán subtotal (tổng phụ)
    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item->price * $item->quantity; // Tính subtotal từ giá và số lượng
    }

    // Tính toán thuế
    $taxCondition = Cart::getCondition('VAT 10%');
    $tax = $taxCondition ? $taxCondition->getCalculatedValue($subtotal) : 0;

    // Tính toán tổng giá
    $total = $subtotal + $tax;

    return view('pages.cart.show_cart')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('cartItems', $cartItems)
        ->with('subtotal', $subtotal)
        ->with('tax', $tax)
        ->with('total', $total)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
}


    public function delete_to_cart($productId)
    {
        Cart::remove($productId); // Xóa sản phẩm theo id
        return Redirect::to('/show-cart');
    }

    public function update_cart_quantity(Request $request)
    {
        $Id = $request->product_id;
        $qty = $request->cart_quantity;
        Cart::update($Id, ['quantity' => ['relative' => false, 'value' => $qty]]);
        return Redirect::to('/show-cart');
    }
}
