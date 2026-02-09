<?php
class ReportController extends Controller
{
    public function stock(): void
    {
        Auth::requireRole('admin');
        $db = Database::connection();
        $report = $db->query('SELECT name, sku, category, current_stock, minimum_stock, cost_price, selling_price FROM products ORDER BY name')->fetchAll();
        $this->view('reports/stock', ['report' => $report]);
    }

    public function sales(): void
    {
        Auth::requireRole('admin');
        $db = Database::connection();
        $report = $db->query('SELECT invoice_number, invoice_date, total_amount FROM sales_invoices ORDER BY invoice_date DESC')->fetchAll();
        $this->view('reports/sales', ['report' => $report]);
    }

    public function purchase(): void
    {
        Auth::requireRole('admin');
        $db = Database::connection();
        $report = $db->query('SELECT invoice_number, invoice_date, total_amount FROM purchase_invoices ORDER BY invoice_date DESC')->fetchAll();
        $this->view('reports/purchase', ['report' => $report]);
    }

    public function profitLoss(): void
    {
        Auth::requireRole('admin');
        $db = Database::connection();
        $sales = $db->query('SELECT IFNULL(SUM(total_amount), 0) AS total FROM sales_invoices')->fetch()['total'];
        $purchases = $db->query('SELECT IFNULL(SUM(total_amount), 0) AS total FROM purchase_invoices')->fetch()['total'];
        $profit = $sales - $purchases;
        $this->view('reports/profit_loss', ['sales' => $sales, 'purchases' => $purchases, 'profit' => $profit]);
    }

    public function exportCsv(): void
    {
        Auth::requireRole('admin');
        $type = $_GET['type'] ?? 'stock';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $type . '_report.csv"');
        $output = fopen('php://output', 'w');
        if ($type === 'sales') {
            fputcsv($output, ['Invoice', 'Date', 'Total']);
            $rows = Database::connection()->query('SELECT invoice_number, invoice_date, total_amount FROM sales_invoices')->fetchAll();
            foreach ($rows as $row) {
                fputcsv($output, $row);
            }
        } elseif ($type === 'purchase') {
            fputcsv($output, ['Invoice', 'Date', 'Total']);
            $rows = Database::connection()->query('SELECT invoice_number, invoice_date, total_amount FROM purchase_invoices')->fetchAll();
            foreach ($rows as $row) {
                fputcsv($output, $row);
            }
        } else {
            fputcsv($output, ['Name', 'SKU', 'Category', 'Stock', 'Min Stock']);
            $rows = Database::connection()->query('SELECT name, sku, category, current_stock, minimum_stock FROM products')->fetchAll();
            foreach ($rows as $row) {
                fputcsv($output, $row);
            }
        }
        fclose($output);
        exit;
    }
}
