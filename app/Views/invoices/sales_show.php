<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Sales Invoice <?= htmlspecialchars($invoice['invoice_number']) ?></h3>
    <button class="btn btn-outline-secondary" onclick="window.print()">Print / PDF</button>
</div>
<p><strong>Date:</strong> <?= htmlspecialchars($invoice['invoice_date']) ?> | <strong>Customer:</strong> <?= htmlspecialchars($invoice['customer_name'] ?? 'Walk-in') ?></p>
<table class="table table-striped">
    <thead><tr><th>Product</th><th>Qty</th><th>Rate</th><th>Total</th></tr></thead>
    <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= (int)$item['quantity'] ?></td>
                <td><?= number_format($item['rate'], 2) ?></td>
                <td><?= number_format($item['line_total'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="text-end">
    <p>Discount: ₹<?= number_format($invoice['discount'], 2) ?></p>
    <p>Tax: ₹<?= number_format($invoice['tax'], 2) ?></p>
    <h4>Grand Total: ₹<?= number_format($invoice['total_amount'], 2) ?></h4>
</div>
