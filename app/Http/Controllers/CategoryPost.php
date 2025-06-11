<?php

namespace App\Http\Controllers;
use App\Models\Category_Post;
use App\Models\Post;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;


class CategoryPost extends Controller
{
    public function AuthLogin(){
      $admin_id = Auth::id();
       // $admin_id = Session::get('admin_id');
        if($admin_id){
          return Redirect::to('dashboard');
        }else{
          return Redirect::to('admin')->send();
        }
      }
    public function add_category_post(){
        $this->AuthLogin();
        return view('admin.category_post.add_category');
    }
    public function all_category_post(){
        $this->AuthLogin();
        $category_post=Category_Post::orderBy('cate_post_id','DESC')->paginate(5);    
        return view('admin.category_post.list_category')->with(compact('category_post'));
        
    }
    public function save_category_post(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $category_post=new Category_Post();
        $category_post->cate_post_name=$data['cate_post_name'];
        $category_post->cate_post_slug=$data['cate_post_slug'];
        $category_post->cate_post_desc=$data['cate_post_desc'];
        $category_post->cate_post_status=$data['cate_post_status'];
        $category_post->save();
        Session::put('message','Thêm danh mục bài viết thành công');
        return redirect()->back();    
    }
    
    public function edit_category_post($category_post_id){
        $this->AuthLogin();
        $category_post=Category_Post::find($category_post_id);
       
         return view('admin.category_post.edit_category')->with(compact('category_post'));
         
     }
     
     public function update_category_post(Request $request,$cate_id){
        $this->AuthLogin(); 
        $data = $request->all();
        $category_post=Category_Post::find($cate_id);
        $category_post->cate_post_name=$data['cate_post_name'];
        $category_post->cate_post_slug=$data['cate_post_slug'];
        $category_post->cate_post_desc=$data['cate_post_desc'];
        $category_post->cate_post_status=$data['cate_post_status'];
        $category_post->save();
        Session::put('message','Cập nhật danh mục bài viết thành công');
        return redirect('/all-category-post');    


     }
     public function delete_category_post($cate_id){
        $this->AuthLogin();
        $category_post=Category_Post::find($cate_id);
        $category_post->delete();
        Session::put('message','Xóa danh mục bài viết thành công');
        return redirect()->back();    
     }
     //end function admin page
     public function show_category_home(Request $request,$slug_category_post) {
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(6)->get();
        $cate_post = DB::table('categories')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_post = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        // $category_by_id = DB::table('tbl_post')
        //     ->join('categories', 'tbl_post.category_id', '=', 'categories.category_id')
        //     ->where('tbl_post.category_id', $category_id)->get();
        $category_by_id = DB::table('tbl_post')
        ->join('categories', 'tbl_post.category_id', '=', 'categories.category_id')
        ->where('categories.slug_category_post',$slug_category_post)->paginate(6);
        // Gán giá trị mặc định
        $meta_desc = "Mô tả mặc định cho danh mục này";
        $meta_keywords = "Từ khóa mặc định";
        $meta_title = "Danh mục sản phẩm";
        $url_canonical = $request->url();
        foreach($category_by_id as $key => $val){
            $meta_desc=$val->category_desc;
            $meta_keywords=$val->meta_keywords;
            $meta_title=$val->category_name;
            $url_canonical=$request->url();
        }
        //$category_name = DB::table('categories')->where('categories.category_id', $category_id)->limit(1)->get();
        $category_name = DB::table('categories')->where('categories.slug_category_post', $slug_category_post)->limit(1)->get();
        
        return view('pages.category.show_category')
            ->with('category', $cate_post)
            ->with('brand', $brand_post)
            ->with('category_by_id', $category_by_id)
            ->with('category_name', $category_name)
            ->with('meta_desc',$meta_desc)
            ->with('meta_keywords',$meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical',$url_canonical)
            ->with('slider',$slider);
    }
    public function danh_muc_bai_viet(Request $request,$post_slug){
        $category_post= Category_Post::orderBy('cate_post_id','DESC')->get();
      
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        
          $cate_product =DB::table('categories')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product =DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $catepost = Category_Post::where('cate_post_slug',$post_slug)->take(1)->get();
        
        foreach($catepost as $key => $cate){
        //seo 
        $meta_desc = $cate->cate_post_desc; 
        $meta_keywords = $cate->cate_post_slug;
        $meta_title = $cate->cate_post_name;
        $cate_id = $cate->cate_post_id;
        $url_canonical = $request->url();
        //--seo
        }
        $post = Post::with('cate_post')->where('post_status',0)->where('cate_post_id',$cate_id)->paginate(10);
      
        return view('pages.baiviet.danhmucbaiviet')->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
        ->with('slider',$slider)->with('post',$post)->with('category_post',$category_post);
       }
      
}
