<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Products</h3>
    <a class="btn btn-success" href="/?route=products_create">Add Product</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th><th>SKU</th><th>Category</th><th>Cost</th><th>Selling</th><th>Stock</th><th>Min</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= htmlspecialchars($product['sku']) ?></td>
                <td><?= htmlspecialchars($product['category']) ?></td>
                <td><?= number_format($product['cost_price'], 2) ?></td>
                <td><?= number_format($product['selling_price'], 2) ?></td>
                <td><?= (int)$product['current_stock'] ?></td>
                <td><?= (int)$product['minimum_stock'] ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="/?route=products_edit&id=<?= $product['id'] ?>">Edit</a>
                    <a class="btn btn-sm btn-danger" href="/?route=products_delete&id=<?= $product['id'] ?>" onclick="return confirm('Delete product?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
