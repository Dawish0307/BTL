<?php session_start(); $isLoggedIn = isset($_SESSION['user_id']); $userName = $_SESSION['user_name'] ?? ''; $avatarLetter = strtoupper(mb_substr($userName, 0, 1)); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu – Gia Lai Tourism</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/about.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
    <div class="nav-inner">
        <a href="index.php" class="nav-logo">
            <span class="logo-icon">⛰</span>
            <div class="logo-text">
                <span class="logo-main">GIA LAI</span>
                <span class="logo-sub">Đại Ngàn · Biển Xanh</span>
            </div>
        </a>
        <ul class="nav-links">
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="map.php">Bản Đồ</a></li>
            <li><a href="about.php" class="nav-active">Giới Thiệu</a></li>
            <li><a href="destinations.php">Điểm Đến</a></li>
            <li><a href="contact.php">Liên Hệ</a></li>
        </ul>
        <div class="nav-auth">
            <?php if ($isLoggedIn): ?>
            <div class="user-menu">
                <button class="btn-user" id="userMenuBtn">
                    <span class="user-avatar"><?= $avatarLetter ?></span>
                    <span><?= htmlspecialchars($userName) ?></span>
                    <svg width="12" height="12" viewBox="0 0 12 12"><path d="M2 4l4 4 4-4" stroke="currentColor" fill="none" stroke-width="1.5"/></svg>
                </button>
                <div class="user-dropdown" id="userDropdown">
                    <a href="profile.php">Hồ Sơ</a>
                    <a href="#" id="logoutBtn">Đăng Xuất</a>
                </div>
            </div>
            <?php else: ?>
            <a href="login.php" class="btn-nav-outline">Đăng Nhập</a>
            <a href="register.php" class="btn-nav-fill">Đăng Ký</a>
            <?php endif; ?>
        </div>
        <button class="nav-toggle" id="navToggle"><span></span><span></span><span></span></button>
    </div>
</nav>

<!-- ===== HERO ===== -->
<section class="about-hero">
    <div class="ah-bg">
        <div class="ah-layer1"></div>
        <div class="ah-layer2"></div>
    </div>
    <div class="ah-content">
        <span class="ah-tag">✦ Năm Du Lịch Quốc Gia 2026 ✦</span>
        <h1>Về Vùng Đất<br><em>Đại Ngàn Chạm Biển Xanh</em></h1>
        <p>Hành trình khám phá tỉnh Gia Lai — nơi đại ngàn Tây Nguyên hùng vĩ<br>gặp gỡ bờ biển Quy Nhơn xanh trong thơ mộng</p>
    </div>
    <div class="ah-scroll-hint">
        <div class="ah-mouse"><div class="ah-wheel"></div></div>
    </div>
</section>

<!-- ===== INTRO DẠNG SPLIT ===== -->
<section class="intro-split">
    <div class="container">
        <div class="is-grid">
            <div class="is-visual">
                <div class="is-img-main">
                    <img src="images/p4.jpg" alt="Biển Quy Nhơn" loading="lazy">
                    <div class="is-img-label">Biển Quy Nhơn — Top 4 Thế Giới 2026</div>
                </div>
                <div class="is-img-sub">
                    <img src="images/p3.jpg" alt="Đại ngàn" loading="lazy">
                    <div class="is-img-label">Đại Ngàn Tây Nguyên</div>
                </div>
                <div class="is-float-card">
                    <span class="ifc-icon">🌿</span>
                    <div>
                        <strong>UNESCO</strong>
                        <small>Khu Dự Trữ Sinh Quyển Kon Hà Nừng</small>
                    </div>
                </div>
            </div>
            <div class="is-text">
                <span class="section-tag">Câu Chuyện Của Đất</span>
                <h2 class="section-title">Hai Vùng Đất,<br><em>Một Linh Hồn</em></h2>
                <p class="is-lead">Năm 2025, tỉnh Gia Lai và Bình Định chính thức hợp nhất tạo nên một vùng đất phi thường — nơi đại ngàn Tây Nguyên chạm vào biển xanh Nam Trung Bộ.</p>
                <p class="is-body">Từ không gian văn hóa cồng chiêng huyền bí, những buôn làng ngàn năm tuổi đến "đất võ trời văn" Bình Định với di sản Chăm Pa nghìn năm và hào khí Tây Sơn vang dội — Gia Lai mới mang trong mình hai linh hồn, một tầm nhìn vươn xa.</p>
                <p class="is-body">Với diện tích hơn 20.000 km² và đường bờ biển dài 134km, đây là một trong những tỉnh có cảnh quan đa dạng và phong phú nhất Việt Nam.</p>
                <div class="is-highlights">
                    <div class="ish-item">
                        <span class="ish-num">20.000+</span>
                        <span class="ish-label">km² diện tích</span>
                    </div>
                    <div class="ish-item">
                        <span class="ish-num">134km</span>
                        <span class="ish-label">đường bờ biển</span>
                    </div>
                    <div class="ish-item">
                        <span class="ish-num">38</span>
                        <span class="ish-label">dân tộc anh em</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== TIMELINE SÁP NHẬP ===== -->
<section class="timeline-section">
    <div class="tl-bg"></div>
    <div class="container">
        <div class="section-header" style="text-align:center; margin-bottom:60px;">
            <span class="section-tag" style="color:var(--seafoam)">Lịch Sử</span>
            <h2 class="section-title" style="color:white">Hành Trình <em>Hợp Nhất</em></h2>
            <p class="section-desc" style="color:rgba(255,255,255,0.55)">Từ hai vùng đất riêng biệt đến một tỉnh thành thống nhất</p>
        </div>
        <div class="timeline">
            <div class="tl-item left" data-aos>
                <div class="tl-dot"></div>
                <div class="tl-card">
                    <span class="tl-year">Thế kỷ 11–13</span>
                    <h3>Vương Quốc Chăm Pa</h3>
                    <p>Bình Định là trung tâm của vương quốc Chăm Pa hưng thịnh. Những công trình tháp Chăm kỳ vĩ được xây dựng, nhiều tháp còn tồn tại đến ngày nay.</p>
                </div>
            </div>
            <div class="tl-item right" data-aos>
                <div class="tl-dot"></div>
                <div class="tl-card">
                    <span class="tl-year">1771</span>
                    <h3>Khởi Nghĩa Tây Sơn</h3>
                    <p>Ba anh em Nguyễn Nhạc, Nguyễn Huệ, Nguyễn Lữ dấy binh tại đất Tây Sơn — Bình Định, mở ra trang sử hào hùng của dân tộc Việt Nam.</p>
                </div>
            </div>
            <div class="tl-item left" data-aos>
                <div class="tl-dot"></div>
                <div class="tl-card">
                    <span class="tl-year">1975</span>
                    <h3>Tỉnh Gia Lai Thành Lập</h3>
                    <p>Sau giải phóng miền Nam, tỉnh Gia Lai - Kon Tum được thành lập, đánh dấu bước đầu trong hành trình phát triển vùng đất Tây Nguyên hùng vĩ.</p>
                </div>
            </div>
            <div class="tl-item right" data-aos>
                <div class="tl-dot"></div>
                <div class="tl-card">
                    <span class="tl-year">2003</span>
                    <h3>Di Sản UNESCO Cồng Chiêng</h3>
                    <p>Không gian văn hóa Cồng Chiêng Tây Nguyên được UNESCO công nhận là Kiệt tác Di sản Văn hóa Phi vật thể của nhân loại.</p>
                </div>
            </div>
            <div class="tl-item left" data-aos>
                <div class="tl-dot"></div>
                <div class="tl-card">
                    <span class="tl-year">2021</span>
                    <h3>Sinh Quyển Kon Hà Nừng</h3>
                    <p>Khu Dự trữ Sinh quyển Kon Hà Nừng được UNESCO công nhận, bảo tồn hệ sinh thái rừng nguyên sinh độc đáo nhất khu vực Đông Nam Á.</p>
                </div>
            </div>
            <div class="tl-item right" data-aos>
                <div class="tl-dot tl-dot-special"></div>
                <div class="tl-card tl-card-special">
                    <span class="tl-year special">2025</span>
                    <h3>Hợp Nhất Lịch Sử</h3>
                    <p>Gia Lai và Bình Định chính thức hợp nhất — đại ngàn chạm biển xanh. Một vùng đất mới ra đời với tiềm năng du lịch bậc nhất Đông Nam Á.</p>
                </div>
            </div>
            <div class="tl-item left" data-aos>
                <div class="tl-dot tl-dot-gold"></div>
                <div class="tl-card tl-card-gold">
                    <span class="tl-year gold">2026</span>
                    <h3>Năm Du Lịch Quốc Gia</h3>
                    <p>Gia Lai được chọn là địa điểm tổ chức Năm Du Lịch Quốc Gia 2026 với chủ đề "Đại Ngàn Chạm Biển Xanh" — cơ hội vàng để vươn ra thế giới.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== DI SẢN VĂN HÓA ===== -->
<section class="culture-section">
    <div class="container">
        <div class="section-header" style="text-align:center; margin-bottom:56px;">
            <span class="section-tag" style="color:var(--seafoam)">Văn Hóa</span>
            <h2 class="section-title">Di Sản <em>Ngàn Năm</em></h2>
            <p class="section-desc">Kho tàng văn hóa phong phú từ Tây Nguyên đến đất võ Bình Định</p>
        </div>
        <div class="culture-grid">
            <div class="culture-card cc-large">
                <div class="cc-img">
                    <img src="https://images.unsplash.com/photo-1528360983277-13d401cdc186?w=800&q=80" alt="Cồng Chiêng" loading="lazy">
                    <div class="cc-overlay"></div>
                </div>
                <div class="cc-body">
                    <span class="cc-tag">🥁 UNESCO</span>
                    <h3>Không Gian Văn Hóa Cồng Chiêng</h3>
                    <p>Di sản văn hóa phi vật thể của nhân loại — âm thanh cồng chiêng Tây Nguyên vang vọng từ ngàn đời, kể chuyện về đất trời, về cuộc sống của 38 dân tộc anh em.</p>
                </div>
            </div>
            <div class="culture-card">
                <div class="cc-img">
                    <img src="https://images.unsplash.com/photo-1548013146-72479768bada?w=500&q=80" alt="Tháp Chăm" loading="lazy">
                    <div class="cc-overlay"></div>
                </div>
                <div class="cc-body">
                    <span class="cc-tag">🏛 Di Tích</span>
                    <h3>Di Sản Chăm Pa</h3>
                    <p>Hệ thống tháp Chăm Pa cổ kính — Tháp Đôi, Bánh Ít, Dương Long — di sản kiến trúc nghìn năm vẫn sừng sững trên đất Bình Định.</p>
                </div>
            </div>
            <div class="culture-card">
                <div class="cc-img">
                    <img src="https://images.unsplash.com/photo-1532274402911-5a369e4c4bb5?w=500&q=80" alt="Tây Sơn" loading="lazy">
                    <div class="cc-overlay"></div>
                </div>
                <div class="cc-body">
                    <span class="cc-tag">⚔ Lịch Sử</span>
                    <h3>Hào Khí Tây Sơn</h3>
                    <p>Đất võ Bình Định — nơi sinh ra vua Quang Trung - Nguyễn Huệ và phong trào Tây Sơn lừng lẫy. Võ cổ truyền Bình Định là di sản sống còn tới hôm nay.</p>
                </div>
            </div>
            <div class="culture-card">
                <div class="cc-img">
                    <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=500&q=80" alt="Làng chài" loading="lazy">
                    <div class="cc-overlay"></div>
                </div>
                <div class="cc-body">
                    <span class="cc-tag">🎣 Dân Gian</span>
                    <h3>Văn Hóa Làng Chài</h3>
                    <p>Cuộc sống ngư dân ven biển Quy Nhơn — những làng chài yên bình với tục thờ cá Ông, lễ hội cầu ngư và nghề đan lưới truyền thống ngàn đời.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== ĐỊA LÝ & KHÍ HẬU ===== -->
<section class="geography-section">
    <div class="container">
        <div class="geo-grid">
            <div class="geo-text">
                <span class="section-tag" style="color:var(--seafoam)">Thiên Nhiên</span>
                <h2 class="section-title">Địa Lý &<br><em>Khí Hậu</em></h2>
                <p class="geo-lead">Gia Lai sở hữu địa hình đa dạng bậc nhất Việt Nam — từ cao nguyên 500-800m so với mực nước biển đến đồng bằng ven biển và hải đảo hoang sơ.</p>
                <div class="geo-items">
                    <div class="geo-item">
                        <div class="gi-icon">🏔</div>
                        <div>
                            <strong>Cao Nguyên Pleiku</strong>
                            <p>Độ cao trung bình 800m, khí hậu mát mẻ quanh năm 18–25°C, lý tưởng cho du lịch sinh thái và nghỉ dưỡng.</p>
                        </div>
                    </div>
                    <div class="geo-item">
                        <div class="gi-icon">🌊</div>
                        <div>
                            <strong>Biển Quy Nhơn</strong>
                            <p>Đường bờ biển 134km với nhiều vịnh đẹp, nước trong xanh quanh năm. Mùa du lịch biển đẹp nhất từ tháng 1 đến tháng 8.</p>
                        </div>
                    </div>
                    <div class="geo-item">
                        <div class="gi-icon">🌿</div>
                        <div>
                            <strong>Rừng Nguyên Sinh</strong>
                            <p>Khu Dự trữ Sinh quyển Kon Hà Nừng rộng 413.511 ha — một trong những khu rừng nguyên sinh lớn nhất Đông Nam Á còn nguyên vẹn.</p>
                        </div>
                    </div>
                    <div class="geo-item">
                        <div class="gi-icon">🌦</div>
                        <div>
                            <strong>Khí Hậu 2 Vùng</strong>
                            <p>Tây Nguyên có 2 mùa mưa-khô rõ rệt. Vùng ven biển có khí hậu nhiệt đới ấm áp, nắng nhiều, lý tưởng cho du lịch biển.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="geo-visual">
                <div class="geo-map-placeholder">
                    <div class="gmp-inner">
                        <div class="gmp-pin pin1" title="Pleiku">
                            <span>📍</span><small>Pleiku</small>
                        </div>
                        <div class="gmp-pin pin2" title="Quy Nhơn">
                            <span>📍</span><small>Quy Nhơn</small>
                        </div>
                        <div class="gmp-pin pin3" title="Eo Gió">
                            <span>🏖</span><small>Eo Gió</small>
                        </div>
                        <div class="gmp-label">TỈNH GIA LAI</div>
                        <div class="gmp-sub">Diện tích: 20.000+ km²</div>
                    </div>
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=75" alt="Cảnh quan Gia Lai" loading="lazy">
                    <div class="gmp-overlay"></div>
                </div>
                <div class="geo-weather-cards">
                    <div class="gwc">
                        <span class="gwc-icon">🌤</span>
                        <span class="gwc-val">25°C</span>
                        <span class="gwc-label">TB Quy Nhơn</span>
                    </div>
                    <div class="gwc">
                        <span class="gwc-icon">🌿</span>
                        <span class="gwc-val">21°C</span>
                        <span class="gwc-label">TB Pleiku</span>
                    </div>
                    <div class="gwc">
                        <span class="gwc-icon">☀️</span>
                        <span class="gwc-val">2.700h</span>
                        <span class="gwc-label">Nắng/năm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CON NGƯỜI ===== -->
<section class="people-section">
    <div class="ppl-bg"></div>
    <div class="container">
        <div class="section-header" style="text-align:center; margin-bottom:56px;">
            <span class="section-tag" style="color:var(--seafoam)">Con Người</span>
            <h2 class="section-title" style="color:white">38 Dân Tộc <em>Anh Em</em></h2>
            <p class="section-desc" style="color:rgba(255,255,255,0.55)">Sự đa dạng văn hóa là nét đẹp đặc trưng của vùng đất Gia Lai</p>
        </div>
        <div class="people-grid">
            <div class="ppl-card">
                <div class="ppl-icon">👘</div>
                <h3>Dân Tộc Bahnar</h3>
                <p>Một trong những dân tộc bản địa lâu đời nhất Tây Nguyên với kiến trúc nhà rông độc đáo và nền văn hóa cồng chiêng phong phú.</p>
            </div>
            <div class="ppl-card">
                <div class="ppl-icon">🎭</div>
                <h3>Dân Tộc Jarai</h3>
                <p>Dân tộc đông dân nhất tỉnh Gia Lai với truyền thống mẫu hệ độc đáo, nghề dệt thổ cẩm tinh xảo và âm nhạc đàn đá huyền bí.</p>
            </div>
            <div class="ppl-card">
                <div class="ppl-icon">⚔️</div>
                <h3>Người Bình Định</h3>
                <p>Hậu duệ của "đất võ" với tinh thần thượng võ ngàn đời. Võ cổ truyền Bình Định nổi tiếng khắp Đông Nam Á, là niềm tự hào dân tộc.</p>
            </div>
            <div class="ppl-card">
                <div class="ppl-icon">🎣</div>
                <h3>Ngư Dân Quy Nhơn</h3>
                <p>Những ngư dân kiên cường bám biển, gìn giữ nghề đánh cá truyền thống qua nhiều thế hệ và tục thờ cá Ông linh thiêng.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== ẨM THỰC ===== -->
<section class="food-section">
    <div class="container">
        <div class="section-header" style="text-align:center; margin-bottom:56px;">
            <span class="section-tag">Ẩm Thực</span>
            <h2 class="section-title">Tinh Hoa <em>Vị Giác</em></h2>
            <p class="section-desc">Từ phở khô Pleiku đến hải sản Quy Nhơn — hành trình ẩm thực không thể bỏ qua</p>
        </div>
        <div class="food-grid">
            <div class="food-card">
                <div class="food-img">
                    <img src="https://images.unsplash.com/photo-1555126634-323283e090fa?w=400&q=80" alt="Phở khô" loading="lazy">
                </div>
                <div class="food-body">
                    <h3>Phở Khô Pleiku</h3>
                    <p>Đặc sản nổi tiếng nhất Gia Lai — bánh phở dai mềm ăn kèm nước dùng xương hầm đậm đà, thịt bò tái và tương đen đặc trưng.</p>
                    <span class="food-region">🏔 Pleiku</span>
                </div>
            </div>
            <div class="food-card">
                <div class="food-img">
                    <img src="https://images.unsplash.com/photo-1516100882582-96c3a05fe590?w=400&q=80" alt="Bún chả cá" loading="lazy">
                </div>
                <div class="food-body">
                    <h3>Bún Chả Cá Quy Nhơn</h3>
                    <p>Chả cá thu tươi ngon thơm lừng ăn cùng bún tươi và nước dùng cá đậm vị — món ăn sáng không thể thiếu của người Quy Nhơn.</p>
                    <span class="food-region">🌊 Quy Nhơn</span>
                </div>
            </div>
            <div class="food-card">
                <div class="food-img">
                    <img src="https://images.unsplash.com/photo-1559737558-2f5a35f4523b?w=400&q=80" alt="Hải sản" loading="lazy">
                </div>
                <div class="food-body">
                    <h3>Hải Sản Tươi Sống</h3>
                    <p>Tôm hùm, cua ghẹ, ốc nhảy, mực một nắng... đặc sản biển Quy Nhơn tươi ngon bậc nhất, giá bình dân ngay tại làng chài.</p>
                    <span class="food-region">🌊 Làng Chài</span>
                </div>
            </div>
            <div class="food-card">
                <div class="food-img">
                    <img src="https://images.unsplash.com/photo-1563245372-f21724e3856d?w=400&q=80" alt="Bánh xèo" loading="lazy">
                </div>
                <div class="food-body">
                    <h3>Bánh Xèo Tôm Nhảy</h3>
                    <p>Bánh xèo giòn rụm nhân tôm tươi nhảy, ăn kèm rau sống và mắm nêm chua ngọt — tinh hoa ẩm thực vùng biển Bình Định.</p>
                    <span class="food-region">🌊 Bình Định</span>
                </div>
            </div>
            <div class="food-card">
                <div class="food-img">
                    <img src="https://images.unsplash.com/photo-1541167760496-1628856ab772?w=400&q=80" alt="Cà phê" loading="lazy">
                </div>
                <div class="food-body">
                    <h3>Cà Phê Ban Mê</h3>
                    <p>Cà phê Arabica trồng trên cao nguyên Gia Lai — hương vị đậm đà, thơm ngát, được xuất khẩu sang hơn 40 quốc gia trên thế giới.</p>
                    <span class="food-region">🏔 Tây Nguyên</span>
                </div>
            </div>
            <div class="food-card">
                <div class="food-img">
                    <img src="https://images.unsplash.com/photo-1481931098730-318b6f776db0?w=400&q=80" alt="Rượu cần" loading="lazy">
                </div>
                <div class="food-body">
                    <h3>Rượu Cần Tây Nguyên</h3>
                    <p>Thức uống linh thiêng trong lễ hội của đồng bào dân tộc — ủ từ gạo nếp và các loại lá rừng bí truyền, uống từ ché bằng cần tre.</p>
                    <span class="food-region">🏔 Bản Làng</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA ===== -->
<section class="about-cta">
    <div class="acta-bg"></div>
    <div class="container">
        <div class="acta-inner">
            <h2>Sẵn Sàng Khám Phá<br><em>Gia Lai?</em></h2>
            <p>Lên kế hoạch hành trình từ đại ngàn đến biển xanh ngay hôm nay</p>
            <div class="acta-btns">
                <a href="destinations.php" class="btn-primary">
                    Xem Điểm Đến
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 9h10M10 4l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </a>
                <a href="contact.php" class="btn-ghost">Liên Hệ Tư Vấn</a>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
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
                </ul>
            </div>
            <div class="footer-links">
                <h4>Khám Phá</h4>
                <ul>
                    <li><a href="about.php">Giới Thiệu</a></li>
                    <li><a href="destinations.php">Điểm Đến</a></li>
                    <li><a href="api/maps.php">Bản Đồ</a></li>
                    <li><a href="contact.php">Liên Hệ</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Tài Khoản</h4>
                <ul>
                    <li><a href="login.php">Đăng Nhập</a></li>
                    <li><a href="register.php">Đăng Ký</a></li>
                    <li><a href="profile.php">Hồ Sơ</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 Gia Lai Tourism. Bản quyền thuộc Sở Du Lịch tỉnh Gia Lai.</p>
        </div>
    </div>
</footer>

<div class="toast" id="toast"></div>
<script src="js/about.js"></script>
</body>
</html>
