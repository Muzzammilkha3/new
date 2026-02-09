<?php
class Invoice extends BaseModel
{
    public function createSales(array $invoice, array $items): int
    {
        $this->db->beginTransaction();
        $stmt = $this->db->prepare('INSERT INTO sales_invoices (invoice_number, invoice_date, customer_id, discount, tax, total_amount, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $invoice['invoice_number'],
            $invoice['invoice_date'],
            $invoice['customer_id'],
            $invoice['discount'],
            $invoice['tax'],
            $invoice['total_amount'],
            $invoice['created_by'],
        ]);
        $invoiceId = (int)$this->db->lastInsertId();
        $productModel = new Product();

        foreach ($items as $item) {
            $itemStmt = $this->db->prepare('INSERT INTO invoice_items (invoice_id, invoice_type, product_id, quantity, rate, line_total) VALUES (?, ?, ?, ?, ?, ?)');
            $itemStmt->execute([$invoiceId, 'sale', $item['product_id'], $item['quantity'], $item['rate'], $item['line_total']]);
            $product = $productModel->find((int)$item['product_id']);
            if (!$product || $product['current_stock'] < $item['quantity']) {
                $this->db->rollBack();
                throw new RuntimeException('Insufficient stock for product ID ' . $item['product_id']);
            }
            $productModel->recordMovement((int)$item['product_id'], 'sale', 0, (int)$item['quantity'], 'Sales Invoice #' . $invoice['invoice_number'], $invoiceId);
        }
        $this->db->commit();
        return $invoiceId;
    }

    public function createPurchase(array $invoice, array $items): int
    {
        $this->db->beginTransaction();
        $stmt = $this->db->prepare('INSERT INTO purchase_invoices (invoice_number, invoice_date, supplier_id, discount, tax, total_amount, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $invoice['invoice_number'],
            $invoice['invoice_date'],
            $invoice['supplier_id'],
            $invoice['discount'],
            $invoice['tax'],
            $invoice['total_amount'],
            $invoice['created_by'],
        ]);
        $invoiceId = (int)$this->db->lastInsertId();
        $productModel = new Product();

        foreach ($items as $item) {
            $itemStmt = $this->db->prepare('INSERT INTO invoice_items (invoice_id, invoice_type, product_id, quantity, rate, line_total) VALUES (?, ?, ?, ?, ?, ?)');
            $itemStmt->execute([$invoiceId, 'purchase', $item['product_id'], $item['quantity'], $item['rate'], $item['line_total']]);
            $productModel->recordMovement((int)$item['product_id'], 'purchase', (int)$item['quantity'], 0, 'Purchase Invoice #' . $invoice['invoice_number'], $invoiceId);
        }
        $this->db->commit();
        return $invoiceId;
    }

    public function getSales(): array
    {
        return $this->db->query('SELECT s.*, c.name AS customer_name FROM sales_invoices s LEFT JOIN customers c ON s.customer_id = c.id ORDER BY s.id DESC')->fetchAll();
    }

    public function getPurchases(): array
    {
        return $this->db->query('SELECT p.*, s.name AS supplier_name FROM purchase_invoices p LEFT JOIN suppliers s ON p.supplier_id = s.id ORDER BY p.id DESC')->fetchAll();
    }

    public function invoiceItems(string $type, int $invoiceId): array
    {
        $stmt = $this->db->prepare('SELECT i.*, p.name FROM invoice_items i JOIN products p ON i.product_id = p.id WHERE i.invoice_type = ? AND i.invoice_id = ?');
        $stmt->execute([$type, $invoiceId]);
        return $stmt->fetchAll();
    }
}
