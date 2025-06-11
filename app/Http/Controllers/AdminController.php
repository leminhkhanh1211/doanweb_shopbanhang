<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Social;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;
use Laravel\Socialite\Facades\Socialite;

session_start();

class AdminController extends Controller
{
    //
    public function login_google(){
      return Socialite::driver('google')->redirect();
  }

  // Hàm callback sau khi đăng nhập Google
  public function callback_google(){
      $users = Socialite::driver('google')->user();

      if ($users) {
          $authUser = $this->findOrCreateUser($users, 'google');
          $account_name = Login::where('admin_id', $authUser->user)->first();
          Session::put('admin_name', $account_name->admin_name);
          Session::put('admin_id', $account_name->admin_id);
          return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
      } else {
          return redirect('/admin')->with('message', 'Lỗi trong việc xác thực tài khoản Google.');
      }
  }

  // Tìm hoặc tạo người dùng mới từ thông tin của Google/Facebook
  public function findOrCreateUser($users, $provider){
      $authUser = Social::where('provider_user_id', $users->id)->first();

      if ($authUser) {
          return $authUser;  // Trả về nếu người dùng đã có trong hệ thống
      }

      // Tạo mới đối tượng Social nếu người dùng chưa có
      $social = new Social([
          'provider_user_id' => $users->id,
          'provider' => strtoupper($provider)
      ]);

      // Tìm hoặc tạo tài khoản người dùng trong bảng Login
      $user = Login::firstOrCreate(
          ['admin_email' => $users->email],
          [
              'admin_name' => $users->name,
              'admin_password' => '',
              'admin_phone' => '',
              'admin_status' => 1
          ]
      );

      // Gán user_id đúng từ bảng Login vào đối tượng Social
      $social->user = $user->admin_id;
      $social->login()->associate($user);  // Mối quan hệ giữa Social và Login
      $social->save();

      return $social;
  }

  // Hàm đăng nhập với Facebook
  public function login_facebook(){
      return Socialite::driver('facebook')->redirect();
  }

  // Hàm callback sau khi đăng nhập Facebook
  public function callback_facebook(){
      $provider = Socialite::driver('facebook')->user();

      if ($provider) {
          $account = Social::where('provider', 'facebook')
                           ->where('provider_user_id', $provider->getId())
                           ->first();

          if ($account) {
              // Kiểm tra nếu người dùng đã có trong hệ thống
              $account_name = Login::where('admin_id', $account->user)->first();
              if ($account_name) {
                  Session::put('admin_name', $account_name->admin_name);
                  Session::put('admin_id', $account_name->admin_id);
                  return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
              } else {
                  return redirect('/admin')->with('message', 'Không tìm thấy người dùng tương ứng.');
              }
          } else {
              // Tạo mới đối tượng Social nếu người dùng chưa có trong hệ thống
              $social = new Social([
                  'provider_user_id' => $provider->getId(),
                  'provider' => 'facebook'
              ]);

              // Tìm hoặc tạo tài khoản người dùng trong bảng Login
              $user = Login::firstOrCreate(
                  ['admin_email' => $provider->getEmail()],
                  [
                      'admin_name' => $provider->getName(),
                      'admin_password' => '',
                      'admin_phone' => ''
                  ]
              );

              // Gán user_id đúng từ bảng Login vào đối tượng Social
              $social->user = $user->admin_id;
              $social->login()->associate($user);  // Mối quan hệ giữa Social và Login
              $social->save();

              // Đăng nhập sau khi tạo tài khoản mới
              Session::put('admin_name', $user->admin_name);
              Session::put('admin_id', $user->admin_id);
              return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
          }
      } else {
          return redirect('/admin')->with('message', 'Lỗi trong việc xác thực tài khoản Facebook.');
      }
  }

    public function AuthLogin(){
    //$admin_id = Session::get('admin_id');
    $admin_id =Auth::id();
      if($admin_id){
        return Redirect::to('dashboard');
      }else{
        return Redirect::to('admin')->send();
      }
    }
    public function index(){
       return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
     
     }
    public function dashboard(Request $request){
      //$data = $request->all();
      $data = $request->validate([
        //validation laravel 
        'admin_email' => 'required',
        'admin_password' => 'required',
       'g-recaptcha-response' => new Captcha(),    //dòng kiểm tra Captcha
    ]);


    $admin_email = $data['admin_email'];
    $admin_password = md5($data['admin_password']);
    $login = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
    if($login){
        $login_count = $login->count();
        if($login_count>0){
            Session::put('admin_name',$login->admin_name);
            Session::put('admin_id',$login->admin_id);
            return Redirect::to('/dashboard');
        }
    }else{
            Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
            return Redirect::to('/admin');
    }
      // $admin_email = $request->admin_email;
      // $admin_password =md5( $request->admin_password);
      // $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
      // if($result){
      //    Session::put('admin_name',$result->admin_name);
      //    Session::put('admin_id',$result->admin_id);
      //    return Redirect::to('/dashboard');
      // }else{
      //    Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn hãy nhập lại!');

      //    return Redirect::to('/admin');

      // }
    }
    public function logout(){
         $this->AuthLogin();
         Session::put('admin_name',null);
         Session::put('admin_id',null);
         return Redirect::to('/admin');
      
   }
   
}
