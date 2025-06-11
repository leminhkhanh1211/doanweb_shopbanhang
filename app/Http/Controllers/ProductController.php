<?php

namespace App\Http\Controllers;

use App\Models\Category_Post;
use App\Models\Comment;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;
session_start();
class ProductController extends Controller
{
    //
    public function AuthLogin(){
        $admin_id = Auth::id();
        //$admin_id = Session::get('admin_id');
        if($admin_id){
          return Redirect::to('dashboard');
        }else{
          return Redirect::to('admin')->send();
        }
      }
      public function reply_comment(Request $request){
        $data=$request->all();
        $comment= new Comment();
        $comment-> comment=$data['comment'];
        $comment-> comment_product_id=$data['comment_product_id'];
        $comment-> coment_parent_coment=$data['comment_id'];
        $comment->comment_status=0;
        $comment->comment_name='lekhanhdecor';
        $comment->save();
      }
      public function allow_comment(Request $request){
        $data=$request->all();
        $comment= Comment::find($data['comment_id']);
        $comment-> comment_status=$data['comment_status'];
        $comment->save();
       
      }
      public function list_comment(){
        $comment= Comment::with('product')->where('coment_parent_coment','=',0)->orderBy('comment_status','DESC')->get();
        $comment_rep= Comment::with('product')->where('coment_parent_coment','>',0)->orderBy('comment_id','DESC')->get();
        return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));
      }
      public function send_comment(Request $request){
         $product_id = $request->product_id;
         $comment_name = $request->comment_name;
         $comment_content = $request->comment_content;
         $comment= new Comment();
         $comment-> comment=$comment_content;
         $comment-> comment_name=$comment_name;
         $comment-> comment_product_id=$product_id;
         $comment-> comment_status=1;
         $comment-> coment_parent_coment=0;
         $comment->save();

      }
      public function load_comment(Request $request)
      {
          $product_id = $request->product_id;
      
          // Lấy danh sách bình luận
          $comments = Comment::where('comment_product_id', $product_id)->where('coment_parent_coment','=',0)->where('comment_status', 0)->get();
          $comment_rep= Comment::with('product')->where('coment_parent_coment','>',0)->orderBy('comment_id','DESC')->get();
      
          $output = '';
          foreach ($comments as $comm) {
              $output .= '
              <div class="row style_comment">
                  <div class="col-md-3">
                      <img width="60%" src="' . url('/public/frontend/images/avticon.webp') . '" class="img img-reponsive img-thumbnail">
                  </div>
                  <div class="col-md-9">
                      <p style="color: blue">@' . htmlspecialchars($comm->comment_name, ENT_QUOTES, 'UTF-8') . '</p>
                      <p style="color: #000">' . htmlspecialchars($comm->comment_date, ENT_QUOTES, 'UTF-8') . '</p>
                      <p>' . htmlspecialchars($comm->comment, ENT_QUOTES, 'UTF-8') . '</p>
                  </div>
              </div><p></p>';

              foreach($comment_rep as $key => $rep_comment){
              if($rep_comment->coment_parent_coment==$comm->comment_id	){
                $output .= '<div class="row style_comment" style="margin:5px 40px;background: aliceblue;">
                <div class="col-md-3">
                    <img width="50%" src="' . url('/public/frontend/images/avtadmin.jpg') . '" class="img img-reponsive img-thumbnail">
                </div>
                <div class="col-md-9">
                    <p style="color: green">@Admin</p>
                    <p style="color: #000">'.$rep_comment->comment.'</p>
                    <p></p>
                </div>
                </div><p></p>';
            }
            }
              
             
          
          }
      
          // Trả về JSON cho AJAX
          return response()->json(['output' => $output]);
      }
      
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('categories')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
       
         return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
        $this->AuthLogin();
       $all_product= DB::table('tbl_product')
       ->join('categories','categories.category_id','=','tbl_product.category_id')
       ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
       ->orderBy('tbl_product.product_id','desc')->paginate(5);
       $manager_product=view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
        
    }
    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $request->product_price;  
        // $data['product_image'] = $request->product_image;
        $data['product_desc'] = strip_tags($request->product_desc); // Loại bỏ thẻ HTML
        $data['product_content'] = strip_tags($request->product_content);
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image =$get_image->getClientOriginalName();
            $new_image=current(explode('.',$get_name_image));
            $new_image= $new_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');   

        }
        $data['product_image']='';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('all-product');    
    }
    public function unactive_product($product_id) {
        $this->AuthLogin();
        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->update(['product_status' => 1]);
            Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')
        ->where('product_id', $product_id)
        ->update(['product_status' => 0]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
        
    }
    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('categories')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $edit_product= DB::table('tbl_product')
        ->where('product_id',$product_id)
        ->get();
        $manager_product=view('admin.edit_product')
        ->with('edit_product',$edit_product)
        ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
         return view('admin_layout')->with('admin.edit_product',$manager_product);
         
     }
     public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        $data = array();
        
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $request->product_price;  
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image =$get_image->getClientOriginalName();
            $new_image=current(explode('.',$get_name_image));
            $new_image= $new_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('all-product');   

        }
        
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');  


     }
     public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id) 
        ->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product'); 
     }
     //end admin page
     public function details_product(Request $request, $product_slug)
{
      //category post
      $category_post= Category_Post::orderBy('cate_post_id','DESC')->get();
    $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
    // Lấy danh sách danh mục và thương hiệu
    $cate_product = DB::table('categories')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
    $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

    // Lấy chi tiết sản phẩm dựa vào slug
    $details_product = DB::table('tbl_product')
        ->join('categories', 'categories.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('tbl_product.product_slug', $product_slug)
        ->get();

    // Nếu không có sản phẩm, trả về lỗi 404
    if ($details_product->isEmpty()) {
        abort(404, 'Sản phẩm không tồn tại.');
    }

   
    
    foreach ($details_product as $value) {
        //$image_og = asset('public/uploads/product/' . $value->product_image);
        $category_id = $value->category_id;
        $meta_desc = $value->product_desc;
        $meta_keywords = $value->product_slug;
        $meta_title = $value->product_name;
        $url_canonical = $request->url();
    }

    // Lấy các sản phẩm liên quan
    $related_product = DB::table('tbl_product')
        ->join('categories', 'categories.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('categories.category_id', $category_id)
        ->whereNotIn('tbl_product.product_slug', [$product_slug])
        ->paginate(6);

    // Trả về view với dữ liệu
    return view('pages.sanpham.show_details')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('product_details', $details_product)
        ->with('relate', $related_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical)
        ->with('slider',$slider)
        ->with('category_post',$category_post);
       // ->with('image_og', $image_og);
}

}
 