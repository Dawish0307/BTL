// ============================================
// GIA LAI TOURISM — MAIN JS
// ============================================

/* ----- Navbar Scroll ----- */
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 60);
});

/* ----- Nav Toggle Mobile ----- */
const navToggle = document.getElementById('navToggle');
const navLinks  = document.querySelector('.nav-links');
const navAuth   = document.querySelector('.nav-auth');
if (navToggle) {
    navToggle.addEventListener('click', () => {
        navLinks?.classList.toggle('open');
        navAuth?.classList.toggle('open');
    });
}

/* ----- User Dropdown ----- */
const userMenuBtn = document.getElementById('userMenuBtn');
const userDropdown = document.getElementById('userDropdown');
if (userMenuBtn) {
    userMenuBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        userDropdown.classList.toggle('open');
    });
    document.addEventListener('click', () => userDropdown.classList.remove('open'));
}

/* ----- Logout ----- */
const logoutBtn = document.getElementById('logoutBtn');
if (logoutBtn) {
    logoutBtn.addEventListener('click', async (e) => {
        e.preventDefault();
        const res = await fetch('api/auth.php', {
            method: 'POST',
            body: new URLSearchParams({ action: 'logout' })
        });
        const data = await res.json();
        if (data.success) location.href = data.redirect;
    });
}

/* ----- Toast Notification ----- */
function showToast(msg, type = 'info') {
    const t = document.getElementById('toast');
    if (!t) return;
    t.textContent = msg;
    t.className = `toast ${type} show`;
    setTimeout(() => t.classList.remove('show'), 3500);
}

/* ----- Load Destinations ----- */
let allDestinations = [];
let showing = 6;
let activeFilter = 'all';

async function loadDestinations() {
    try {
        const res = await fetch('api/destinations.php');
        const data = await res.json();
        if (data.success) {
            allDestinations = data.data;
            renderDestinations();
        }
    } catch {
        // Fallback static data if API unavailable
        allDestinations = getStaticDestinations();
        renderDestinations();
    }
}

function getStaticDestinations() {
    return [
        { id:1, name:'Eo Gió - Kỳ Co', region:'bien', location:'Xã Nhơn Lý, Quy Nhơn', description:'Nước trong xanh màu ngọc bích, vách núi đá kỳ vĩ. Được ví như Maldives của Việt Nam.', image_url:'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500&q=75', rating:4.9 },
        { id:2, name:'Ghềnh Ráng Tiên Sa', region:'bien', location:'Cách Quy Nhơn 3km', description:'Quần thể bãi đá kỳ thú, bãi tắm Hoàng Hậu và khu mộ thi sĩ Hàn Mặc Tử.', image_url:'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=500&q=75', rating:4.7 },
        { id:3, name:'Hòn Khô - Nhơn Hải', region:'bien', location:'Xã Nhơn Hải, Quy Nhơn', description:'Con đường 500m giữa biển khi nước rút. Thiên đường lặn ngắm san hô hoang sơ.', image_url:'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=500&q=75', rating:4.8 },
        { id:4, name:'Cù Lao Xanh', region:'bien', location:'Biển Quy Nhơn', description:'Đảo hoang sơ với cầu cảng gỗ vươn ra biển — Maldives thu nhỏ của Việt Nam.', image_url:'https://images.unsplash.com/photo-1559494007-9f5847c49d94?w=500&q=75', rating:4.8 },
        { id:5, name:'Đồi Cát Phương Mai', region:'bien', location:'Bán đảo Phương Mai', description:'Sahara của Quy Nhơn — cát vàng trải dài hàng chục km với biển xanh phía xa.', image_url:'https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=500&q=75', rating:4.6 },
        { id:6, name:'Đầm Thị Nại', region:'bien', location:'Quy Nhơn', description:'Chèo SUP, thả lưới, ngắm chim trời giữa đầm nước trong xanh như tranh thủy mặc.', image_url:'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=500&q=75', rating:4.7 },
        { id:7, name:'Tháp Đôi Quy Nhơn', region:'lichsu', location:'Trung tâm Quy Nhơn', description:'Di tích Chăm Pa từ thế kỷ 11–13, biểu tượng lịch sử - văn hóa đặc sắc của Bình Định.', image_url:'https://images.unsplash.com/photo-1528360983277-13d401cdc186?w=500&q=75', rating:4.5 },
        { id:8, name:'Bảo Tàng Quang Trung', region:'lichsu', location:'Huyện Tây Sơn, Gia Lai', description:'Theo dấu vua Quang Trung - Nguyễn Huệ và hào khí Tây Sơn trên đất võ Bình Định.', image_url:'https://images.unsplash.com/photo-1532274402911-5a369e4c4bb5?w=500&q=75', rating:4.7 },
        { id:9, name:'Bãi Xép - Làng Chài', region:'bien', location:'Quy Hòa, Quy Nhơn', description:'Làng chài yên bình với bờ đá tự nhiên, hơi thở cuộc sống ngư dân đậm chất biển.', image_url:'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&q=75', rating:4.5 },
        { id:10, name:'Tháp Bánh Ít', region:'lichsu', location:'Huyện Tuy Phước, Gia Lai', description:'Cụm tháp Chăm Pa trên đỉnh đồi, tầm nhìn bao quát toàn cảnh vùng đất Bình Định.', image_url:'https://images.unsplash.com/photo-1548013146-72479768bada?w=500&q=75', rating:4.6 },
    ];
}

function renderDestinations() {
    const grid = document.getElementById('destinationsGrid');
    if (!grid) return;

    const filtered = activeFilter === 'all'
        ? allDestinations
        : allDestinations.filter(d => d.region === activeFilter);

    const visible = filtered.slice(0, showing);
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    if (loadMoreBtn) {
        loadMoreBtn.style.display = filtered.length > showing ? 'inline-block' : 'none';
    }

    const regionMap = { bien:'🌊 Biển & Đảo', lichsu:'🏛 Di Sản', rung:'🌿 Đại Ngàn' };

    grid.innerHTML = visible.map(d => `
        <div class="dest-card" data-id="${d.id}">
            <div class="dest-img">
                <img src="${d.image_url}" alt="${d.name}" loading="lazy">
                <div class="dest-region-badge">${regionMap[d.region] || d.region}</div>
                <div class="dest-rating">⭐ ${parseFloat(d.rating).toFixed(1)}</div>
            </div>
            <div class="dest-body">
                <h3>${d.name}</h3>
                <p class="dest-location">📍 ${d.location}</p>
                <p class="dest-desc">${d.description}</p>
            </div>
        </div>
    `).join('');

    // Intersection observer for card animation
    const cards = grid.querySelectorAll('.dest-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => {
                    e.target.style.opacity = '1';
                    e.target.style.transform = 'translateY(0)';
                }, i * 60);
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(c => {
        c.style.opacity = '0';
        c.style.transform = 'translateY(24px)';
        c.style.transition = 'opacity 0.5s ease, transform 0.5s ease, box-shadow 0.35s ease';
        observer.observe(c);
    });
}

/* ----- Filter Tabs ----- */
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('filter-btn')) {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        e.target.classList.add('active');
        activeFilter = e.target.dataset.filter;
        showing = 6;
        renderDestinations();
    }
});

/* ----- Load More ----- */
const loadMoreBtn = document.getElementById('loadMoreBtn');
if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', () => {
        showing += 3;
        renderDestinations();
    });
}

/* ----- Contact Form ----- */
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        showToast('Cảm ơn bạn! Chúng tôi sẽ liên hệ trong 24 giờ.', 'success');
        contactForm.reset();
    });
}
/* ----- Countdown Timer ----- */
function startCountdown() {
    const target = new Date('2026-06-28T08:00:00');
    function update() {
        const now = new Date();
        const diff = target - now;
        if (diff <= 0) return;
        const d = Math.floor(diff / 86400000);
        const h = Math.floor((diff % 86400000) / 3600000);
        const m = Math.floor((diff % 3600000) / 60000);
        const s = Math.floor((diff % 60000) / 1000);

        const fmt = n => String(n).padStart(2, '0');
        const setVal = (id, val) => {
            const el = document.getElementById(id);
            if (el && el.textContent !== fmt(val)) {
                el.classList.add('flip');
                el.textContent = fmt(val);
                setTimeout(() => el.classList.remove('flip'), 200);
            }
        };
        setVal('cd-days', d);
        setVal('cd-hours', h);
        setVal('cd-mins', m);
        setVal('cd-secs', s);
    }
    update();
    setInterval(update, 1000);
}
startCountdown();

/* ----- Event Filter ----- */
document.querySelectorAll('.ef-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.ef-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const cat = btn.dataset.cat;
        document.querySelectorAll('.ev-card').forEach(card => {
            const match = cat === 'all' || card.dataset.cat === cat;
            if (match) {
                card.classList.remove('hidden-cat');
                setTimeout(() => card.classList.add('visible'), 50);
            } else {
                card.classList.add('hidden-cat');
                card.classList.remove('visible');
            }
        });
    });
});

/* ----- Scroll Animation cho Events ----- */
const evObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
            setTimeout(() => {
                entry.target.classList.add('visible');
                // Animate progress bar
                const fill = entry.target.querySelector('.evp-fill');
                if (fill) {
                    const target = fill.style.width;
                    fill.style.width = '0';
                    setTimeout(() => fill.style.width = target, 100);
                }
            }, i * 100);
            evObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.15 });

document.querySelectorAll('.ev-card').forEach(card => evObserver.observe(card));
/* ----- Init ----- */
loadDestinations();
