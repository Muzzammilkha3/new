<?php
class AdjustmentController extends Controller
{
    public function index(): void
    {
        Auth::requireRole('admin');
        $products = (new Product())->all();
        $db = Database::connection();
        $history = $db->query("SELECT sm.*, p.name FROM stock_movements sm JOIN products p ON sm.product_id = p.id WHERE sm.type = 'adjustment' ORDER BY sm.id DESC")->fetchAll();
        $this->view('adjustments/index', ['products' => $products, 'history' => $history]);
    }

    public function store(): void
    {
        Auth::requireRole('admin');
        $qty = (int)$_POST['quantity'];
        $type = $_POST['adjustment_type'];
        $qtyIn = $type === 'increase' ? $qty : 0;
        $qtyOut = $type === 'decrease' ? $qty : 0;
        $productModel = new Product();
        try {
            $productModel->recordMovement((int)$_POST['product_id'], 'adjustment', $qtyIn, $qtyOut, $_POST['reason']);
            $this->redirect('/?route=adjustments');
        } catch (RuntimeException $e) {
            $products = (new Product())->all();
            $db = Database::connection();
            $history = $db->query(\"SELECT sm.*, p.name FROM stock_movements sm JOIN products p ON sm.product_id = p.id WHERE sm.type = 'adjustment' ORDER BY sm.id DESC\")->fetchAll();
            $this->view('adjustments/index', ['products' => $products, 'history' => $history, 'error' => $e->getMessage()]);
        }
    }
}
