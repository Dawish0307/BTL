<?php
// ==================================================
// maps.php — Trang bản đồ du lịch
// Đặt file này trong thư mục: gialai_tourism/api/
// ==================================================
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$userName   = $_SESSION['user_name'] ?? '';

// Kết nối database
require_once '../config/database.php';
$conn = connectDB();

// Lấy tất cả địa điểm từ bảng destinations
$result = $conn->query("SELECT id, name, slug, region, location, description, image_url, rating FROM destinations ORDER BY rating DESC");

$destinations = [];
while ($row = $result->fetch_assoc()) {
    $destinations[] = $row;
}
$conn->close();

// ==================================================
// Toạ độ GPS cho từng địa điểm (theo slug)
// Vì database chưa có cột lat/lng nên ánh xạ tay ở đây
// ==================================================
$coords = [
    'eo-gio-ky-co'         => [13.8880, 109.2290],
    'ghenh-rang-tien-sa'   => [13.7600, 109.2450],
    'hon-kho-nhon-hai'     => [13.8350, 109.2800],
    'cu-lao-xanh'          => [13.6000, 109.3500],
    'doi-cat-phuong-mai'   => [13.8700, 109.2700],
    'dam-thi-nai'          => [13.8200, 109.1900],
    'thap-doi-quy-nhon'    => [13.7767, 109.2233],
    'thap-banh-it'         => [13.7300, 109.0500],
    'bao-tang-quang-trung' => [13.9470, 108.9780],
    'bai-xep-lang-chai'    => [13.7200, 109.2100],
];

// Gán toạ độ vào từng địa điểm
foreach ($destinations as &$d) {
    $slug = $d['slug'] ?? '';
    $d['lat'] = $coords[$slug][0] ?? null;
    $d['lng'] = $coords[$slug][1] ?? null;
}
unset($d);

// Chuyển sang JSON để dùng trong JavaScript
$json = json_encode($destinations, JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bản Đồ Du Lịch — Gia Lai</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Cormorant+Garamond:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">

  <!-- Leaflet: thư viện bản đồ mã nguồn mở -->
  <link  rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --teal:  #4ecdc4;
      --deep:  #0a1628;
      --deep2: #0f1f38;
      --cream: #f5f0e8;
      --gold:  #d4a853;
      --border: rgba(255,255,255,0.08);
    }

    body { font-family: 'Inter', sans-serif; background: var(--deep); color: var(--cream); }

    /* ── NAVBAR ── */
    .navbar {
      position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
      height: 64px;
      background: rgba(10,22,40,0.97);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; padding: 0 40px; gap: 32px;
    }
    .nav-logo {
      font-family: 'Cormorant Garamond', serif;
      font-size: 20px; font-weight: 700; letter-spacing: 3px;
      color: var(--cream); text-decoration: none; margin-right: auto;
    }
    .nav-logo span { color: var(--teal); font-size: 11px; display: block; letter-spacing: 2px; font-family: 'Inter', sans-serif; font-weight: 400; }
    .nav-links { display: flex; gap: 28px; list-style: none; }
    .nav-links a {
      font-size: 12px; font-weight: 500; letter-spacing: 1.5px;
      text-transform: uppercase; color: rgba(245,240,232,0.65);
      text-decoration: none; transition: color .2s;
    }
    .nav-links a:hover, .nav-links a.active { color: var(--cream); }
    .nav-links a.active { border-bottom: 1.5px solid var(--teal); padding-bottom: 2px; }
    .nav-auth { display: flex; gap: 10px; }
    .btn-login {
      padding: 7px 18px; border: 1.5px solid rgba(245,240,232,0.3);
      border-radius: 30px; font-size: 13px; color: var(--cream); text-decoration: none;
    }
    .btn-register {
      padding: 7px 18px; background: var(--teal); border-radius: 30px;
      font-size: 13px; font-weight: 600; color: var(--deep); text-decoration: none;
    }
    .btn-user {
      display: flex; align-items: center; gap: 8px;
      background: rgba(78,205,196,0.12); border: 1.5px solid rgba(78,205,196,0.3);
      border-radius: 30px; padding: 6px 14px; color: var(--cream); font-size: 13px;
    }
    .avatar {
      width: 24px; height: 24px; border-radius: 50%;
      background: var(--teal); color: var(--deep);
      font-size: 11px; font-weight: 700;
      display: flex; align-items: center; justify-content: center;
    }

    /* ── LAYOUT CHÍNH ──
       .main dùng flexbox theo chiều dọc, chiếm đúng 100vh
       Phần tử con flex: 1 (.map-wrap) sẽ chiếm hết phần còn lại
    */
    .main {
      padding-top: 64px; /* đẩy xuống dưới navbar */
      display: flex;
      flex-direction: column;
      height: 100vh;     /* toàn màn hình */
    }

    /* ── THANH TÌM KIẾM & LỌC ── */
    .toolbar {
      background: var(--deep2);
      border-bottom: 1px solid var(--border);
      padding: 12px 40px;
      display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
      /* flex-shrink: 0 → không bị co lại, giữ nguyên chiều cao */
      flex-shrink: 0;
    }
    .search-wrap { position: relative; flex: 1; min-width: 180px; }
    .search-input {
      width: 100%; padding: 9px 36px 9px 14px;
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.12);
      border-radius: 50px; color: var(--cream);
      font-size: 13px; font-family: 'Inter', sans-serif; outline: none;
      transition: border-color .2s;
    }
    .search-input::placeholder { color: rgba(245,240,232,0.3); }
    .search-input:focus { border-color: rgba(78,205,196,0.5); }
    .search-icon { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: rgba(78,205,196,0.5); pointer-events: none; }
    .filter-label { font-size: 12px; color: rgba(245,240,232,0.35); white-space: nowrap; }
    .tags { display: flex; gap: 6px; flex-wrap: wrap; }
    .tag {
      padding: 6px 14px; border-radius: 50px;
      border: 1px solid rgba(255,255,255,0.1);
      background: transparent; color: rgba(245,240,232,0.5);
      font-size: 12px; font-family: 'Inter', sans-serif; cursor: pointer;
      transition: all .2s; white-space: nowrap;
    }
    .tag:hover { border-color: rgba(78,205,196,0.4); color: var(--teal); }
    .tag.active { background: rgba(78,205,196,0.15); border-color: var(--teal); color: var(--teal); }
    .count { font-size: 12px; color: rgba(245,240,232,0.3); white-space: nowrap; }
    .count b { color: var(--teal); }

    /* ── BẢN ĐỒ ──
       flex: 1 → chiếm hết phần chiều cao còn lại sau toolbar
       position: relative → để các nút điều khiển absolute bên trong định vị được
    */
    .map-wrap { flex: 1; position: relative; }

    /* *** QUAN TRỌNG ***
       #map phải có width và height = 100% của .map-wrap
       Leaflet yêu cầu container có kích thước rõ ràng mới vẽ được
    */
    #map { width: 100%; height: 100%; }

    /* Loading overlay */
    .loading {
      position: absolute; inset: 0;
      background: var(--deep2);
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      z-index: 400; transition: opacity .5s;
    }
    .loading.hide { opacity: 0; pointer-events: none; }
    .spinner {
      width: 32px; height: 32px;
      border: 2px solid rgba(78,205,196,0.2);
      border-top-color: var(--teal);
      border-radius: 50%; animation: spin .8s linear infinite;
      margin-bottom: 12px;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* Nút chuyển kiểu bản đồ */
    .map-btns {
      position: absolute; top: 12px; right: 12px; z-index: 500;
      display: flex; flex-direction: column; gap: 6px;
    }
    .map-btn {
      background: rgba(10,22,40,0.92);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 8px; padding: 8px 12px;
      color: var(--cream); font-size: 12px; cursor: pointer;
      font-family: 'Inter', sans-serif; transition: all .2s;
      display: flex; align-items: center; gap: 5px;
    }
    .map-btn:hover { background: rgba(78,205,196,0.15); border-color: rgba(78,205,196,0.3); }
    .map-btn.active { background: rgba(78,205,196,0.2); border-color: var(--teal); color: var(--teal); }

    /* ── POPUP KHI CLICK MARKER ── */
    .leaflet-popup-content-wrapper {
      background: #0f1f38 !important;
      border: 1px solid rgba(78,205,196,0.25) !important;
      border-radius: 12px !important; color: var(--cream) !important;
      font-family: 'Inter', sans-serif !important;
      box-shadow: 0 8px 32px rgba(0,0,0,0.5) !important;
    }
    .leaflet-popup-content { margin: 14px 16px !important; min-width: 200px; }
    .leaflet-popup-tip { background: #0f1f38 !important; }
    .leaflet-popup-close-button { color: rgba(245,240,232,0.5) !important; }
    .p-img  { width: 100%; height: 110px; object-fit: cover; border-radius: 8px; margin-bottom: 10px; }
    .p-name { font-family: 'Cormorant Garamond', serif; font-size: 17px; font-weight: 700; margin-bottom: 4px; }
    .p-loc  { font-size: 10px; color: var(--teal); letter-spacing: 2px; text-transform: uppercase; margin-bottom: 8px; }
    .p-desc { font-size: 12px; color: rgba(245,240,232,0.65); line-height: 1.6; margin-bottom: 8px; }
    .p-star { color: var(--gold); font-size: 13px; }

    /* ── RESPONSIVE ── */
    @media (max-width: 768px) {
      .navbar { padding: 0 16px; }
      .nav-links { display: none; }
      .toolbar { padding: 10px 16px; }
      .filter-label { display: none; }
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
  <a href="../index.php" class="nav-logo">
    ⛰ GIA LAI
    <span>Đại Ngàn · Biển Xanh</span>
  </a>
  <ul class="nav-links">
    <li><a href="../index.php">Trang Chủ</a></li>
    <li><a href="maps.php" class="active">Bản Đồ</a></li>
    <li><a href="../about.php">Giới Thiệu</a></li>
    <li><a href="../destinations.php">Điểm Đến</a></li>
  </ul>
  <div class="nav-auth">
    <?php if ($isLoggedIn): ?>
      <div class="btn-user">
        <div class="avatar"><?= strtoupper(mb_substr($userName, 0, 1)) ?></div>
        <?= htmlspecialchars($userName) ?>
      </div>
    <?php else: ?>
      <a href="../login.php"    class="btn-login">Đăng Nhập</a>
      <a href="../register.php" class="btn-register">Đăng Ký</a>
    <?php endif; ?>
  </div>
</nav>

<!-- NỘI DUNG CHÍNH -->
<div class="main">

  <!-- THANH TÌM KIẾM + LỌC -->
  <div class="toolbar">
    <div class="search-wrap">
      <input id="searchInput" class="search-input" type="text" placeholder="🔍 Tìm tên địa điểm...">
      <span class="search-icon">⌕</span>
    </div>
    <span class="filter-label">Lọc theo:</span>
    <div class="tags">
      <!-- data-r phải khớp với giá trị cột region trong database -->
      <button class="tag active" data-r="all">🌏 Tất cả</button>
      <button class="tag"        data-r="bien">🌊 Biển & Đảo</button>
      <button class="tag"        data-r="rung">🌿 Rừng & Núi</button>
      <button class="tag"        data-r="lichsu">🏛 Lịch Sử</button>
    </div>
    <span class="count" id="count"><b>...</b> địa điểm</span>
  </div>

  <!-- BẢN ĐỒ -->
  <div class="map-wrap">
    <div class="loading" id="loading">
      <div class="spinner"></div>
      <div style="font-size:12px;color:rgba(245,240,232,0.5);letter-spacing:2px">Đang tải bản đồ...</div>
    </div>
    <div id="map"></div>
    <div class="map-btns">
      <button class="map-btn active" id="b1" onclick="setTile('street')">🗺 Đường phố</button>
      <button class="map-btn"        id="b2" onclick="setTile('satellite')">🛰 Vệ tinh</button>
      <button class="map-btn"        id="b3" onclick="setTile('topo')">⛰ Địa hình</button>
      <button class="map-btn"             onclick="map.setView(CENTER, ZOOM)">◎ Về trung tâm</button>
    </div>
  </div>

</div>

<script>
// ── BƯỚC 1: Nhận dữ liệu từ PHP ──────────────────────
// PHP đã lấy từ database và encode thành JSON
// json_encode ở PHP → chuỗi JSON, JSON.parse ở JS → mảng object
const DATA = <?= $json ?>;

// ── BƯỚC 2: Khởi tạo bản đồ Leaflet ─────────────────
const CENTER = [13.77, 109.22]; // Toạ độ trung tâm (Quy Nhơn)
const ZOOM   = 10;

// Tạo bản đồ gắn vào #map, tắt nút zoom mặc định
const map = L.map('map', { zoomControl: false }).setView(CENTER, ZOOM);
L.control.zoom({ position: 'bottomright' }).addTo(map);

// ── BƯỚC 3: Các kiểu nền bản đồ ─────────────────────
const TILES = {
  street:    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OSM' }),
  satellite: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', { attribution: '© Esri' }),
  topo:      L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', { attribution: '© OTM' }),
};
let curTile = 'street';
TILES.street.addTo(map); // Mặc định đường phố

function setTile(name) {
  if (name === curTile) return;
  map.removeLayer(TILES[curTile]);
  TILES[name].addTo(map);
  curTile = name;
  ['b1','b2','b3'].forEach(id => document.getElementById(id)?.classList.remove('active'));
  ({ street:'b1', satellite:'b2', topo:'b3' })[name] &&
    document.getElementById(({ street:'b1', satellite:'b2', topo:'b3' })[name]).classList.add('active');
}

// ── BƯỚC 4: Tạo và vẽ markers ────────────────────────
// Màu icon theo loại địa điểm
const STYLE = {
  bien:   { color: '#0a3d62', emoji: '🌊' },
  rung:   { color: '#1a4a2a', emoji: '🌿' },
  lichsu: { color: '#4a2a1a', emoji: '🏛' },
};

// Tạo icon hình giọt nước bằng SVG
function makeIcon(region) {
  const s = STYLE[region] || { color: '#333', emoji: '📍' };
  const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="36" height="44" viewBox="0 0 36 44">
    <path d="M18 2C10.3 2 4 8.3 4 16c0 10.5 14 26 14 26s14-15.5 14-26C32 8.3 25.7 2 18 2z"
          fill="${s.color}" stroke="#4ecdc4" stroke-width="1.5"/>
    <text x="18" y="19" text-anchor="middle" dominant-baseline="middle" font-size="12">${s.emoji}</text>
  </svg>`;
  return L.divIcon({ className:'', html:svg, iconSize:[36,44], iconAnchor:[18,44], popupAnchor:[0,-44] });
}

let markers = []; // Danh sách marker đang hiển thị

function clearMarkers() {
  markers.forEach(m => map.removeLayer(m));
  markers = [];
}

function showMarkers(list) {
  clearMarkers();
  list.forEach(d => {
    if (!d.lat || !d.lng) return; // Bỏ qua nếu không có toạ độ
    const m = L.marker([d.lat, d.lng], { icon: makeIcon(d.region) });
    m.bindPopup(`
      ${d.image_url ? `<img class="p-img" src="${d.image_url}" onerror="this.style.display='none'">` : ''}
      <div class="p-name">${d.name}</div>
      <div class="p-loc">📍 ${d.location || ''}</div>
      <div class="p-desc">${(d.description||'').slice(0,120)}…</div>
      <div class="p-star">${'★'.repeat(Math.floor(d.rating))} ${d.rating}</div>
    `);
    m.addTo(map);
    markers.push(m);
  });
  document.getElementById('count').innerHTML = `<b>${markers.length}</b> địa điểm`;
}

// ── BƯỚC 5: Lọc dữ liệu ─────────────────────────────
let filterRegion = 'all';
let filterText   = '';

function applyFilter() {
  const result = DATA.filter(d => {
    const okRegion = filterRegion === 'all' || d.region === filterRegion;
    const okText   = !filterText || d.name.toLowerCase().includes(filterText);
    return okRegion && okText;
  });
  showMarkers(result);
}

// ── BƯỚC 6: Gắn sự kiện ─────────────────────────────
// Nút lọc tag
document.querySelectorAll('.tag').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.tag').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    filterRegion = btn.dataset.r;
    applyFilter();
  });
});

// Ô tìm kiếm (debounce 300ms để không filter quá nhiều)
let timer;
document.getElementById('searchInput').addEventListener('input', e => {
  clearTimeout(timer);
  timer = setTimeout(() => {
    filterText = e.target.value.trim().toLowerCase();
    applyFilter();
  }, 300);
});

// ── BƯỚC 7: Ẩn loading, vẽ markers lần đầu ──────────
map.whenReady(() => {
  setTimeout(() => document.getElementById('loading').classList.add('hide'), 500);
});
applyFilter();
</script>
</body>
</html>