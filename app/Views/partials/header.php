<?php $config = require __DIR__ . '/../../../config/config.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($config['app']['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="/?route=dashboard">Stock Manager</a>
        <div class="collapse navbar-collapse show">
            <ul class="navbar-nav me-auto">
                <?php if (Auth::check()): ?>
                    <?php if (Auth::hasRole('admin')): ?>
                        <li class="nav-item"><a class="nav-link" href="/?route=products">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="/?route=customers">Customers</a></li>
                        <li class="nav-item"><a class="nav-link" href="/?route=suppliers">Suppliers</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="/?route=sales">Sales</a></li>
                    <li class="nav-item"><a class="nav-link" href="/?route=purchases">Purchases</a></li>
                    <li class="nav-item"><a class="nav-link" href="/?route=returns_sales">Sales Return</a></li>
                    <li class="nav-item"><a class="nav-link" href="/?route=returns_purchase">Purchase Return</a></li>
                    <?php if (Auth::hasRole('admin')): ?>
                        <li class="nav-item"><a class="nav-link" href="/?route=adjustments">Adjustments</a></li>
                        <li class="nav-item"><a class="nav-link" href="/?route=reports_stock">Reports</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if (Auth::check()): ?>
                    <li class="nav-item text-white me-2">Hi, <?= htmlspecialchars(Auth::user()['name']) ?></li>
                    <li class="nav-item"><a class="nav-link" href="/?route=logout">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
