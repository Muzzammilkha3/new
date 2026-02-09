<h3>Purchase Return</h3>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form method="post" action="/?route=returns_purchase_store">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Product</label>
            <select name="product_id" class="form-select">
                <?php foreach ($products as $product): ?>
                    <option value="<?= $product['id'] ?>"><?= htmlspecialchars($product['name']) ?> (Stock: <?= $product['current_stock'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3 mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" min="1" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Reason</label>
            <input type="text" name="reason" class="form-control" required>
        </div>
    </div>
    <button class="btn btn-primary">Process Return</button>
</form>
