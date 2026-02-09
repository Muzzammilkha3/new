<?php
class SalesInvoiceController extends Controller
{
    public function index(): void
    {
        Auth::requireLogin();
        $invoiceModel = new Invoice();
        $this->view('invoices/sales_index', ['invoices' => $invoiceModel->getSales()]);
    }

    public function create(): void
    {
        Auth::requireLogin();
        $products = (new Product())->all();
        $customers = (new Customer())->all();
        $invoiceNumber = 'SI-' . date('Ymd-His');
        $this->view('invoices/sales_create', [
            'products' => $products,
            'customers' => $customers,
            'invoiceNumber' => $invoiceNumber,
        ]);
    }

    public function store(): void
    {
        Auth::requireLogin();
        $items = json_decode($_POST['items'], true) ?? [];
        $invoice = [
            'invoice_number' => $_POST['invoice_number'],
            'invoice_date' => $_POST['invoice_date'],
            'customer_id' => $_POST['customer_id'] ?: null,
            'discount' => $_POST['discount'] ?? 0,
            'tax' => $_POST['tax'] ?? 0,
            'total_amount' => $_POST['total_amount'],
            'created_by' => Auth::user()['id'],
        ];
        $invoiceModel = new Invoice();
        try {
            $id = $invoiceModel->createSales($invoice, $items);
            $this->redirect('/?route=sales_show&id=' . $id);
        } catch (RuntimeException $e) {
            $products = (new Product())->all();
            $customers = (new Customer())->all();
            $this->view('invoices/sales_create', [
                'products' => $products,
                'customers' => $customers,
                'invoiceNumber' => $invoice['invoice_number'],
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function show(): void
    {
        Auth::requireLogin();
        $invoiceId = (int)$_GET['id'];
        $invoiceModel = new Invoice();
        $db = Database::connection();
        $invoice = $db->prepare('SELECT s.*, c.name AS customer_name FROM sales_invoices s LEFT JOIN customers c ON s.customer_id = c.id WHERE s.id = ?');
        $invoice->execute([$invoiceId]);
        $data = $invoice->fetch();
        $items = $invoiceModel->invoiceItems('sale', $invoiceId);
        $this->view('invoices/sales_show', ['invoice' => $data, 'items' => $items]);
    }
}
