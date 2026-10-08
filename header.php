<?php require_once __DIR__ . '/auth.php'; require_login(); ?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><link rel="stylesheet" href="assets/style.css"><title>Student Helpdesk</title></head><body>
<nav><strong>Student Helpdesk</strong><span><?= e($_SESSION['user']['name']) ?> (<?= e($_SESSION['user']['role']) ?>)</span><a href="dashboard.php">Dashboard</a><a href="create_ticket.php">New ticket</a><a href="logout.php">Log out</a></nav><main class="container">
