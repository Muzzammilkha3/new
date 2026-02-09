<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Suppliers</h3>
    <a class="btn btn-success" href="/?route=suppliers_create">Add Supplier</a>
</div>
<table class="table table-striped">
    <thead><tr><th>Name</th><th>Phone</th><th>Email</th><th>Actions</th></tr></thead>
    <tbody>
        <?php foreach ($suppliers as $supplier): ?>
            <tr>
                <td><?= htmlspecialchars($supplier['name']) ?></td>
                <td><?= htmlspecialchars($supplier['phone']) ?></td>
                <td><?= htmlspecialchars($supplier['email']) ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="/?route=suppliers_edit&id=<?= $supplier['id'] ?>">Edit</a>
                    <a class="btn btn-sm btn-danger" href="/?route=suppliers_delete&id=<?= $supplier['id'] ?>" onclick="return confirm('Delete supplier?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
