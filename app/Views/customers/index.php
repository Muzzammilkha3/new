<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Customers</h3>
    <a class="btn btn-success" href="/?route=customers_create">Add Customer</a>
</div>
<table class="table table-striped">
    <thead><tr><th>Name</th><th>Phone</th><th>Email</th><th>Actions</th></tr></thead>
    <tbody>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= htmlspecialchars($customer['name']) ?></td>
                <td><?= htmlspecialchars($customer['phone']) ?></td>
                <td><?= htmlspecialchars($customer['email']) ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="/?route=customers_edit&id=<?= $customer['id'] ?>">Edit</a>
                    <a class="btn btn-sm btn-danger" href="/?route=customers_delete&id=<?= $customer['id'] ?>" onclick="return confirm('Delete customer?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
