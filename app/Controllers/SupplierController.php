<?php
class SupplierController extends Controller
{
    public function index(): void
    {
        Auth::requireRole('admin');
        $model = new Supplier();
        $this->view('suppliers/index', ['suppliers' => $model->all()]);
    }

    public function create(): void
    {
        Auth::requireRole('admin');
        $this->view('suppliers/create');
    }

    public function store(): void
    {
        Auth::requireRole('admin');
        $model = new Supplier();
        $model->create($_POST);
        $this->redirect('/?route=suppliers');
    }

    public function edit(): void
    {
        Auth::requireRole('admin');
        $model = new Supplier();
        $supplier = $model->find((int)$_GET['id']);
        $db = Database::connection();
        $historyStmt = $db->prepare('SELECT invoice_number, invoice_date, total_amount FROM purchase_invoices WHERE supplier_id = ? ORDER BY invoice_date DESC');
        $historyStmt->execute([(int)$_GET['id']]);
        $history = $historyStmt->fetchAll();
        $this->view('suppliers/edit', ['supplier' => $supplier, 'history' => $history]);
    }

    public function update(): void
    {
        Auth::requireRole('admin');
        $model = new Supplier();
        $model->update((int)$_POST['id'], $_POST);
        $this->redirect('/?route=suppliers');
    }

    public function delete(): void
    {
        Auth::requireRole('admin');
        $model = new Supplier();
        $model->delete((int)$_GET['id']);
        $this->redirect('/?route=suppliers');
    }
}
