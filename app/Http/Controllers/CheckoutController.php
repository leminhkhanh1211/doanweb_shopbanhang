<?php

namespace App\Http\Controllers;

use App\Models\Category_Post;
use App\Models\City;
use App\Models\Feeship;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Province;
use App\Models\Shipping;
use App\Models\Slider;
use App\Models\Wards;
use Darryldecode\Cart\Facades\CartFacade as Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;
session_start();

class CheckoutController extends Controller
{
    //
    public function confirm_order(Request $request){
        $data = $request->all();

        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);

 
        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();

        if(Session::get('cart')==true){
           foreach(Session::get('cart') as $key => $cart){
               $order_details = new OrderDetails();
               $order_details->order_code = $checkout_code;
               $order_details->product_id = $cart['product_id'];
               $order_details->product_name = $cart['product_name'];
               $order_details->product_price = $cart['product_price'];
               $order_details->product_sales_quantity = $cart['product_qty'];
               $order_details->product_coupon =  $data['order_coupon'];
               $order_details->product_feeship = $data['order_fee'];
               $order_details->save();
           }
        }
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
   }
   public function del_fee(){
       Session::forget('fee');
       return redirect()->back();
   }
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
          return Redirect::to('dashboard');
        }else{
          return Redirect::to('admin')->send();
        }
      }
    //   public function view_order($orderId) {
    //     $this->AuthLogin();
    
    //     $order_by_id = DB::table('tbl_order')
    //         ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
    //         ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
    //         ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
    //         ->select('tbl_order.*', 'tbl_customers.*', 'tbl_shipping.*', 'tbl_order_details.*')
    //         ->where('tbl_order.order_id', $orderId) // Lọc theo $orderId
    //         ->get(); // Sử dụng get() để trả về danh sách
    
    //     $manager_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id);
    
    //     return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
    // }
    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                     foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }else{ 
                    Session::put('fee',25000);
                    Session::save();
                }
            }
           
        }
    }
    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                    $output.='<option>---Chọn quận huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }

            }else{

                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>---Chọn xã phường---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }
    }
    
    public function view_order($orderId){
        $this->AuthLogin();
    
        // Lấy thông tin chung của đơn hàng
        $order_info = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->select('tbl_order.*', 'tbl_customers.*', 'tbl_shipping.*')
            ->where('tbl_order.order_id', $orderId)
            ->first();
    
        // Lấy chi tiết sản phẩm của đơn hàng
        $order_details = DB::table('tbl_order_details')
            ->where('order_id', $orderId)
            ->get();
    
        // Gửi dữ liệu sang view
        return view('admin.view_order', compact('order_info', 'order_details'));
    }
    
    
    
    public function login_checkout(Request $request){
         //category post
      $category_post= Category_Post::orderBy('cate_post_id','DESC')->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
         //seo 
         $meta_desc = "Đăng nhập thanh toán"; 
         $meta_keywords = "Đăng nhập thanh toán";
         $meta_title = "Đăng nhập thanh toán";
         $url_canonical = $request->url();
         //--seo 
 
        $cate_product =DB::table('categories')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product =DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        return view('pages.checkout.login_checkout')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
        ->with('slider',$slider)
        ->with('category_post',$category_post);
    }
    public function add_customer(Request $request){
        $data=array();
        $data['customer_name']=$request->customer_name;
        $data['customer_email']=$request->customer_email;
        $data['customer_password']=md5($request->customer_password);
        $data['customer_phone']=$request->customer_phone;

        $customer_id =DB::table('tbl_customers')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return Redirect::to('/checkout');


    }
    public function checkout(Request $request){
        $category_post= Category_Post::orderBy('cate_post_id','DESC')->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        if (!Session::get('customer_id')) {
            Session::put('message', 'Bạn cần đăng nhập trước khi thanh toán!');
            return Redirect::to('/dang-nhap');
        }

        $cate_product =DB::table('categories')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product =DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $city = City::orderby('matp','ASC')->get();

        return view('pages.checkout.show_checkout')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
        ->with('city',$city)->with('slider',$slider)->with('category_post',$category_post);
;
    }
    public function save_checkout_customer(Request $request){
        $data=array();
        $data['shipping_name']=$request->shipping_name;
        $data['shipping_phone']=$request->shipping_phone;
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_notes']=$request->shipping_notes;
        $data['shipping_address']=$request->shipping_address;


        $shipping_id =DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        return Redirect::to('/payment');

    }
    public function payment(Request $request){
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();


        $cate_product =DB::table('categories')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product =DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        return view('pages.checkout.payment')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
;
        
    }
    public function order_place(Request $request){
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        // Insert payment method
        $data = [
            'payment_method' => $request->payment_option,
            'payment_status' => 'Đang chờ xử lý',
        ];
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
    
        // Insert order
        $subtotal = 0;
        $content = Cart::getContent();
        foreach ($content as $item) {
            $subtotal += $item->price * $item->quantity; // Calculate subtotal
        }
    
        $taxCondition = Cart::getCondition('VAT 10%');
        $tax = $taxCondition ? $taxCondition->getCalculatedValue($subtotal) : 0;
    
        $total = $subtotal + $tax; // Calculate total
    
        $order_data = [
            'customer_id' => Session::get('customer_id'),
            'shipping_id' => Session::get('shipping_id'),
            'payment_id' => $payment_id,
            'order_total' => $total, // Ensure order_total is set correctly
            'order_status' => 'Đang chờ xử lý',
        ];
    
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
    
        // Insert order details
        foreach ($content as $v_content) {
            $order_d_data = [
                'order_id' => $order_id,
                'product_id' => $v_content->id,
                'product_name' => $v_content->name,
                'product_price' => $v_content->price,
                'product_sales_quantity' => $v_content->quantity, // Use quantity instead of qty
            ];
            DB::table('tbl_order_details')->insert($order_d_data);
        }
    
        // Payment method actions
        if ($data['payment_method'] == 1) {
            echo 'Thanh toán thẻ ATM';
        } elseif ($data['payment_method'] == 2) {
            Cart::clear();
            $cate_product =DB::table('categories')->where('category_status','0')->orderBy('category_id','desc')->get();
            $brand_product =DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
            return view('pages.checkout.handcash')
            ->with('category',$cate_product)
            ->with('brand',$brand_product)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
            
            
        } else {
            echo 'Thẻ ghi nợ';
        }
    }
    
    public function logout_checkout(){
        Session::forget('customer_id');
        return Redirect::to('/dang-nhap');

    }
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')
            ->where('customer_email', $email)
            ->where('customer_password', $password)
            ->first();
            
        if ($result) {
            Session::put('customer_id', $result->customer_id); // Đặt session trong điều kiện
            return Redirect::to('/checkout');
        } else {
            Session::flash('error', 'Email hoặc mật khẩu không đúng!');
            return Redirect::to('/dang-nhap');
        }
        Session::save();
    }
    public function manage_order(){
       
        $this->AuthLogin();
       $all_order= DB::table('tbl_order')
       ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
       ->select('tbl_order.*','tbl_customers.customer_name')
       ->orderBy('tbl_order.order_id','desc')->get();
       $manager_order=view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order',$manager_order);
    }
    

}

