<?php
class ReturnController extends Controller
{
    public function sales(): void
    {
        Auth::requireLogin();
        $products = (new Product())->all();
        $this->view('returns/sales', ['products' => $products]);
    }

    public function purchase(): void
    {
        Auth::requireLogin();
        $products = (new Product())->all();
        $this->view('returns/purchase', ['products' => $products]);
    }

    public function storeSales(): void
    {
        Auth::requireLogin();
        $productModel = new Product();
        try {
            $productModel->recordMovement((int)$_POST['product_id'], 'sales_return', (int)$_POST['quantity'], 0, $_POST['reason']);
            $this->redirect('/?route=returns_sales');
        } catch (RuntimeException $e) {
            $products = (new Product())->all();
            $this->view('returns/sales', ['products' => $products, 'error' => $e->getMessage()]);
        }
    }

    public function storePurchase(): void
    {
        Auth::requireLogin();
        $productModel = new Product();
        try {
            $productModel->recordMovement((int)$_POST['product_id'], 'purchase_return', 0, (int)$_POST['quantity'], $_POST['reason']);
            $this->redirect('/?route=returns_purchase');
        } catch (RuntimeException $e) {
            $products = (new Product())->all();
            $this->view('returns/purchase', ['products' => $products, 'error' => $e->getMessage()]);
        }
    }
}
