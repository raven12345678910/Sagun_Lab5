<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('/login');
            exit;
        }

        $this->call->model('ProductModel');
    }

    public function index()
    {
        $products = $this->ProductModel->getAll();
        $this->call->view('products/index', [
            'products' => $products,
            'username' => $this->session->userdata('username')
        ]);
    }

    public function create()
    {
        $this->call->view('products/create');
    }

    public function store()
    {
        $product_name = trim($this->io->post('product_name'));
        $description  = trim($this->io->post('description'));
        $price        = $this->io->post('price');
        $quantity     = $this->io->post('quantity');

        if ($product_name === '' || !is_numeric($price) || !is_numeric($quantity)) {
            $this->call->view('products/create', [
                'error' => 'Please enter valid product details.'
            ]);
            return;
        }

        $this->ProductModel->createProduct([
            'product_name' => $product_name,
            'description'  => $description,
            'price'        => number_format((float)$price, 2, '.', ''),
            'quantity'     => (int)$quantity
        ]);

        redirect('/products');
    }

    public function edit($id)
    {
        $product = $this->ProductModel->findById((int)$id);

        if (!$product) {
            show_404();
            return;
        }

        $this->call->view('products/edit', ['product' => $product]);
    }

    public function update($id)
    {
        $product_name = trim($this->io->post('product_name'));
        $description  = trim($this->io->post('description'));
        $price        = $this->io->post('price');
        $quantity     = $this->io->post('quantity');

        if ($product_name === '' || !is_numeric($price) || !is_numeric($quantity)) {
            $product = $this->ProductModel->findById((int)$id);
            $this->call->view('products/edit', [
                'product' => $product,
                'error'   => 'Please enter valid product details.'
            ]);
            return;
        }

        $this->ProductModel->updateProduct((int)$id, [
            'product_name' => $product_name,
            'description'  => $description,
            'price'        => number_format((float)$price, 2, '.', ''),
            'quantity'     => (int)$quantity
        ]);

        redirect('/products');
    }

    public function delete($id)
    {
        $this->ProductModel->deleteProduct((int)$id);
        redirect('/products');
    }
}
