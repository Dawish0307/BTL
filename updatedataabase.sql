-- BƯỚC 1: Thêm cột (dùng IF NOT EXISTS để không bị lỗi nếu cột đã có)
-- Chạy từng câu một nếu phpMyAdmin báo lỗi "Duplicate column"
 
ALTER TABLE destinations
    ADD COLUMN IF NOT EXISTS lat DECIMAL(10,7) DEFAULT NULL
        COMMENT 'Vĩ độ GPS (latitude)';
 
ALTER TABLE destinations
    ADD COLUMN IF NOT EXISTS lng DECIMAL(10,7) DEFAULT NULL
        COMMENT 'Kinh độ GPS (longitude)';
 
-- BƯỚC 2: Cập nhật toạ độ theo slug
-- slug là định danh duy nhất, thay thế cho id khi tìm kiếm theo tên
 
UPDATE destinations SET lat = 13.9012300, lng = 109.2687600 WHERE slug = 'eo-gio-ky-co';
UPDATE destinations SET lat = 13.7455600, lng = 109.2456700 WHERE slug = 'ghenh-rang-tien-sa';
UPDATE destinations SET lat = 13.8612300, lng = 109.2834500 WHERE slug = 'hon-kho-nhon-hai';
UPDATE destinations SET lat = 13.6198000, lng = 109.3589000 WHERE slug = 'cu-lao-xanh';
UPDATE destinations SET lat = 13.8234500, lng = 109.2901200 WHERE slug = 'doi-cat-phuong-mai';
UPDATE destinations SET lat = 13.8456700, lng = 109.1723400 WHERE slug = 'dam-thi-nai';
UPDATE destinations SET lat = 13.7289000, lng = 109.2378900 WHERE slug = 'bai-xep-lang-chai';
UPDATE destinations SET lat = 13.786265456299319, lng = 109.21100192902152 WHERE slug = 'thap-doi-quy-nhon';
UPDATE destinations SET lat = 13.7034500, lng = 109.0823400 WHERE slug = 'thap-banh-it';
UPDATE destinations SET lat = 13.920624027766165, lng = 108.92085142421313 WHERE slug = 'bao-tang-quang-trung';
 
-- Kiểm tra kết quả sau khi UPDATE
-- Chạy câu này để xem toạ độ đã được lưu chưa:
-- SELECT name, slug, lat, lng FROM destinations;
 
-- =====================================================
-- CẬP NHẬT maps.php SAU KHI CHẠY SQL NÀY:
--
-- Vì database đã có lat/lng, trong maps.php bạn chỉ cần:
--   SELECT id, name, slug, region, location,
--          description, image_url, rating, lat, lng
--   FROM destinations
--
-- Và XOÁ PHẦN $coords trong PHP vì không cần nữa.
-- =====================================================
 






























