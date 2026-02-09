<h3>Sales Report</h3>
<a class="btn btn-outline-secondary mb-3" href="/?route=reports_export&type=sales">Export CSV</a>
<table class="table table-striped">
    <thead><tr><th>Invoice</th><th>Date</th><th>Total</th></tr></thead>
    <tbody>
        <?php foreach ($report as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['invoice_number']) ?></td>
                <td><?= htmlspecialchars($row['invoice_date']) ?></td>
                <td><?= number_format($row['total_amount'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
