<?php
class DashboardController extends Controller
{
    public function index(): void
    {
        Auth::requireLogin();
        $db = Database::connection();
        $totals = [
            'products' => (int)$db->query('SELECT COUNT(*) AS total FROM products')->fetch()['total'],
            'stock_value' => (float)$db->query('SELECT SUM(current_stock * cost_price) AS total FROM products')->fetch()['total'],
            'low_stock' => $db->query('SELECT COUNT(*) AS total FROM products WHERE current_stock <= minimum_stock')->fetch()['total'],
            'out_of_stock' => $db->query('SELECT COUNT(*) AS total FROM products WHERE current_stock = 0')->fetch()['total'],
            'today_sales' => $db->query('SELECT IFNULL(SUM(total_amount), 0) AS total FROM sales_invoices WHERE DATE(invoice_date) = CURDATE()')->fetch()['total'],
            'month_sales' => $db->query('SELECT IFNULL(SUM(total_amount), 0) AS total FROM sales_invoices WHERE MONTH(invoice_date) = MONTH(CURDATE()) AND YEAR(invoice_date) = YEAR(CURDATE())')->fetch()['total'],
        ];
        $this->view('dashboard/index', ['totals' => $totals]);
    }
}
