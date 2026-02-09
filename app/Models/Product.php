<?php
class Product extends BaseModel
{
    public function all(): array
    {
        $stmt = $this->db->query('SELECT * FROM products ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        return $product ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare('INSERT INTO products (name, sku, category, cost_price, selling_price, opening_stock, minimum_stock) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['name'],
            $data['sku'],
            $data['category'],
            $data['cost_price'],
            $data['selling_price'],
            $data['opening_stock'],
            $data['minimum_stock'],
        ]);
        $productId = (int)$this->db->lastInsertId();
        if ($data['opening_stock'] > 0) {
            $this->recordMovement($productId, 'opening', $data['opening_stock'], 0, 'Opening stock');
        }
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare('UPDATE products SET name = ?, sku = ?, category = ?, cost_price = ?, selling_price = ?, minimum_stock = ? WHERE id = ?');
        $stmt->execute([
            $data['name'],
            $data['sku'],
            $data['category'],
            $data['cost_price'],
            $data['selling_price'],
            $data['minimum_stock'],
            $id,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM products WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function updateStock(int $productId, int $qtyIn, int $qtyOut): void
    {
        $stmt = $this->db->prepare('UPDATE products SET current_stock = current_stock + ? - ? WHERE id = ?');
        $stmt->execute([$qtyIn, $qtyOut, $productId]);
    }

    public function recordMovement(int $productId, string $type, int $qtyIn, int $qtyOut, string $note, ?int $invoiceId = null): void
    {
        $product = $this->find($productId);
        if (!$product) {
            throw new RuntimeException('Product not found.');
        }
        if ($qtyOut > 0 && $product['current_stock'] < $qtyOut) {
            throw new RuntimeException('Negative stock not allowed.');
        }
        $stmt = $this->db->prepare('INSERT INTO stock_movements (product_id, invoice_id, type, quantity_in, quantity_out, note) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$productId, $invoiceId, $type, $qtyIn, $qtyOut, $note]);
        $this->updateStock($productId, $qtyIn, $qtyOut);
    }
}
