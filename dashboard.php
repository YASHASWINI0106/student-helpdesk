<?php
require_once __DIR__ . '/auth.php';
require_login();

$where = is_admin() ? '' : 'WHERE t.user_id = ?';
$statement = db()->prepare("SELECT t.*, c.name AS category, u.name AS requester FROM tickets t JOIN categories c ON c.id = t.category_id JOIN users u ON u.id = t.user_id $where ORDER BY t.updated_at DESC");
$statement->execute(is_admin() ? [] : [$_SESSION['user']['id']]);
$tickets = $statement->fetchAll(PDO::FETCH_ASSOC);
require __DIR__ . '/header.php';
?>
<section class="page-title"><div><h1>Your support tickets</h1><p>Create, track, and update requests in one place.</p></div><a class="button" href="create_ticket.php">+ New ticket</a></section>
<?php if (!$tickets): ?><div class="empty">No tickets yet. Create your first one.</div><?php else: ?><table><thead><tr><th>ID</th><th>Title</th><th>Category</th><th>Priority</th><th>Status</th><th>Requester</th><th></th></tr></thead><tbody><?php foreach ($tickets as $ticket): ?><tr><td>#<?= $ticket['id'] ?></td><td><?= e($ticket['title']) ?></td><td><?= e($ticket['category']) ?></td><td><span class="tag <?= strtolower($ticket['priority']) ?>"><?= e($ticket['priority']) ?></span></td><td><?= e($ticket['status']) ?></td><td><?= e($ticket['requester']) ?></td><td><a href="ticket.php?id=<?= $ticket['id'] ?>">View</a></td></tr><?php endforeach; ?></tbody></table><?php endif; ?>
<?php require __DIR__ . '/footer.php'; ?>
