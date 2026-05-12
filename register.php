<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php'); exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký – Gia Lai Tourism</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/auth.css">
</head>
<body class="auth-body">

<div class="auth-page auth-register">
    <div class="auth-left">
        <div class="auth-left-content">
            <a href="index.php" class="auth-logo">
                <span>⛰</span>
                <div>
                    <strong>GIA LAI</strong>
                    <small>Đại Ngàn · Biển Xanh</small>
                </div>
            </a>
            <div class="auth-hero-text">
                <h2>Tham Gia<br>Hành Trình</h2>
                <p>Tạo tài khoản miễn phí để bắt đầu hành trình khám phá vùng đất nơi đại ngàn chạm biển xanh.</p>
            </div>
            <div class="auth-features">
                <div class="af-item"><span>🗺</span><span>Lên kế hoạch du lịch cá nhân</span></div>
                <div class="af-item"><span>💬</span><span>Chia sẻ cảm nhận & kinh nghiệm</span></div>
                <div class="af-item"><span>🎁</span><span>Nhận ưu đãi dành riêng cho thành viên</span></div>
            </div>
            <div class="auth-deco">
                <div class="deco-wave deco-wave-green"></div>
            </div>
        </div>
    </div>

    <div class="auth-right">
        <div class="auth-card">
            <div class="auth-card-header">
                <h1>Tạo Tài Khoản</h1>
                <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
            </div>

            <form id="registerForm" class="auth-form" novalidate>
                <div class="form-row-2">
                    <div class="input-group">
                        <label for="full_name">Họ và Tên <span class="required">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon">👤</span>
                            <input type="text" id="full_name" name="full_name" placeholder="Nguyễn Văn A" required>
                        </div>
                        <span class="field-error" id="nameError"></span>
                    </div>
                    <div class="input-group">
                        <label for="phone">Số Điện Thoại</label>
                        <div class="input-wrap">
                            <span class="input-icon">📱</span>
                            <input type="tel" id="phone" name="phone" placeholder="0912 345 678">
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <label for="reg_email">Email <span class="required">*</span></label>
                    <div class="input-wrap">
                        <span class="input-icon">✉</span>
                        <input type="email" id="reg_email" name="email" placeholder="email@example.com" required>
                    </div>
                    <span class="field-error" id="regEmailError"></span>
                </div>

                <div class="form-row-2">
                    <div class="input-group">
                        <label for="reg_password">Mật Khẩu <span class="required">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon">🔒</span>
                            <input type="password" id="reg_password" name="password" placeholder="Tối thiểu 6 ký tự" required>
                            <button type="button" class="toggle-pw" data-target="reg_password">👁</button>
                        </div>
                        <div class="pw-strength" id="pwStrength">
                            <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                            <span id="strengthText"></span>
                        </div>
                        <span class="field-error" id="regPasswordError"></span>
                    </div>
                    <div class="input-group">
                        <label for="confirm_password">Xác Nhận Mật Khẩu <span class="required">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon">🔒</span>
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
                            <button type="button" class="toggle-pw" data-target="confirm_password">👁</button>
                        </div>
                        <span class="field-error" id="confirmError"></span>
                    </div>
                </div>

                <label class="checkbox-wrap terms-wrap">
                    <input type="checkbox" name="terms" id="terms" required>
                    <span>Tôi đồng ý với <a href="#">Điều Khoản Sử Dụng</a> và <a href="#">Chính Sách Bảo Mật</a></span>
                </label>
                <span class="field-error" id="termsError"></span>

                <button type="submit" class="btn-auth" id="registerBtn">
                    <span class="btn-text">Tạo Tài Khoản</span>
                    <span class="btn-loader hidden">⟳</span>
                </button>
            </form>
        </div>
    </div>
</div>

<div class="toast" id="toast"></div>
<script src="js/auth.js"></script>
</body>
</html>
