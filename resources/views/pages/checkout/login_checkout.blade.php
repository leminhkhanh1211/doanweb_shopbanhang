@extends('layout')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập tài khoản</h2>
                    <form action="{{ url('/login-customer') }}" method="POST">
                        @csrf
                        <input type="text" name="email_account" placeholder="Tài khoản" />
                        <input type="password" name="password_account" placeholder="Password" />
                        <p><a href="#" id="show-signup" style="color: #000 ; text-decoration: none; font-family: 'Roboto', sans-serif;font-size: 14px;  font-weight: 300;">Chưa có tài khoản? Đăng ký ngay!</a></p> <!-- Liên kết đăng ký -->
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                    
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký</h2>
                    <form action="{{ url('/add-customer') }}" method="POST">
                        @csrf
                        <input type="text" name="customer_name" placeholder="Họ và tên"/>
                        <input type="email" name="customer_email" placeholder="Địa chỉ email"/>
                        <input type="password" name="customer_password" placeholder="Mật khẩu"/>
                        <input type="text" name="customer_phone" placeholder="Phone"/>
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                   
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showSignupLink = document.getElementById('show-signup');
        const showLoginLink = document.getElementById('show-login');
        const loginForm = document.querySelector('.login-form');
        const signupForm = document.querySelector('.signup-form');

        // Ẩn form đăng ký ban đầu
        signupForm.style.display = 'none';

        showSignupLink.addEventListener('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            loginForm.style.display = 'block'; // Ẩn form đăng nhập
            signupForm.style.display = 'block'; // Hiện form đăng ký
        });

        showLoginLink.addEventListener('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            signupForm.style.display = 'none'; // Ẩn form đăng ký
            loginForm.style.display = 'block'; // Hiện form đăng nhập
        });
    });
</script>

@endsection