<h3>Stock Report</h3>
<a class="btn btn-outline-secondary mb-3" href="/?route=reports_export&type=stock">Export CSV</a>
<table class="table table-striped">
    <thead><tr><th>Name</th><th>SKU</th><th>Category</th><th>Stock</th><th>Min</th><th>Cost</th><th>Selling</th></tr></thead>
    <tbody>
        <?php foreach ($report as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['sku']) ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td><?= (int)$row['current_stock'] ?></td>
                <td><?= (int)$row['minimum_stock'] ?></td>
                <td><?= number_format($row['cost_price'], 2) ?></td>
                <td><?= number_format($row['selling_price'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
