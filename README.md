# tn-da20tta-tranphucvi-xaydungwebsitebantbdt-manguonmo
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

[![Open in Visual Studio Code](https://img.shields.io/static/v1?logo=visualstudiocode&label=&message=Open%20in%20Visual%20Studio%20Code&labelColor=2c2c32&color=007acc&logoColor=007acc)](https://open.vscode.dev/microsoft/Web-Dev-For-Beginners)


## Mục Tiêu
Dự án này nhằm phát triển một website bán thiết bị tin học với các tính năng tiên tiến như:
- Hỗ trợ nhiều phương thức thanh toán
- Xét duyệt đơn hàng
- In hóa đơn bán hàng
- Gửi email xác nhận đơn hàng
- Đánh giá sản phẩm sau khi nhận hàng
- Phân quyền quản trị hệ thống
- Đề xuất sản phẩm thường được mua kèm
- Đề xuất sản phẩm trong khi tìm kiếm
- Hệ thống hỗ trợ thông minh (Chatbot AI)
- Chat trực tiếp với nhân viên

## Kiến Trúc
Dự án sử dụng Laravel Framework. Các thành phần chính của hệ thống bao gồm:
- **Laravel**: Quản lý backend, xử lý logic, và kết nối cơ sở dữ liệu.
- **MySQL**: Lưu trữ dữ liệu sản phẩm, đơn hàng và người dùng.
- **Composer**: Quản lý các thư viện PHP cần thiết.

## Phần Mềm Cần Thiết
Để triển khai dự án, bạn cần cài đặt các phần mềm sau:
- PHP phiên bản 7.3 đến 8.0
- Composer
- MySQL

## Cách Thức Chạy Chương Trình

### Cài Đặt
1. **Cài đặt PHP và Composer**:
   - Cài đặt PHP phiên bản từ 7.3 đến 8.0.
   - Cài đặt Composer.

2. **Tải dự án từ GitHub**:
    ```sh
    https://github.com/NgoTanLoi01/tn-da20tta-110120166-ngotanloi-phattrienwebsitebtbth.git
    ```

3. **Thiết lập dự án**:
    ```sh
    composer install
    composer update
    ```

### Chạy Dự Án
1. **Xóa liên kết tượng trưng cũ trong thư mục công khai của Laravel**:
    ```sh
    Remove-Item -Recurse -Force public\storage
    ```

2. **Tạo liên kết tượng trưng mới trong thư mục công khai của Laravel**:
    ```sh
    php artisan storage:link
    ```

3. **Tạo bảng cơ sở dữ liệu**:
    ```sh
    php artisan migrate:fresh --seed
    ```

4. **Khởi động dự án Laravel**:
    ```sh
    php artisan serve
    ```

5. **Truy cập địa chỉ localhost xuất hiện**:
    ```sh
    http://127.0.0.1:8000/
    ```

## Thông Tin Liên Hệ Tác Giả
