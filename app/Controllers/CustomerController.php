<?php
class CustomerController extends Controller
{
    public function index(): void
    {
        Auth::requireRole('admin');
        $model = new Customer();
        $this->view('customers/index', ['customers' => $model->all()]);
    }

    public function create(): void
    {
        Auth::requireRole('admin');
        $this->view('customers/create');
    }

    public function store(): void
    {
        Auth::requireRole('admin');
        $model = new Customer();
        $model->create($_POST);
        $this->redirect('/?route=customers');
    }

    public function edit(): void
    {
        Auth::requireRole('admin');
        $model = new Customer();
        $customer = $model->find((int)$_GET['id']);
        $db = Database::connection();
        $historyStmt = $db->prepare('SELECT invoice_number, invoice_date, total_amount FROM sales_invoices WHERE customer_id = ? ORDER BY invoice_date DESC');
        $historyStmt->execute([(int)$_GET['id']]);
        $history = $historyStmt->fetchAll();
        $this->view('customers/edit', ['customer' => $customer, 'history' => $history]);
    }

    public function update(): void
    {
        Auth::requireRole('admin');
        $model = new Customer();
        $model->update((int)$_POST['id'], $_POST);
        $this->redirect('/?route=customers');
    }

    public function delete(): void
    {
        Auth::requireRole('admin');
        $model = new Customer();
        $model->delete((int)$_GET['id']);
        $this->redirect('/?route=customers');
    }
}
