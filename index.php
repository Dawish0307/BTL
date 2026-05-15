<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gia Lai – Đại Ngàn Chạm Biển Xanh</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Pinyon+Script&family=Great+Vibes&family=Cormorant+Garamond:ital,wght@1,300;1,400&display=swap" rel="stylesheet">
</head>
<body>

<!-- ===== NAVIGATION ===== -->
<nav class="navbar" id="navbar">
    <div class="nav-inner">
        <a href="index.php" class="nav-logo">
            <span class="logo-icon">⛰</span>
            <div class="logo-text">
                <span class="logo-main">GIA LAI</span>
                <span class="logo-sub">Đại Ngàn · Biển Xanh</span>
            </div>
        </a>
        <!-- <ul class="nav-links">
            <li><a href="#hero">Trang Chủ</a></li>
            <li><a href="#map">Bản Đồ</a></li>
            <li><a href="#story">Giới thiệu</a></li>
            <li><a href="#destinations">Điểm Đến</a></li>
            <li><a href="#contact">Liên Hệ</a></li>
        </ul> -->
        <ul class="nav-links">
            <li><a href="index.php" class="active">Trang Chủ</a></li>
            <li><a href="api/maps.php">Bản Đồ</a></li>
            <li><a href="about.php">Giới Thiệu</a></li>
            <li><a href="destinations.php">Điểm Đến</a></li>
            <li><a href="contact.php">Liên Hệ</a></li>
        </ul>
        <div class="nav-auth">
            <?php if ($isLoggedIn): ?>
                <!-- hiển thị menu người dùng khi đã đăng nhập -->
            <div class="user-menu">
                <button class="btn-user" id="userMenuBtn">
                    <span class="user-avatar"><?= strtoupper(mb_substr($userName, 0, 1)) ?></span>
                    <span><?= htmlspecialchars($userName) ?></span>
                    <svg width="12" height="12" viewBox="0 0 12 12"><path d="M2 4l4 4 4-4" stroke="currentColor" fill="none" stroke-width="1.5"/></svg>
                </button>
                <div class="user-dropdown" id="userDropdown">
                    <a href="#profile">Hồ Sơ</a>
                    <a href="#" id="logoutBtn">Đăng Xuất</a>
                </div>
            </div>
            <?php else: ?>
            <a href="login.php" class="btn-nav-outline">Đăng Nhập</a>
            <a href="register.php" class="btn-nav-fill">Đăng Ký</a>
            <?php endif; ?>
        </div>
        <button class="nav-toggle" id="navToggle">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- ===== HERO ===== -->
<section class="hero" id="hero">
    <div class="hero-bg">
        <div class="hero-layer layer1"></div>
        <div class="hero-layer layer2"></div>
        <div class="hero-particles" id="particles"></div>
    </div>
    <div class="hero-content">
        <div class="hero-badge">
            <span>✦ Năm Du Lịch Quốc Gia 2026 ✦</span>
        </div>
        <h1 class="hero-title">
            <span class="title-line">Đại Ngàn</span>
            <span class="title-divider">chạm</span>
            <span class="title-line accent">Biển Xanh</span>
        </h1>
        <!-- <p class="hero-subtitle">
            Hành trình kỳ diệu từ núi rừng Tây Nguyên hùng vĩ đến bờ biển<br>
            Quy Nhơn thơ mộng — nơi thiên nhiên và văn hóa hòa quyện làm một
        </p> -->
        <div class="hero-cta">
            <a href="#destinations" class="btn-primary">
                <span>Khám Phá Ngay</span>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 10h12M12 5l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            </a>
            <a href="#story" class="btn-ghost">Câu Chuyện Gia Lai</a>
        </div>
        <div class="hero-stats">
            <div class="stat-item">
                <span class="stat-num">12.4M</span>
                <span class="stat-label">Lượt Khách 2025</span>
            </div>
            <div class="stat-sep"></div>
            <div class="stat-item">
                <span class="stat-num">Top 4</span>
                <span class="stat-label">Điểm Đến Thế Giới</span>
            </div>
            <div class="stat-sep"></div>
            <div class="stat-item">
                <span class="stat-num">2</span>
                <span class="stat-label">Sân Bay</span>
            </div>
        </div>
    </div>
    <div class="hero-scroll">
        <div class="scroll-line"></div>
        <span>Cuộn xuống</span>
    </div>
</section>
<!-- // ===== EVENTS ===== -->
<section class="events-section">
    <div class="events-bg"></div>
    <div class="container">
        <div class="section-header">
            <div class="eh-top-label">
                <span class="eh-dot"></span>
                <span>Sắp diễn ra</span>
                <span class="eh-dot"></span>
            </div>
            <h2 class="section-title">Sự Kiện <em>Nổi Bật</em></h2>
            <p class="section-desc">Những hoạt động đặc sắc trong Năm Du Lịch Quốc Gia 2026</p>
        </div>

        <!-- Countdown tổng -->
        <div class="next-event-banner">
            <div class="neb-left">
                <span class="neb-label">⚡ Sự kiện gần nhất</span>
                <h3>Festival Biển Quy Nhơn 2026</h3>
                <p>📍 Quy Nhơn, Gia Lai</p>
            </div>
            <div class="neb-countdown" id="countdown">
                <div class="cd-item"><span class="cd-num" id="cd-days">00</span><span class="cd-label">Ngày</span></div>
                <div class="cd-sep">:</div>
                <div class="cd-item"><span class="cd-num" id="cd-hours">00</span><span class="cd-label">Giờ</span></div>
                <div class="cd-sep">:</div>
                <div class="cd-item"><span class="cd-num" id="cd-mins">00</span><span class="cd-label">Phút</span></div>
                <div class="cd-sep">:</div>
                <div class="cd-item"><span class="cd-num" id="cd-secs">00</span><span class="cd-label">Giây</span></div>
            </div>
            <a href="contact.php" class="neb-btn">Đăng Ký Ngay →</a>
        </div>

        <!-- Filter -->
        <div class="event-filters">
            <button class="ef-btn active" data-cat="all">Tất Cả</button>
            <button class="ef-btn" data-cat="lehoi">🎉 Lễ Hội</button>
            <button class="ef-btn" data-cat="vanhoa">🥁 Văn Hóa</button>
            <button class="ef-btn" data-cat="thethao">⚽ Thể Thao</button>
            <button class="ef-btn" data-cat="amthuc">🍜 Ẩm Thực</button>
            <button class="ef-btn" data-cat="khampha">🧭 Khám Phá</button>
        </div>

        <!-- Events Grid -->
        <div class="ev-grid" id="evGrid">

            <div class="ev-card ev-featured" data-cat="lehoi">
                <div class="ev-img-wrap">
                    <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=800&q=80" alt="Festival Biển">
                    <div class="ev-overlay"></div>
                    <div class="ev-badge-cat">🎉 Lễ Hội</div>
                    <div class="ev-badge-hot">HOT</div>
                    <div class="ev-date-float">
                        <span class="edf-day">28</span>
                        <span class="edf-month">Tháng 6</span>
                    </div>
                </div>
                <div class="ev-body">
                    <h3>Festival Biển Quy Nhơn 2026</h3>
                    <p>Lễ hội biển lớn nhất miền Trung với văn hóa, thể thao và ẩm thực đặc sắc tại bờ biển Quy Nhơn.</p>
                    <div class="ev-meta">
                        <span>📍 Quy Nhơn</span>
                        <span>🕐 3 ngày</span>
                        <span>👥 Miễn phí</span>
                    </div>
                    <div class="ev-progress">
                        <div class="evp-label"><span>Đăng ký</span><span>87%</span></div>
                        <div class="evp-bar"><div class="evp-fill" style="width:87%"></div></div>
                    </div>
                </div>
            </div>

            <div class="ev-card" data-cat="vanhoa">
                <div class="ev-img-wrap">
                    <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=600&q=80" alt="Cồng Chiêng">
                    <div class="ev-overlay"></div>
                    <div class="ev-badge-cat">🥁 Văn Hóa</div>
                    <div class="ev-date-float">
                        <span class="edf-day">15</span>
                        <span class="edf-month">Tháng 7</span>
                    </div>
                </div>
                <div class="ev-body">
                    <h3>Đêm Cồng Chiêng Tây Nguyên</h3>
                    <p>Di sản UNESCO — âm thanh cồng chiêng huyền ảo dưới bầu trời đêm đại ngàn.</p>
                    <div class="ev-meta">
                        <span>📍 Pleiku</span>
                        <span>🕐 1 đêm</span>
                    </div>
                    <div class="ev-progress">
                        <div class="evp-label"><span>Đăng ký</span><span>64%</span></div>
                        <div class="evp-bar"><div class="evp-fill" style="width:64%"></div></div>
                    </div>
                </div>
            </div>

            <div class="ev-card" data-cat="thethao">
                <div class="ev-img-wrap">
                    <img src="https://images.unsplash.com/photo-1544551763-77ef2d0cfc6c?w=600&q=80" alt="Đua Thuyền">
                    <div class="ev-overlay"></div>
                    <div class="ev-badge-cat">⚽ Thể Thao</div>
                    <div class="ev-date-float">
                        <span class="edf-day">20</span>
                        <span class="edf-month">Tháng 8</span>
                    </div>
                </div>
                <div class="ev-body">
                    <h3>Giải Đua Thuyền Đầm Thị Nại</h3>
                    <p>Giải đua thuyền truyền thống trên Đầm Thị Nại — tinh thần thể thao sôi nổi.</p>
                    <div class="ev-meta">
                        <span>📍 Đầm Thị Nại</span>
                        <span>🕐 2 ngày</span>
                    </div>
                    <div class="ev-progress">
                        <div class="evp-label"><span>Đăng ký</span><span>45%</span></div>
                        <div class="evp-bar"><div class="evp-fill" style="width:45%"></div></div>
                    </div>
                </div>
            </div>

            <div class="ev-card" data-cat="amthuc">
                <div class="ev-img-wrap">
                    <img src="https://images.unsplash.com/photo-1555126634-323283e090fa?w=600&q=80" alt="Ẩm Thực">
                    <div class="ev-overlay"></div>
                    <div class="ev-badge-cat">🍜 Ẩm Thực</div>
                    <div class="ev-date-float">
                        <span class="edf-day">05</span>
                        <span class="edf-month">Tháng 9</span>
                    </div>
                </div>
                <div class="ev-body">
                    <h3>Tinh Hoa Ẩm Thực Gia Lai</h3>
                    <p>60+ gian hàng — từ phở khô Pleiku đến bánh xèo tôm nhảy Quy Nhơn.</p>
                    <div class="ev-meta">
                        <span>📍 Quy Nhơn</span>
                        <span>🕐 4 ngày</span>
                    </div>
                    <div class="ev-progress">
                        <div class="evp-label"><span>Đăng ký</span><span>32%</span></div>
                        <div class="evp-bar"><div class="evp-fill" style="width:32%"></div></div>
                    </div>
                </div>
            </div>

            <div class="ev-card" data-cat="khampha">
                <div class="ev-img-wrap">
                    <img src="https://images.unsplash.com/photo-1559494007-9f5847c49d94?w=600&q=80" alt="Biển Đảo">
                    <div class="ev-overlay"></div>
                    <div class="ev-badge-cat">🧭 Khám Phá</div>
                    <div class="ev-date-float">
                        <span class="edf-day">12</span>
                        <span class="edf-month">Tháng 10</span>
                    </div>
                </div>
                <div class="ev-body">
                    <h3>Tuần Lễ Biển Đảo Gia Lai</h3>
                    <p>Cù Lao Xanh, Hòn Khô, Eo Gió — lặn biển và trải nghiệm làng chài hoang sơ.</p>
                    <div class="ev-meta">
                        <span>📍 Các đảo Quy Nhơn</span>
                        <span>🕐 7 ngày</span>
                    </div>
                    <div class="ev-progress">
                        <div class="evp-label"><span>Đăng ký</span><span>28%</span></div>
                        <div class="evp-bar"><div class="evp-fill" style="width:28%"></div></div>
                    </div>
                </div>
            </div>

            <div class="ev-card" data-cat="vanhoa">
                <div class="ev-img-wrap">
                    <img src="https://images.unsplash.com/photo-1548013146-72479768bada?w=600&q=80" alt="Chăm Pa">
                    <div class="ev-overlay"></div>
                    <div class="ev-badge-cat">🏛 Di Sản</div>
                    <div class="ev-date-float">
                        <span class="edf-day">18</span>
                        <span class="edf-month">Tháng 11</span>
                    </div>
                </div>
                <div class="ev-body">
                    <h3>Hành Trình Chăm Pa</h3>
                    <p>Tháp Đôi, Bánh Ít, Dương Long — hành trình di sản ngàn năm trên đất Bình Định.</p>
                    <div class="ev-meta">
                        <span>📍 Bình Định</span>
                        <span>🕐 2 ngày</span>
                    </div>
                    <div class="ev-progress">
                        <div class="evp-label"><span>Đăng ký</span><span>19%</span></div>
                        <div class="evp-bar"><div class="evp-fill" style="width:19%"></div></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-logo">⛰ GIA LAI TOURISM</div>
                <p>Năm Du Lịch Quốc Gia 2026<br>"Đại Ngàn Chạm Biển Xanh"</p>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook">f</a>
                    <a href="#" aria-label="Instagram">in</a>
                    <a href="#" aria-label="YouTube">▶</a>
                </div>
            </div>
            <div class="footer-links">
                <h4>Điểm Đến</h4>
                <ul>
                    <li><a href="#">Eo Gió - Kỳ Co</a></li>
                    <li><a href="#">Ghềnh Ráng Tiên Sa</a></li>
                    <li><a href="#">Hòn Khô - Nhơn Hải</a></li>
                    <li><a href="#">Cù Lao Xanh</a></li>
                    <li><a href="#">Tháp Đôi Quy Nhơn</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Hỗ Trợ</h4>
                <ul>
                    <li><a href="#">Lên Kế Hoạch Tour</a></li>
                    <li><a href="#">Đặt Phòng Khách Sạn</a></li>
                    <li><a href="#">Thuê Xe Di Chuyển</a></li>
                    <li><a href="#">Hướng Dẫn Du Lịch</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Pháp Lý</h4>
                <ul>
                    <li><a href="#">Chính Sách Bảo Mật</a></li>
                    <li><a href="#">Điều Khoản Sử Dụng</a></li>
                    <li><a href="login.php">Đăng Nhập</a></li>
                    <li><a href="register.php">Đăng Ký</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 Gia Lai Tourism. Bản quyền thuộc Sở Du Lịch tỉnh Gia Lai.</p>
        </div>
    </div>
</footer>

<!-- ===== NOTIFICATION ===== -->
<div class="toast" id="toast"></div>

<script src="js/main.js"></script>
</body>
</html>
