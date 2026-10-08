<?php
require_once __DIR__ . '/auth.php'; require_login();
$statement = db()->prepare('SELECT t.*, c.name AS category, u.name AS requester FROM tickets t JOIN categories c ON c.id = t.category_id JOIN users u ON u.id = t.user_id WHERE t.id = ?');
$statement->execute([(int) $_GET['id']]); $ticket = $statement->fetch(PDO::FETCH_ASSOC);
if (!$ticket || (!is_admin() && $ticket['user_id'] != $_SESSION['user']['id'])) { http_response_code(404); exit('Ticket not found.'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_admin()) { db()->prepare('UPDATE tickets SET status = ? WHERE id = ?')->execute([$_POST['status'], $ticket['id']]); header('Location: ticket.php?id=' . $ticket['id']); exit; }
require __DIR__ . '/header.php';
?>
<a href="dashboard.php">&larr; Back to dashboard</a><article class="ticket"><h1><?= e($ticket['title']) ?></h1><p class="meta">#<?= $ticket['id'] ?> · <?= e($ticket['category']) ?> · Requested by <?= e($ticket['requester']) ?></p><p><?= nl2br(e($ticket['description'])) ?></p><p><strong>Priority:</strong> <?= e($ticket['priority']) ?> &nbsp; <strong>Status:</strong> <?= e($ticket['status']) ?></p><?php if (is_admin()): ?><form method="post"><label>Update status <select name="status"><?php foreach (['Open', 'In Progress', 'Resolved'] as $status): ?><option <?= $ticket['status'] === $status ? 'selected' : '' ?>><?= $status ?></option><?php endforeach; ?></select></label><button>Save status</button></form><?php endif; ?></article>
<?php require __DIR__ . '/footer.php'; ?>
