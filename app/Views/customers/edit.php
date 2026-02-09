<h3>Edit Customer</h3>
<form method="post" action="/?route=customers_update">
    <input type="hidden" name="id" value="<?= $customer['id'] ?>">
    <div class="row">
        <div class="col-md-6 mb-3"><label class="form-label">Name</label><input name="name" class="form-control" value="<?= htmlspecialchars($customer['name']) ?>" required></div>
        <div class="col-md-6 mb-3"><label class="form-label">Phone</label><input name="phone" class="form-control" value="<?= htmlspecialchars($customer['phone']) ?>"></div>
        <div class="col-md-6 mb-3"><label class="form-label">Email</label><input name="email" type="email" class="form-control" value="<?= htmlspecialchars($customer['email']) ?>"></div>
        <div class="col-md-6 mb-3"><label class="form-label">Address</label><input name="address" class="form-control" value="<?= htmlspecialchars($customer['address']) ?>"></div>
    </div>
    <button class="btn btn-primary">Update</button>
</form>

<h4 class="mt-4">Transaction History</h4>
<table class="table table-striped">
    <thead><tr><th>Invoice</th><th>Date</th><th>Total</th></tr></thead>
    <tbody>
        <?php foreach ($history as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['invoice_number']) ?></td>
                <td><?= htmlspecialchars($row['invoice_date']) ?></td>
                <td><?= number_format($row['total_amount'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
