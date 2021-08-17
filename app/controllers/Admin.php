<?php

class Admin extends Controller
{
    public function index()
    {
        if (!$_SESSION['email']) {
            header('Location:' . BASE_URL . '/auth');
        }
        if ($_SESSION['role'] == '2') {
            header('Location:' . BASE_URL . '/dokter');
        } else if ($_SESSION['role'] == '3') {
            header('Location:' . BASE_URL . '/user');
        } else {
            $data['title'] = 'Admin';
            $data['user'] = $this->model('UserModel')->getUser($_SESSION['email']);

            $this->view('templates/header', $data);
            $this->view('templates/topBar', $data);
            $this->view('pages/admin/index', $data);
            $this->view('templates/footer');
        }
    }

    public function allUser()
    {
        if (!$_SESSION['email']) {
            header('Location:' . BASE_URL . '/auth');
        }
        if ($_SESSION['role'] == '2') {
            header('Location:' . BASE_URL . '/dokter');
        } else if ($_SESSION['role'] == '3') {
            header('Location:' . BASE_URL . '/user');
        } else {
            $data['title'] = 'List User';
            $data['users'] = $this->model('UserModel')->getAlluser();

            $this->view('templates/header', $data);
            $this->view('templates/topBar', $data);
            $this->view('pages/admin/listUser', $data);
            $this->view('templates/footer');
        }
    }

    public function editUser()
    {
        echo json_encode($this->model('UserModel')->getUserById($_POST['id']));
    }

    public function editUserStore()
    {
        if ($this->model('UserModel')->updateUser($_POST) > 0) {
            Flasher::setFlash('success', 'Successfully edited');
            header('Location: ' . BASE_URL . '/admin/alluser');
        } else {
            header('Location: ' . BASE_URL . '/admin/alluser');
        }
    }

    public function deleteUser($id)
    {
        if ($this->model('UserModel')->deleteUser($id) > 0) {
            Flasher::setFlash('success', 'Delete successfully');
            header('Location:' . BASE_URL . '/admin/alluser');
        } else {
            Flasher::setFlash('danger', 'Delete failed');
            header('Location:' . BASE_URL . '/admin/alluser');
        }
    }

    public function medicine()
    {
        if (!$_SESSION['email']) {
            header('Location:' . BASE_URL . '/auth');
        }
        if ($_SESSION['role'] == '2') {
            header('Location:' . BASE_URL . '/dokter');
        } else if ($_SESSION['role'] == '3') {
            header('Location:' . BASE_URL . '/user');
        } else {
            $data['title'] = 'Admin';
            $data['medicines'] = $this->model('MedicineModel')->getAllMedicine();

            $this->view('templates/header', $data);
            $this->view('templates/topBar', $data);
            $this->view('pages/admin/medicine', $data);
            $this->view('templates/footer');
        }
    }

    public function addMedicine()
    {
        if ($this->model('MedicineModel')->addMedicine($_POST) > 0) {
            Flasher::setFlash('success', 'New medicine has been added');
            header('Location: ' . BASE_URL . '/admin/medicine');
        } else {
            header('Location: ' . BASE_URL . '/admin/medicine');
        }
    }

    public function editMedicine()
    {
        echo json_encode($this->model('MedicineModel')->getMedicineById($_POST['id']));
    }

    public function updateMedicine()
    {
        if ($this->model('MedicineModel')->updateMedicine($_POST) > 0) {
            Flasher::setFlash('success', 'Update successfully');
            header('Location: ' . BASE_URL . '/admin/medicine');
        } else {
            header('Location: ' . BASE_URL . '/admin/medicine');
        }
    }

    public function deleteMedicine($id)
    {
        if ($this->model('MedicineModel')->deleteMedicine($id) > 0) {
            Flasher::setFlash('success', 'Delete successfully');
            header('Location: ' . BASE_URL . '/admin/medicine');
        } else {
            header('Location: ' . BASE_URL . '/admin/medicine');
        }
    }
}
