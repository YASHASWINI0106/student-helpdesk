<?php
require_once __DIR__ . '/config.php';
session_start();

if (!empty($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $statement = db()->prepare('SELECT id, name, email, password_hash, role FROM users WHERE email = ?');
    $statement->execute([trim($_POST['email'])]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($_POST['password'], $user['password_hash'])) {
        unset($user['password_hash']);
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Invalid email or password.';
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><link rel="stylesheet" href="assets/style.css"><title>Student Helpdesk</title></head>
<body class="login-page"><main class="card"><h1>Student Helpdesk</h1><p>Log in to create and track support requests.</p><?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<form method="post"><label>Email<input type="email" name="email" required></label><label>Password<input type="password" name="password" required></label><button>Log in</button></form>
<p class="hint">First time running it? <a href="setup.php">Create the admin account</a>.</p></main></body></html>
