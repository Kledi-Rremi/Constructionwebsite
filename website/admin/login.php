<?php
session_start();
require_once '../db.php'; // adjust path as needed

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Fetch admin from database
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            background: #f5f6fa;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .login-container {
            width: 350px;
            margin: 100px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
            padding: 32px 28px 24px 28px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 28px;
            color: #222;
            font-weight: 600;
        }
        .login-container label {
            display: block;
            margin-bottom: 6px;
            color: #444;
            font-size: 15px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px 10px;
            margin-bottom: 18px;
            border: 1px solid #dcdde1;
            border-radius: 4px;
            font-size: 15px;
            background: #f9f9f9;
            transition: border 0.2s;
        }
        .login-container input:focus {
            border: 1.5px solid #4078c0;
            outline: none;
            background: #fff;
        }
        .login-container button {
            width: 100%;
            padding: 12px 0;
            background: #4078c0;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .login-container button:hover {
            background: #305a8c;
        }
        .error {
            color: #e74c3c;
            background: #fdecea;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 18px;
            text-align: center;
            font-size: 14px;
        }
        .login-footer {
            text-align: center;
            margin-top: 18px;
            font-size: 13px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" required autofocus>
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>
            <button type="submit">Log In</button>
        </form>
        <div class="login-footer">
            &copy; <?= date('Y') ?> Brik Admin Panel
        </div>
    </div>
</body>
</html>