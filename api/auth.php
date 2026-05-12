<?php
session_start();
require_once '../config/database.php';

header('Content-Type: application/json; charset=utf-8');

$action = $_POST['action'] ?? '';

if ($action === 'register') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $phone     = trim($_POST['phone'] ?? '');

    if (empty($full_name) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin bắt buộc.']);
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Email không hợp lệ.']);
        exit;
    }
    if (strlen($password) < 6) {
        echo json_encode(['success' => false, 'message' => 'Mật khẩu phải có ít nhất 6 ký tự.']);
        exit;
    }

    $conn = connectDB();
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email này đã được đăng ký.']);
        $conn->close(); exit;
    }

    $hashed = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $full_name, $email, $hashed, $phone);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Đăng ký thành công! Chào mừng ' . htmlspecialchars($full_name) . '.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Đăng ký thất bại. Vui lòng thử lại.']);
    }
    $conn->close();

} elseif ($action === 'login') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập email và mật khẩu.']);
        exit;
    }

    $conn = connectDB();
    $stmt = $conn->prepare("SELECT id, full_name, email, password, role FROM users WHERE email = ? AND is_active = 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id']   = $row['id'];
            $_SESSION['user_name'] = $row['full_name'];
            $_SESSION['user_role'] = $row['role'];
            echo json_encode([
                'success'  => true,
                'message'  => 'Đăng nhập thành công! Chào mừng ' . htmlspecialchars($row['full_name']),
                'name'     => $row['full_name'],
                'redirect' => '../index.php'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Mật khẩu không chính xác.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Email không tồn tại hoặc tài khoản bị khóa.']);
    }
    $conn->close();

} elseif ($action === 'logout') {
    session_destroy();
    echo json_encode(['success' => true, 'redirect' => '/gialai_tourism/index.php']);
} else {
    echo json_encode(['success' => false, 'message' => 'Hành động không hợp lệ.']);
}
?>
