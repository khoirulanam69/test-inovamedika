<?php

class User extends Controller
{
    public function index()
    {
        if (!$_SESSION['email']) {
            header('Location:' . BASE_URL . '/auth');
        }
        if ($_SESSION['role'] == '1') {
            header('Location:' . BASE_URL . '/admin');
        } else if ($_SESSION['role'] == '2') {
            header('Location:' . BASE_URL . '/dokter');
        } else {
            $data['title'] = 'User';
            $data['user'] = $this->model('UserModel')->getUser($_SESSION['email']);

            $this->view('templates/header', $data);
            $this->view('templates/topBar', $data);
            $this->view('pages/user/index', $data);
            $this->view('templates/footer');
        }
    }

    public function registration()
    {
        if (!$_SESSION['email']) {
            header('Location:' . BASE_URL . '/auth');
        }
        if ($_SESSION['role'] == '1') {
            header('Location:' . BASE_URL . '/admin');
        } else if ($_SESSION['role'] == '2') {
            header('Location:' . BASE_URL . '/dokter');
        } else {
            $data['title'] = 'User';
            $data['user'] = $this->model('UserModel')->getUser($_SESSION['email']);
            $data['registration'] = $this->model('RegistrationPatientModel')->getAllRegistrationByUserEmail($_SESSION['email']);
            $this->view('templates/header', $data);
            $this->view('templates/topBar', $data);
            $this->view('pages/user/registration', $data);
            $this->view('templates/footer');
        }
    }

    public function registrationStore()
    {
        if ($this->model('RegistrationPatientModel')->addRegistration($_POST) > 0) {
            Flasher::setFlash('success', 'Registration success');
            header('Location: ' . BASE_URL . '/user/registration');
        } else {
            header('Location: ' . BASE_URL . '/user/registration');
        }
    }

    public function getTotalPrice()
    {
        echo json_encode($this->model('RegistrationPatientModel')->getRegistrationById($_POST['id']));
    }

    public function payment()
    {
        if ($this->model('RegistrationPatientModel')->updatePayment($_POST) > 0) {
            Flasher::setFlash('success', 'Payment success');
            header('Location: ' . BASE_URL . '/user/registration');
        } else {
            header('Location: ' . BASE_URL . '/user/registration');
        }
    }
}
