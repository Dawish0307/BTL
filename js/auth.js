// ============================================
// GIA LAI TOURISM — AUTH JS
// ============================================

/* ----- Toast ----- */
function showToast(msg, type = 'info') {
    const t = document.getElementById('toast');
    if (!t) return;
    t.textContent = msg;
    t.className = `toast ${type} show`;
    setTimeout(() => t.classList.remove('show'), 4000);
}

/* ----- Toggle Password ----- */
document.querySelectorAll('.toggle-pw').forEach(btn => {
    btn.addEventListener('click', () => {
        const targetId = btn.dataset.target || btn.previousElementSibling?.id;
        const input = document.getElementById(targetId) || btn.previousElementSibling;
        if (!input) return;
        input.type = input.type === 'password' ? 'text' : 'password';
        btn.textContent = input.type === 'password' ? '👁' : '🙈';
    });
});

/* ----- Password Strength ----- */
const regPw = document.getElementById('reg_password');
const fill   = document.getElementById('strengthFill');
const text   = document.getElementById('strengthText');
if (regPw) {
    regPw.addEventListener('input', () => {
        const val = regPw.value;
        let score = 0;
        if (val.length >= 6)  score++;
        if (val.length >= 10) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const levels = [
            { label: '', pct: 0, color: 'transparent' },
            { label: 'Rất yếu', pct: 20, color: '#ef4444' },
            { label: 'Yếu',    pct: 40, color: '#f97316' },
            { label: 'Trung bình', pct: 60, color: '#eab308' },
            { label: 'Mạnh',   pct: 80, color: '#22c55e' },
            { label: 'Rất mạnh', pct: 100, color: '#16a34a' },
        ];
        const l = levels[score] || levels[0];
        if (fill) { fill.style.width = l.pct + '%'; fill.style.background = l.color; }
        if (text) { text.textContent = val ? l.label : ''; text.style.color = l.color; }
    });
}

/* ----- Validation Helpers ----- */
function setError(inputEl, errorEl, msg) {
    if (inputEl) inputEl.classList.add('error');
    if (errorEl) errorEl.textContent = msg;
    return false;
}
function clearError(inputEl, errorEl) {
    if (inputEl) { inputEl.classList.remove('error'); inputEl.classList.add('success'); }
    if (errorEl) errorEl.textContent = '';
    return true;
}
function clearAll(...ids) {
    ids.forEach(id => {
        const el = document.getElementById(id);
        if (el) { el.classList.remove('error', 'success'); }
    });
}

/* ----- LOGIN FORM ----- */
const loginForm = document.getElementById('loginForm');
if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        let valid = true;

        const email    = document.getElementById('email');
        const password = document.getElementById('password');
        const emailErr = document.getElementById('emailError');
        const pwErr    = document.getElementById('passwordError');

        clearAll('email', 'password');
        if (!emailErr) return;

        if (!email.value.trim() || !/\S+@\S+\.\S+/.test(email.value)) {
            valid = setError(email, emailErr, 'Vui lòng nhập email hợp lệ.');
        } else clearError(email, emailErr);

        if (!password.value) {
            valid = setError(password, pwErr, 'Vui lòng nhập mật khẩu.');
        } else clearError(password, pwErr);

        if (!valid) return;

        const btn = document.getElementById('loginBtn');
        const btnText = btn.querySelector('.btn-text');
        const btnLoader = btn.querySelector('.btn-loader');
        btn.disabled = true;
        btnText.textContent = 'Đang xử lý...';
        btnLoader.classList.remove('hidden');

        try {
            const res = await fetch('api/auth.php', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'login',
                    email: email.value,
                    password: password.value
                })
            });
            const data = await res.json();

            if (data.success) {
                showToast(data.message, 'success');
                setTimeout(() => location.href ='/gialai_tourism/index.php', 1200);
            } else {
                showToast(data.message, 'error');
                btn.disabled = false;
                btnText.textContent = 'Đăng Nhập';
                btnLoader.classList.add('hidden');
            }
        } catch {
            showToast('Lỗi kết nối. Vui lòng thử lại.', 'error');
            btn.disabled = false;
            btnText.textContent = 'Đăng Nhập';
            btnLoader.classList.add('hidden');
        }
    });
}

/* ----- REGISTER FORM ----- */
const registerForm = document.getElementById('registerForm');
if (registerForm) {
    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        let valid = true;

        const fullName = document.getElementById('full_name');
        const email    = document.getElementById('reg_email');
        const password = document.getElementById('reg_password');
        const confirm  = document.getElementById('confirm_password');
        const terms    = document.getElementById('terms');

        const nameErr  = document.getElementById('nameError');
        const emailErr = document.getElementById('regEmailError');
        const pwErr    = document.getElementById('regPasswordError');
        const confErr  = document.getElementById('confirmError');
        const termsErr = document.getElementById('termsError');

        clearAll('full_name', 'reg_email', 'reg_password', 'confirm_password');

        if (!fullName.value.trim() || fullName.value.trim().length < 2) {
            valid = setError(fullName, nameErr, 'Họ tên phải có ít nhất 2 ký tự.');
        } else clearError(fullName, nameErr);

        if (!email.value.trim() || !/\S+@\S+\.\S+/.test(email.value)) {
            valid = setError(email, emailErr, 'Vui lòng nhập email hợp lệ.');
        } else clearError(email, emailErr);

        if (!password.value || password.value.length < 6) {
            valid = setError(password, pwErr, 'Mật khẩu phải có ít nhất 6 ký tự.');
        } else clearError(password, pwErr);

        if (!confirm.value || confirm.value !== password.value) {
            valid = setError(confirm, confErr, 'Mật khẩu xác nhận không khớp.');
        } else clearError(confirm, confErr);

        if (!terms.checked) {
            valid = false;
            if (termsErr) termsErr.textContent = 'Vui lòng đồng ý với điều khoản sử dụng.';
        } else {
            if (termsErr) termsErr.textContent = '';
        }

        if (!valid) return;

        const btn = document.getElementById('registerBtn');
        const btnText = btn.querySelector('.btn-text');
        const btnLoader = btn.querySelector('.btn-loader');
        btn.disabled = true;
        btnText.textContent = 'Đang tạo tài khoản...';
        btnLoader.classList.remove('hidden');

        try {
            const phone = document.getElementById('phone')?.value || '';
            const res = await fetch('api/auth.php', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'register',
                    full_name: fullName.value.trim(),
                    email: email.value.trim(),
                    password: password.value,
                    phone: phone
                })
            });
            const data = await res.json();

            if (data.success) {
                showToast(data.message, 'success');
                setTimeout(() => location.href = '/gialai_tourism/login.php', 1800);
            } else {
                showToast(data.message, 'error');
                btn.disabled = false;
                btnText.textContent = 'Tạo Tài Khoản';
                btnLoader.classList.add('hidden');
            }
        } catch {
            showToast('Lỗi kết nối. Vui lòng thử lại.', 'error');
            btn.disabled = false;
            btnText.textContent = 'Tạo Tài Khoản';
            btnLoader.classList.add('hidden');
        }
    });
}
