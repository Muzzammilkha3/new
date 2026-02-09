<?php
session_start();
require __DIR__ . '/../app/Core/Database.php';
require __DIR__ . '/../app/Core/Controller.php';
require __DIR__ . '/../app/Core/Auth.php';

spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../app/Controllers/' . $class . '.php',
        __DIR__ . '/../app/Models/' . $class . '.php',
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require $path;
            return;
        }
    }
});

$route = $_GET['route'] ?? (Auth::check() ? 'dashboard' : 'login');

switch ($route) {
    case 'login':
        (new AuthController())->showLogin();
        break;
    case 'login_post':
        (new AuthController())->login();
        break;
    case 'logout':
        (new AuthController())->logout();
        break;
    case 'dashboard':
        (new DashboardController())->index();
        break;
    case 'products':
        (new ProductController())->index();
        break;
    case 'products_create':
        (new ProductController())->create();
        break;
    case 'products_store':
        (new ProductController())->store();
        break;
    case 'products_edit':
        (new ProductController())->edit();
        break;
    case 'products_update':
        (new ProductController())->update();
        break;
    case 'products_delete':
        (new ProductController())->delete();
        break;
    case 'customers':
        (new CustomerController())->index();
        break;
    case 'customers_create':
        (new CustomerController())->create();
        break;
    case 'customers_store':
        (new CustomerController())->store();
        break;
    case 'customers_edit':
        (new CustomerController())->edit();
        break;
    case 'customers_update':
        (new CustomerController())->update();
        break;
    case 'customers_delete':
        (new CustomerController())->delete();
        break;
    case 'suppliers':
        (new SupplierController())->index();
        break;
    case 'suppliers_create':
        (new SupplierController())->create();
        break;
    case 'suppliers_store':
        (new SupplierController())->store();
        break;
    case 'suppliers_edit':
        (new SupplierController())->edit();
        break;
    case 'suppliers_update':
        (new SupplierController())->update();
        break;
    case 'suppliers_delete':
        (new SupplierController())->delete();
        break;
    case 'sales':
        (new SalesInvoiceController())->index();
        break;
    case 'sales_create':
        (new SalesInvoiceController())->create();
        break;
    case 'sales_store':
        (new SalesInvoiceController())->store();
        break;
    case 'sales_show':
        (new SalesInvoiceController())->show();
        break;
    case 'purchases':
        (new PurchaseInvoiceController())->index();
        break;
    case 'purchase_create':
        (new PurchaseInvoiceController())->create();
        break;
    case 'purchase_store':
        (new PurchaseInvoiceController())->store();
        break;
    case 'purchase_show':
        (new PurchaseInvoiceController())->show();
        break;
    case 'returns_sales':
        (new ReturnController())->sales();
        break;
    case 'returns_purchase':
        (new ReturnController())->purchase();
        break;
    case 'returns_sales_store':
        (new ReturnController())->storeSales();
        break;
    case 'returns_purchase_store':
        (new ReturnController())->storePurchase();
        break;
    case 'adjustments':
        (new AdjustmentController())->index();
        break;
    case 'adjustments_store':
        (new AdjustmentController())->store();
        break;
    case 'reports_stock':
        (new ReportController())->stock();
        break;
    case 'reports_sales':
        (new ReportController())->sales();
        break;
    case 'reports_purchase':
        (new ReportController())->purchase();
        break;
    case 'reports_profit':
        (new ReportController())->profitLoss();
        break;
    case 'reports_export':
        (new ReportController())->exportCsv();
        break;
    default:
        http_response_code(404);
        echo 'Route not found';
}
