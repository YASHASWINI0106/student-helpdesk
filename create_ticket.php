<?php
require_once __DIR__ . '/auth.php'; require_login();
$categories = db()->query('SELECT id, name FROM categories ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']); $description = trim($_POST['description']);
    if (!$title || !$description) { $error = 'Please complete every field.'; }
    else {
        db()->prepare('INSERT INTO tickets (user_id, category_id, title, description, priority) VALUES (?, ?, ?, ?, ?)')->execute([$_SESSION['user']['id'], $_POST['category_id'], $title, $description, $_POST['priority']]);
        header('Location: dashboard.php'); exit;
    }
}
require __DIR__ . '/header.php';
?>
<h1>Create a support ticket</h1><?php if ($error): ?><p class="error"><?= e($error) ?></p><?php endif; ?><form class="form" method="post"><label>Title<input name="title" maxlength="150" required></label><label>Category<select name="category_id"><?php foreach ($categories as $category): ?><option value="<?= $category['id'] ?>"><?= e($category['name']) ?></option><?php endforeach; ?></select></label><label>Priority<select name="priority"><option>Low</option><option selected>Medium</option><option>High</option></select></label><label>Description<textarea name="description" rows="6" required></textarea></label><button>Create ticket</button></form>
<?php require __DIR__ . '/footer.php'; ?>
