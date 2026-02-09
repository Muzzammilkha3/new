<?php
class PurchaseInvoiceController extends Controller
{
    public function index(): void
    {
        Auth::requireLogin();
        $invoiceModel = new Invoice();
        $this->view('invoices/purchase_index', ['invoices' => $invoiceModel->getPurchases()]);
    }

    public function create(): void
    {
        Auth::requireLogin();
        $products = (new Product())->all();
        $suppliers = (new Supplier())->all();
        $invoiceNumber = 'PI-' . date('Ymd-His');
        $this->view('invoices/purchase_create', [
            'products' => $products,
            'suppliers' => $suppliers,
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
            'supplier_id' => $_POST['supplier_id'] ?: null,
            'discount' => $_POST['discount'] ?? 0,
            'tax' => $_POST['tax'] ?? 0,
            'total_amount' => $_POST['total_amount'],
            'created_by' => Auth::user()['id'],
        ];
        $invoiceModel = new Invoice();
        $id = $invoiceModel->createPurchase($invoice, $items);
        $this->redirect('/?route=purchase_show&id=' . $id);
    }

    public function show(): void
    {
        Auth::requireLogin();
        $invoiceId = (int)$_GET['id'];
        $invoiceModel = new Invoice();
        $db = Database::connection();
        $invoice = $db->prepare('SELECT p.*, s.name AS supplier_name FROM purchase_invoices p LEFT JOIN suppliers s ON p.supplier_id = s.id WHERE p.id = ?');
        $invoice->execute([$invoiceId]);
        $data = $invoice->fetch();
        $items = $invoiceModel->invoiceItems('purchase', $invoiceId);
        $this->view('invoices/purchase_show', ['invoice' => $data, 'items' => $items]);
    }
}
