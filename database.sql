-- =====================================================
-- GIALAI TOURISM DATABASE SETUP
-- Chạy file này trong phpMyAdmin hoặc MySQL Console
-- =====================================================

CREATE DATABASE IF NOT EXISTS gialai_tourism 
    CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci;

USE gialai_tourism;

-- Bảng người dùng
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    avatar VARCHAR(255) DEFAULT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng địa điểm du lịch
CREATE TABLE IF NOT EXISTS destinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    region ENUM('bien', 'rung', 'lichsu') NOT NULL,
    location VARCHAR(200),
    description TEXT,
    image_url VARCHAR(500),
    rating DECIMAL(2,1) DEFAULT 4.5,
    visit_count INT DEFAULT 0,
    featured TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng bình luận / đánh giá
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    destination_id INT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (destination_id) REFERENCES destinations(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dữ liệu mẫu - địa điểm du lịch Quy Nhơn
INSERT INTO destinations (name, slug, region, location, description, image_url, rating, featured) VALUES
('Eo Gió - Kỳ Co', 'eo-gio-ky-co', 'bien', 'Xã Nhơn Lý, Quy Nhơn', 'Eo Gió – Kỳ Co nổi tiếng với làn nước trong xanh màu ngọc bích, những đồng cỏ xanh rì bám quanh eo biển, nơi có những vách núi đá cao và kỳ vĩ. Được ví như Maldives của Việt Nam.', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800', 4.9, 1),
('Ghềnh Ráng Tiên Sa', 'ghenh-rang-tien-sa', 'bien', 'Cách TT Quy Nhơn 3km, hướng Đông Nam', 'Quần thể bao gồm bãi đá Ghềnh Ráng kỳ thú, bãi tắm Hoàng Hậu, bãi Tiên Sa thơ mộng và khu mộ thi sĩ Hàn Mặc Tử. Vé tham quan miễn phí.', 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800', 4.7, 1),
('Hòn Khô - Làng chài Nhơn Hải', 'hon-kho-nhon-hai', 'bien', 'Xã Nhơn Hải, Quy Nhơn', 'Hòn đảo nhỏ hoang sơ với con đường dài 500m giữa biển khi nước rút, kết nối làng chài Nhơn Hải. Nước biển trong xanh, lý tưởng cho lặn ngắm san hô.', 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800', 4.8, 1),
('Cù Lao Xanh', 'cu-lao-xanh', 'bien', 'Biển Quy Nhơn', 'Hòn đảo hoang sơ giữa biển khơi với làn nước trong vắt, bãi cát trắng mịn. Điểm check-in nổi tiếng với cầu cảng gỗ vươn ra biển được ví như Maldives thu nhỏ.', 'https://images.unsplash.com/photo-1559494007-9f5847c49d94?w=800', 4.8, 1),
('Đồi Cát Phương Mai', 'doi-cat-phuong-mai', 'bien', 'Bán đảo Phương Mai, Quy Nhơn', 'Được mệnh danh là "Sahara" của Quy Nhơn, đồi cát Phương Mai trải dài hàng chục kilômét với cát mịn vàng óng, phía xa là trời xanh và biển cả bao la.', 'https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=800', 4.6, 0),
('Đầm Thị Nại', 'dam-thi-nai', 'bien', 'Quy Nhơn, Gia Lai', 'Vùng nước mặn rộng lớn như một bức tranh thủy mặc sống động. Du khách có thể chèo SUP, thả lưới, ngắm chim trời và thưởng thức hải sản tươi sống giữa thiên nhiên hoang sơ.', 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=800', 4.7, 0),
('Tháp Đôi Quy Nhơn', 'thap-doi-quy-nhon', 'lichsu', 'Trung tâm Quy Nhơn', 'Di tích Chăm Pa cổ kính được xây dựng từ cuối thế kỷ 11 - đầu thế kỷ 13. Một trong những biểu tượng lịch sử - văn hóa đặc sắc nhất của vùng đất Bình Định.', 'https://images.unsplash.com/photo-1528360983277-13d401cdc186?w=800', 4.5, 1),
('Tháp Bánh Ít', 'thap-banh-it', 'lichsu', 'Huyện Tuy Phước, Gia Lai', 'Cụm tháp Chăm Pa tọa lạc trên đồi cao với tầm nhìn bao quát toàn tỉnh. Là một trong những công trình kiến trúc cổ ấn tượng nhất còn được bảo tồn tốt tại Việt Nam.', 'https://images.unsplash.com/photo-1548013146-72479768bada?w=800', 4.6, 0),
('Bảo Tàng Quang Trung Tây Sơn', 'bao-tang-quang-trung', 'lichsu', 'Huyện Tây Sơn, Gia Lai', 'Nơi lưu giữ hiện vật quý giá tái hiện thời kỳ hào hùng của vua Quang Trung - Nguyễn Huệ. Điểm đến không thể bỏ lỡ cho những ai muốn hiểu lịch sử hào khí Tây Sơn.', 'https://images.unsplash.com/photo-1532274402911-5a369e4c4bb5?w=800', 4.7, 1),
('Bãi Xép - Làng Chài', 'bai-xep-lang-chai', 'bien', 'Quy Hòa, Quy Nhơn', 'Làng chài yên bình với bờ cát vàng mịn, rặng đá tự nhiên nhô lên mặt nước. Hơi thở cuộc sống ngư dân đậm chất miền biển, lý tưởng cho nhiếp ảnh và trải nghiệm văn hóa.', 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800', 4.5, 0);

-- Dữ liệu mẫu - tài khoản admin
INSERT INTO users (full_name, email, password, role) VALUES
('Quản trị viên', 'admin@gialai-tourism.vn', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
-- Mật khẩu admin mặc định: password
