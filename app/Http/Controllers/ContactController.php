<?php

namespace App\Http\Controllers;
use App\Models\Category_Post;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;

class ContactController extends Controller
{
    //
    public function lien_he(Request $request){
        //category post
        $category_post= Category_Post::orderBy('cate_post_id','DESC')->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        //seo
        $meta_desc="Liên hệ";
        $meta_keywords="Liên hệ";
        $meta_title="Liên hệ chúng tôi";
        $url_canonical=$request->url();
        $cate_product =DB::table('categories')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product =DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        return view('pages.lienhe.contact')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('slider',$slider)
        ->with('category_post',$category_post);;
    }
}
