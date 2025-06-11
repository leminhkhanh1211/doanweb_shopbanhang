# Handmade Shop
Ứng dụng web bán hàng thủ công, giúp người dùng dễ dàng mua sắm và quản lý đơn hàng.

## Cài đặt
1. Clone repo: `git clone https://github.com/nhatphuong1210/Handmade_Shop.git`  
2. Chạy `composer install` để cài dependencies  
3. Thiết lập `.env` theo file mẫu `.env.example`  
4. Chạy `php artisan migrate` để tạo database  
5. Khởi động server: `php artisan serve`

## Tính năng
- Đăng ký / Đăng nhập khách hàng và admin  
- Quản lý sản phẩm, danh mục, thương hiệu  
- Giỏ hàng, thanh toán online  
- Quản lý đơn hàng, vận chuyển, mã giảm giá

### Công Nghệ
- PHP (Laravel)
- Blade
- CSS
- JavaScript
- HTML
  
#### Giao diện của ứng dụng
# Giao diện của khách hàng
+ Giao diện của khách hàng được thiết kế thân thiện và dễ sử dụng, giúp người dùng có thể dễ dàng thực hiện các thao tác mua sắm trên website.
  
![image](https://github.com/user-attachments/assets/1610e624-44c8-415f-bd1b-27536aefb1f9)

**+ Giao diện trang chủ** hiển thị các sản phẩm nổi bật và các danh mục chính, giúp khách hàng dễ dàng tìm kiếm sản phẩm.

![image](https://github.com/user-attachments/assets/7129c6fa-eb6c-4829-8cf4-d3c727383217)
**+ Giao diện đăng nhập** cho phép khách hàng đăng nhập vào hệ thống để quản lý tài khoản và đặt hàng.

![image](https://github.com/user-attachments/assets/f8d3cc94-7377-49e1-b2e6-0d53f62aff60)

**+ Giao diện đăng kí** cho phép khách hàng tạo tài khoản mới một cách nhanh chóng và thuận tiện.

![image](https://github.com/user-attachments/assets/00896240-376f-4114-9a80-97c5e70a07dc)

**+ Giao diện xem sản phẩm** cho phép khách hàng xem danh sách các sản phẩm theo từng danh mục.

![image](https://github.com/user-attachments/assets/3bf674d4-a877-40e6-976e-d357f9018455)

**+ Giao diện xem chi tiết sản phẩm** cung cấp đầy đủ thông tin về sản phẩm bao gồm hình ảnh, mô tả, giá cả và đánh giá.

![image](https://github.com/user-attachments/assets/569f795d-345a-4e78-9e1c-e9952ab6c3e4)

**+ Giao diện giỏ hàng** giúp khách hàng quản lý các sản phẩm đã chọn trước khi tiến hành đặt hàng.

![image](https://github.com/user-attachments/assets/bcf3c820-7eb0-450a-b8bf-eca4dec01488)

**+ Giao diện xác nhận thông tin đơn hàng** để khách hàng kiểm tra lại các chi tiết trước khi thanh toán.

![image](https://github.com/user-attachments/assets/90219f93-496f-4929-a4a6-de9914ca7800)

**+ Giao diện tính phí vận chuyển** hỗ trợ khách hàng tính toán chi phí vận chuyển dựa trên địa chỉ nhận hàng.

![image](https://github.com/user-attachments/assets/16860215-06ca-44f0-bcc9-9a3ffab59821)
**+ Giao diện đặt hàng** hoàn tất quá trình mua sắm và gửi đơn hàng đến hệ thống xử lý.
![image](https://github.com/user-attachments/assets/08208480-74c4-41ac-8f3d-c48d0c60e589)


1.1.2. Giao diện của quản trị viên
Giao diện quản trị viên được thiết kế chuyên nghiệp với đầy đủ chức năng quản lý hệ thống, giúp quản trị viên dễ dàng điều hành và cập nhật thông tin.

**Giao diện đăng nhập Admin** bảo mật, chỉ cho phép người có quyền truy cập vào trang quản trị.
![image](https://github.com/user-attachments/assets/1addb0d9-314b-453c-a559-7c843c72495a)


![image](https://github.com/user-attachments/assets/0a8f222f-ac6b-4c10-b7d7-6e83ccb2a313)
**Giao diện trang quản trị** t

![image](https://github.com/user-attachments/assets/dc7db013-25ab-4582-bcfe-afdd4418de55)
**Giao diện trang quản lí thêm danh mục** cho phép quản trị viên tạo mới các danh mục sản phẩm.

![image](https://github.com/user-attachments/assets/8c21025c-23b0-4cb2-8f4d-fcc09d5cf984)

**Giao diện trang quản lí liệt kê danh mục sản phẩm** giúp theo dõi và chỉnh sửa các danh mục hiện có.

![image](https://github.com/user-attachments/assets/486e1873-b6de-41d3-bbcd-997226a1ae24)

**Giao diện trang quản lí thêm thương hiệu sản phẩm** cho phép thêm mới các thương hiệu vào hệ thống.

![image](https://github.com/user-attachments/assets/23dfbdb8-9d6d-4e31-92b9-792976c6eab2)
**Giao diện trang quản lí liệt kê thương hiệu sản phẩm** giúp quản trị viên quản lý các thương hiệu đã tạo.

![image](https://github.com/user-attachments/assets/aac01e8e-1172-41df-a84e-d58910a46cf2)
**Giao diện trang quản lí thêm sản phẩm** để thêm mới sản phẩm vào kho hàng.

![image](https://github.com/user-attachments/assets/d26cd4b0-168e-4e2f-bb5d-1abbff01ad30)
**Giao diện trang quản lí liệt kê sản phẩm** giúp xem danh sách và chỉnh sửa thông tin sản phẩm.

![image](https://github.com/user-attachments/assets/73ca5027-43a4-48d7-a2eb-a8cdd3c3bc89)
**Giao diện trang quản lí liệt kê đơn hàng** giúp quản trị viên theo dõi các đơn hàng đã được đặt.

![image](https://github.com/user-attachments/assets/72a6b16e-9a4c-443e-bd65-5a1e727b89fe)

**Giao diện trang quản lí thêm mã giảm giá** cho phép tạo các chương trình khuyến mãi.

![image](https://github.com/user-attachments/assets/32e17926-91f3-4262-af3c-397c171ce7bc)
**Giao diện trang quản lí liệt kê mã giảm giá** giúp quản lý các mã giảm giá hiện có.

![image](https://github.com/user-attachments/assets/7c5855c9-0004-4e82-b6a6-ac19642e1a65)
**Giao diện trang quản lí thêm giá vận chuyển** để cập nhật các mức phí vận chuyển theo vùng miền.

![image](https://github.com/user-attachments/assets/d783fe58-e46f-4128-87b8-df3037db98d4)
