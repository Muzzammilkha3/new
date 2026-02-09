<h3>Stock Adjustments</h3>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form method="post" action="/?route=adjustments_store" class="mb-4">
    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label">Product</label>
            <select name="product_id" class="form-select">
                <?php foreach ($products as $product): ?>
                    <option value="<?= $product['id'] ?>"><?= htmlspecialchars($product['name']) ?> (Stock: <?= $product['current_stock'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2 mb-3">
            <label class="form-label">Type</label>
            <select name="adjustment_type" class="form-select">
                <option value="increase">Increase</option>
                <option value="decrease">Decrease</option>
            </select>
        </div>
        <div class="col-md-2 mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" min="1" required>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Reason</label>
            <input type="text" name="reason" class="form-control" required>
        </div>
    </div>
    <button class="btn btn-primary">Apply Adjustment</button>
</form>

<h4>Adjustment History</h4>
<table class="table table-striped">
    <thead><tr><th>Date</th><th>Product</th><th>Qty In</th><th>Qty Out</th><th>Reason</th></tr></thead>
    <tbody>
        <?php foreach ($history as $entry): ?>
            <tr>
                <td><?= htmlspecialchars($entry['created_at']) ?></td>
                <td><?= htmlspecialchars($entry['name']) ?></td>
                <td><?= (int)$entry['quantity_in'] ?></td>
                <td><?= (int)$entry['quantity_out'] ?></td>
                <td><?= htmlspecialchars($entry['note']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
