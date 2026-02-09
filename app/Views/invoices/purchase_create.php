<h3>Purchase Invoice</h3>
<form method="post" action="/?route=purchase_store" onsubmit="return prepareItems()">
    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label">Invoice Number</label>
            <input class="form-control" name="invoice_number" value="<?= $invoiceNumber ?>" readonly>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Invoice Date</label>
            <input type="date" class="form-control" name="invoice_date" value="<?= date('Y-m-d') ?>" required>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Supplier</label>
            <select name="supplier_id" class="form-select">
                <option value="">Select supplier</option>
                <?php foreach ($suppliers as $supplier): ?>
                    <option value="<?= $supplier['id'] ?>"><?= htmlspecialchars($supplier['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <table class="table" id="itemsTable">
        <thead>
            <tr><th>Product</th><th>Qty</th><th>Rate</th><th>Total</th><th></th></tr>
        </thead>
        <tbody></tbody>
    </table>
    <button type="button" class="btn btn-outline-primary" onclick="addRow()">Add Item</button>

    <div class="row mt-3">
        <div class="col-md-3 mb-3"><label class="form-label">Discount</label><input type="number" step="0.01" name="discount" class="form-control" value="0"></div>
        <div class="col-md-3 mb-3"><label class="form-label">Tax</label><input type="number" step="0.01" name="tax" class="form-control" value="0"></div>
        <div class="col-md-3 mb-3"><label class="form-label">Grand Total</label><input type="number" step="0.01" name="total_amount" id="grandTotal" class="form-control" readonly></div>
    </div>

    <input type="hidden" name="items" id="itemsField">
    <button class="btn btn-success" type="submit">Save Invoice</button>
</form>

<script>
    const products = <?= json_encode($products) ?>;
    function addRow() {
        const tbody = document.querySelector('#itemsTable tbody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select class="form-select product">
                    ${products.map(p => `<option value="${p.id}" data-rate="${p.cost_price}">${p.name}</option>`).join('')}
                </select>
            </td>
            <td><input type="number" class="form-control qty" value="1" min="1"></td>
            <td><input type="number" class="form-control rate" step="0.01" value="0"></td>
            <td class="line-total">0</td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove();calculateTotal();">X</button></td>
        `;
        tbody.appendChild(row);
        const productSelect = row.querySelector('.product');
        const rateInput = row.querySelector('.rate');
        productSelect.addEventListener('change', () => {
            rateInput.value = productSelect.selectedOptions[0].dataset.rate;
            calculateTotal();
        });
        row.querySelectorAll('.qty, .rate').forEach(el => el.addEventListener('input', calculateTotal));
        productSelect.dispatchEvent(new Event('change'));
    }

    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('#itemsTable tbody tr').forEach(row => {
            const qty = parseFloat(row.querySelector('.qty').value || 0);
            const rate = parseFloat(row.querySelector('.rate').value || 0);
            const line = qty * rate;
            row.querySelector('.line-total').textContent = line.toFixed(2);
            total += line;
        });
        const discount = parseFloat(document.querySelector('[name="discount"]').value || 0);
        const tax = parseFloat(document.querySelector('[name="tax"]').value || 0);
        document.querySelector('#grandTotal').value = (total - discount + tax).toFixed(2);
    }

    function prepareItems() {
        const items = [];
        document.querySelectorAll('#itemsTable tbody tr').forEach(row => {
            items.push({
                product_id: row.querySelector('.product').value,
                quantity: row.querySelector('.qty').value,
                rate: row.querySelector('.rate').value,
                line_total: row.querySelector('.line-total').textContent,
            });
        });
        document.querySelector('#itemsField').value = JSON.stringify(items);
        return true;
    }

    document.querySelector('[name="discount"]').addEventListener('input', calculateTotal);
    document.querySelector('[name="tax"]').addEventListener('input', calculateTotal);
    addRow();
</script>
