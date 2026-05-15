# 🏔 GIA LAI TOURISM WEBSITE
## Đại Ngàn Chạm Biển Xanh — Năm Du Lịch Quốc Gia 2026

---

## 📁 Cấu Trúc Thư Mục

```
gialai_tourism/
├── index.php           ← Trang chủ
├── login.php           ← Trang đăng nhập
├── register.php        ← Trang đăng ký
├── database.sql        ← Script tạo CSDL
├── config/
│   └── database.php    ← Cấu hình kết nối MySQL
├── api/
│   ├── auth.php        ← API đăng nhập / đăng ký / đăng xuất
│   └── destinations.php← API danh sách địa điểm
│   ├── maps.php        ← bản đồ gồm các địa điểm
├── css/
│   ├── style.css       ← CSS trang chủ
│   └── auth.css        ← CSS trang xác thực
└── js/
    ├── main.js         ← JS trang chủ
    └── auth.js         ← JS form đăng nhập/đăng ký
```

---

## 🚀 Hướng Dẫn Cài Đặt (XAMPP)

### Bước 1: Sao chép vào XAMPP
Sao chép toàn bộ thư mục `gialai_tourism` vào:
```
C:\xampp\htdocs\gialai_tourism\
```

### Bước 2: Khởi động XAMPP
- Mở **XAMPP Control Panel**
- Start **Apache**
- Start **MySQL**

### Bước 3: Tạo cơ sở dữ liệu
1. Mở trình duyệt, vào: `http://localhost/phpmyadmin`
2. Click **"New"** → Tạo database mới tên `gialai_tourism`
3. Chọn database vừa tạo → Tab **SQL**
4. Copy toàn bộ nội dung file `database.sql` và dán vào
5. Click **"Go"** để chạy

### Bước 4: Kiểm tra kết nối (nếu cần)
Mở file `config/database.php` và chỉnh sửa nếu XAMPP của bạn dùng mật khẩu khác:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');     // Mặc định XAMPP để trống
define('DB_NAME', 'gialai_tourism');
```

### Bước 5: Truy cập website
- **Trang chủ:**    `http://localhost/gialai_tourism/`
- **Đăng nhập:**   `http://localhost/gialai_tourism/login.php`
- **Đăng ký:**     `http://localhost/gialai_tourism/register.php`

---

## 🔑 Tài Khoản Demo

| Email | Mật khẩu | Vai trò |
|-------|----------|---------|
| admin@gialai-tourism.vn | password | Admin |

---

## ✨ Tính Năng

- **Trang chủ:** Hero section, câu chuyện Gia Lai, địa điểm du lịch, form liên hệ
- **Đăng nhập:** Xác thực email + mật khẩu, session PHP
- **Đăng ký:** Validation đầy đủ, kiểm tra trùng email, password strength
- **Địa điểm:** 10 địa danh nổi tiếng Quy Nhơn / Bình Định (thuộc Gia Lai mới)
- **Responsive:** Tương thích mobile, tablet, desktop
- **Bảo mật:** Password hashing bcrypt, prepared statements MySQL

---

## 📞 Hỗ Trợ
Website du lịch Gia Lai — Năm Du Lịch Quốc Gia 2026
"Đại Ngàn Chạm Biển Xanh"
