<?php
class Supplier extends BaseModel
{
    public function all(): array
    {
        return $this->db->query('SELECT * FROM suppliers ORDER BY id DESC')->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM suppliers WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare('INSERT INTO suppliers (name, phone, email, address) VALUES (?, ?, ?, ?)');
        $stmt->execute([$data['name'], $data['phone'], $data['email'], $data['address']]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare('UPDATE suppliers SET name = ?, phone = ?, email = ?, address = ? WHERE id = ?');
        $stmt->execute([$data['name'], $data['phone'], $data['email'], $data['address'], $id]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM suppliers WHERE id = ?');
        $stmt->execute([$id]);
    }
}
