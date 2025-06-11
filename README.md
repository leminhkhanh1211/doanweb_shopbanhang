# Shop Bán Đồ Decor Phòng
Ứng dụng web bán đồ decor phòng, giúp người dùng dễ dàng mua sắm và quản lý đơn hàng.

## Cài đặt
1. Clone repo: `git clone https://github.com/leminhkhanh1211/doanweb_shopbanhang`  
2. Chạy `composer install` để cài dependencies  
3. Thiết lập `.env` theo file mẫu `.env.example`  
4. Chạy `php artisan migrate` để tạo database  
5. Khởi động server: `php artisan serve`

## Tính năng
- Khách hàng: 
 1. Tìm kiếm các sản phẩm decor.
 2. Liên hệ 
 3. Đặt mua và thanh toán sản phẩm.
 4. Viết đánh giá hoặc phản hồi về sản phẩm.
 5. Xem tin tức
- Quản trị viên:
 1. Quản lý khách hàng.
 2. Quản lý slider.
 3. Quản lý đơn hàng.
 4. Quản lý mã giảm giá.
 5. Quản lý vận chuyển.
 6. Quản lý danh mục.
 7. Quản lý thương hiệu.
 8. Quản lý sản phẩm.

### Công Nghệ
- PHP (Laravel)
- Blade
- CSS
- JavaScript
- HTML
  
#### Giao diện của ứng dụng
# Giao diện của khách hàng
Giao diện của khách hàng được thiết kế thân thiện và dễ sử dụng, giúp người dùng có thể dễ dàng thực hiện các thao tác mua sắm trên website.
 
**+ Giao diện trang chủ** hiển thị các sản phẩm nổi bật và các danh mục chính, giúp khách hàng dễ dàng tìm kiếm sản phẩm.

![image](https://github.com/user-attachments/assets/7913eec0-00d4-4ed4-ac94-e86d9f21f1ef)

**+ Giao diện đăng nhập** cho phép khách hàng đăng nhập vào hệ thống để quản lý tài khoản và đặt hàng.

![image](https://github.com/user-attachments/assets/f8d3cc94-7377-49e1-b2e6-0d53f62aff60)

**+ Giao diện đăng kí** cho phép khách hàng tạo tài khoản mới một cách nhanh chóng và thuận tiện.

![image](https://github.com/user-attachments/assets/00896240-376f-4114-9a80-97c5e70a07dc)
**+ Giao diện xem tin tức** cho phép khách hàng xem danh sách các bài viết theo từng danh mục.

![image](https://github.com/user-attachments/assets/d16f87f8-dea7-4dcc-8f4a-29a69b643963)

**+ Giao diện xem chi tiết tin tức** cung cấp đầy đủ thông tin về bài viết.

![image](https://github.com/user-attachments/assets/52012a04-08c8-47eb-b62e-46bb9719035f)

**+ Giao diện xem sản phẩm** cho phép khách hàng xem danh sách các sản phẩm theo từng danh mục.

![image](https://github.com/user-attachments/assets/3bf674d4-a877-40e6-976e-d357f9018455)

**+ Giao diện xem chi tiết sản phẩm** cung cấp đầy đủ thông tin về sản phẩm bao gồm hình ảnh, mô tả, giá cả và đánh giá.

![image](https://github.com/user-attachments/assets/569f795d-345a-4e78-9e1c-e9952ab6c3e4)
**+ Giao diện gửi bình luận/đánh giá sản phẩm** cho phép người dùng gửi đánh giá sản phẩm .

![image](https://github.com/user-attachments/assets/2f0ea4e7-47e8-457e-8034-a67c10201661)

**+ Giao diện giỏ hàng** giúp khách hàng quản lý các sản phẩm đã chọn trước khi tiến hành đặt hàng.

![image](https://github.com/user-attachments/assets/bcf3c820-7eb0-450a-b8bf-eca4dec01488)

**+ Giao diện xác nhận thông tin đơn hàng** để khách hàng kiểm tra lại các chi tiết trước khi thanh toán.

![image](https://github.com/user-attachments/assets/90219f93-496f-4929-a4a6-de9914ca7800)

**+ Giao diện đặt hàng** hoàn tất quá trình mua sắm và gửi đơn hàng đến hệ thống xử lý.
![image](https://github.com/user-attachments/assets/08208480-74c4-41ac-8f3d-c48d0c60e589)


1.1.2. Giao diện của quản trị viên
Giao diện quản trị viên được thiết kế chuyên nghiệp với đầy đủ chức năng quản lý hệ thống, giúp quản trị viên dễ dàng điều hành và cập nhật thông tin.

**Giao diện đăng nhập Admin** bảo mật, chỉ cho phép người có quyền truy cập vào trang quản trị.

![image](https://github.com/user-attachments/assets/1addb0d9-314b-453c-a559-7c843c72495a)

**Giao diện trang quản lí bình luận** cho phép quản trị viên duyệt bình luận , trả lời bình luận 

![image](https://github.com/user-attachments/assets/ee902d2c-177c-458b-aa5d-7e200878c1da)

**Giao diện trang quản lí thêm Slider** cho phép quản trị viên tạo mới các Slider.

![image](https://github.com/user-attachments/assets/c8273b5a-7de3-4ac7-b732-d61644c77cc9)

**Giao diện trang quản lí liệt kê Slider** cho phép quản trị viên quản lý các Slider đã tạo.

![image](https://github.com/user-attachments/assets/660c2ca6-d31b-4bb4-a42b-b8bdd4bfab1f)

**Giao diện trang quản lí thêm danh mục sản phẩm** cho phép quản trị viên tạo mới các danh mục sản phẩm.

![image](https://github.com/user-attachments/assets/8c21025c-23b0-4cb2-8f4d-fcc09d5cf984)

**Giao diện trang quản lí liệt kê danh mục sản phẩm** giúp theo dõi và chỉnh sửa các danh mục hiện có.

![image](https://github.com/user-attachments/assets/e27dfbf8-1ca0-4e89-a4ea-24f1649bf480)

**Giao diện trang quản lí thêm danh mục bài viết** cho phép quản trị viên tạo mới các danh mục bài viết

![image](https://github.com/user-attachments/assets/486e1873-b6de-41d3-bbcd-997226a1ae24)

**Giao diện trang quản lí liệt kê danh mục bài viết** cho phép quản trị viên quản lý các danh mục bài viết đã tạo

![image](https://github.com/user-attachments/assets/04233ce2-f68d-4f54-911c-432ede02a0c1)

**Giao diện trang quản lí thêm bài viết** cho phép quản trị viên tạo mới các bài viết

![image](https://github.com/user-attachments/assets/a2df918f-f8e4-4292-b982-dc5a4f79bd33)

**Giao diện trang quản lí liệt kê bài viết** cho phép quản trị viên quản lý các bài viết đã tạo

![image](https://github.com/user-attachments/assets/6040493f-665c-4759-9de1-ba1a9b85c250)

**Giao diện trang quản lí thêm thương hiệu sản phẩm** cho phép thêm mới các thương hiệu vào hệ thống.

![image](https://github.com/user-attachments/assets/06e7e3d8-4202-4a5d-ac66-eae943d43924)

**Giao diện trang quản lí liệt kê thương hiệu sản phẩm** giúp quản trị viên quản lý các thương hiệu đã tạo.

![image](https://github.com/user-attachments/assets/f79632da-acbd-49c4-bc91-206294b90827)

**Giao diện trang quản lí thêm sản phẩm** để thêm mới sản phẩm vào kho hàng.

![image](https://github.com/user-attachments/assets/6d581530-57e9-4668-b0e2-0d1cefaf7801)

**Giao diện trang quản lí liệt kê sản phẩm** giúp xem danh sách và chỉnh sửa thông tin sản phẩm.

![image](https://github.com/user-attachments/assets/2f567b90-9e96-4d47-b2f1-710fc15c938a)

**Giao diện trang quản lí liệt kê đơn hàng** giúp quản trị viên theo dõi các đơn hàng đã được đặt.

![image](https://github.com/user-attachments/assets/72a6b16e-9a4c-443e-bd65-5a1e727b89fe)

**Giao diện trang quản lí thêm mã giảm giá** cho phép tạo các chương trình khuyến mãi.

![image](https://github.com/user-attachments/assets/2b404cf1-4f3b-45a5-a25a-fbd31f647964)

**Giao diện trang quản lí liệt kê mã giảm giá** giúp quản lý các mã giảm giá hiện có.

![image](https://github.com/user-attachments/assets/56a1af43-86d1-4c91-a552-1c622cbdbdfb)

**Giao diện trang quản lí thêm giá vận chuyển** để cập nhật các mức phí vận chuyển theo vùng miền.

![image](https://github.com/user-attachments/assets/db7eb225-ffb8-4c07-9b92-acaefcc72f35)

**Giao diện trang quản lí thêm User** cho phép thêm mới các user.

![image](https://github.com/user-attachments/assets/3d4e7fdb-6517-47f7-b117-c5972d4faa28)

**Giao diện trang quản lí User** giúp quản lý các user hiện có.

![image](https://github.com/user-attachments/assets/b8ff5121-db45-483f-872d-e5fc440e5a35)


