<?php

namespace App\Http\Controllers;
use App\Models\Category_Post;
use App\Models\Slider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;

session_start();

class HomeController extends Controller
{
    //
    public function send_mail(){
        //send mail
               $to_name = "Khanh Le";
               $to_email = "khanhlm.23it@vku.udn.vn";//send to this email
              
            
               $data = array("name"=>"Mail từ tài khoản Khách hàng","body"=>'Mail gửi về vấn về hàng hóa'); //body of mail.blade.php
               
               Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){

                   $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
                   $message->from($to_email,$to_name);//send from this mail
               });
               // return redirect('/')->with('message','');
               //--send mail
   }
    public function index(Request $request){
        //category post
        $category_post= Category_Post::orderBy('cate_post_id','DESC')->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        //seo
        $meta_desc="Chuyên bán những món đồ decor trang trí căn phòng , nhà";
        $meta_keywords="đồ decor, đồ trang trí phòng";
        $meta_title="Khanh Lê | DECOR PHÒNG";
        $url_canonical=$request->url();
        $cate_product =DB::table('categories')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product =DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        // $all_product= DB::table('tbl_product')
        // ->join('categories','categories.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderBy('tbl_product.product_id','desc')->get();
        $all_product =DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->paginate(6);
        //->limit(6)->get();
        return view('pages.home')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('all_product',$all_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('slider',$slider)
        ->with('category_post',$category_post);
        // return view('pages.home')
        // ->with(compact('cate_product','brand_product','all_product'));
    } 
    public function search(Request $request){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        //seo 
        $meta_desc = "Tìm kiếm sản phẩm"; 
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        //--seo
        $keywords= $request->keywords_submit;
        $cate_product =DB::table('categories')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product =DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $search_product =DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
        return view('pages.sanpham.search')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('search_product',$search_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
        ->with('slider',$slider);

    }
}
