<?php

class Auth extends Controller
{
    public function index()
    {
        if (isset($_SESSION['email'])) {
            header('Location: ' . BASE_URL . '/home');
        }

        $data['title'] = 'Login Page';

        $this->view('templates/header', $data);
        $this->view('pages/login');
        $this->view('templates/footer');
    }

    public function store()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $this->model('UserModel')->getUser($email);

        if ($email == $user['email'] && password_verify($password, $user['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $user['role'];
            if ($user['role'] == 1) {
                header('Location: ' . BASE_URL . '/admin',);
            } else if ($user['role'] == 2) {
                header('Location: ' . BASE_URL . '/dokter');
            } else {
                header('Location: ' . BASE_URL . '/user');
            }
        } else {
            Flasher::setFlash('danger', 'Wrong email or password!');
            header('Location: ' . BASE_URL . '/auth');
        }
    }

    public function registration()
    {
        if (isset($_SESSION['email'])) {
            header('Location: ' . BASE_URL . '/home');
        }

        $data['title'] = 'Registration Page';
        $this->view('templates/header', $data);
        $this->view('pages/register');
        $this->view('templates/footer');
    }

    public function registrationstore()
    {
        if ($this->model('UserModel')->addUser($_POST) > 0) {
            Flasher::setFlash('success', 'Your account has been created');
            header('Location: ' . BASE_URL . '/auth');
        }
    }

    public function logout()
    {
        header('Location: ' . BASE_URL . '/auth');
        session_destroy();
    }
}
