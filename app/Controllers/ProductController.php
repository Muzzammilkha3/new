<?php
class ProductController extends Controller
{
    public function index(): void
    {
        Auth::requireRole('admin');
        $model = new Product();
        $this->view('products/index', ['products' => $model->all()]);
    }

    public function create(): void
    {
        Auth::requireRole('admin');
        $this->view('products/create');
    }

    public function store(): void
    {
        Auth::requireRole('admin');
        $model = new Product();
        $model->create($_POST);
        $this->redirect('/?route=products');
    }

    public function edit(): void
    {
        Auth::requireRole('admin');
        $model = new Product();
        $product = $model->find((int)$_GET['id']);
        $this->view('products/edit', ['product' => $product]);
    }

    public function update(): void
    {
        Auth::requireRole('admin');
        $model = new Product();
        $model->update((int)$_POST['id'], $_POST);
        $this->redirect('/?route=products');
    }

    public function delete(): void
    {
        Auth::requireRole('admin');
        $model = new Product();
        $model->delete((int)$_GET['id']);
        $this->redirect('/?route=products');
    }
}
