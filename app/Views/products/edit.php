<h3>Edit Product</h3>
<form method="post" action="/?route=products_update">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" value="<?= htmlspecialchars($product['sku']) ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($product['category']) ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Cost Price</label>
            <input type="number" step="0.01" name="cost_price" class="form-control" value="<?= $product['cost_price'] ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Selling Price</label>
            <input type="number" step="0.01" name="selling_price" class="form-control" value="<?= $product['selling_price'] ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Minimum Stock Alert</label>
            <input type="number" name="minimum_stock" class="form-control" value="<?= $product['minimum_stock'] ?>" required>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Update</button>
</form>
