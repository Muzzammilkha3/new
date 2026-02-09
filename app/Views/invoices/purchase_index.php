<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Purchase Invoices</h3>
    <a class="btn btn-success" href="/?route=purchase_create">Create Purchase Invoice</a>
</div>
<table class="table table-striped">
    <thead><tr><th>Invoice #</th><th>Date</th><th>Supplier</th><th>Total</th><th>Action</th></tr></thead>
    <tbody>
        <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td><?= htmlspecialchars($invoice['invoice_number']) ?></td>
                <td><?= htmlspecialchars($invoice['invoice_date']) ?></td>
                <td><?= htmlspecialchars($invoice['supplier_name'] ?? '-') ?></td>
                <td><?= number_format($invoice['total_amount'], 2) ?></td>
                <td><a class="btn btn-sm btn-secondary" href="/?route=purchase_show&id=<?= $invoice['id'] ?>">View</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
