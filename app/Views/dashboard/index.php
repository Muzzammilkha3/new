<h2>Dashboard</h2>
<div class="row g-3">
    <div class="col-md-4"><div class="card"><div class="card-body">Total Products: <?= $totals['products'] ?></div></div></div>
    <div class="col-md-4"><div class="card"><div class="card-body">Current Stock Value: ₹<?= number_format($totals['stock_value'], 2) ?></div></div></div>
    <div class="col-md-4"><div class="card"><div class="card-body">Low Stock Alerts: <?= $totals['low_stock'] ?></div></div></div>
    <div class="col-md-4"><div class="card"><div class="card-body">Out of Stock: <?= $totals['out_of_stock'] ?></div></div></div>
    <div class="col-md-4"><div class="card"><div class="card-body">Today Sales: ₹<?= number_format($totals['today_sales'], 2) ?></div></div></div>
    <div class="col-md-4"><div class="card"><div class="card-body">Monthly Sales: ₹<?= number_format($totals['month_sales'], 2) ?></div></div></div>
</div>
