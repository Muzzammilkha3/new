<h3>Add Product</h3>
<form method="post" action="/?route=products_store">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Cost Price</label>
            <input type="number" step="0.01" name="cost_price" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Selling Price</label>
            <input type="number" step="0.01" name="selling_price" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Opening Stock</label>
            <input type="number" name="opening_stock" class="form-control" value="0" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Minimum Stock Alert</label>
            <input type="number" name="minimum_stock" class="form-control" value="0" required>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
</form>
