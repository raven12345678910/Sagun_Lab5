<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('AuthModel');
    }

    public function login()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('/products');
            return;
        }

        $this->call->view('auth/login');
    }

    public function authenticate()
    {
        $username = trim($this->io->post('username'));
        $password = $this->io->post('password');

        $user = $this->AuthModel->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $this->session->set_userdata([
                'logged_in' => true,
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role']
            ]);

            redirect('/products');
            return;
        }

        $this->call->view('auth/login', [
            'error' => 'Invalid username or password.'
        ]);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/login');
    }
}
