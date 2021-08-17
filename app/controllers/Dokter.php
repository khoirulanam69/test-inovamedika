<?php

class Dokter extends Controller
{
    public function index()
    {
        if (!$_SESSION['email']) {
            header('Location:' . BASE_URL . '/auth');
        }
        if ($_SESSION['role'] == '1') {
            header('Location:' . BASE_URL . '/admin');
        } else if ($_SESSION['role'] == '3') {
            header('Location:' . BASE_URL . '/user');
        } else {
            $data['title'] = 'Dokter';
            $data['user'] = $this->model('UserModel')->getUser($_SESSION['email']);

            $this->view('templates/header', $data);
            $this->view('templates/topBar', $data);
            $this->view('pages/dokter/index', $data);
            $this->view('templates/footer');
        }
    }

    public function listPatients()
    {
        if (!$_SESSION['email']) {
            header('Location:' . BASE_URL . '/auth');
        }
        if ($_SESSION['role'] == '1') {
            header('Location:' . BASE_URL . '/admin');
        } else if ($_SESSION['role'] == '3') {
            header('Location:' . BASE_URL . '/user');
        } else {
            $data['title'] = 'Dokter';
            $data['registration'] = $this->model('RegistrationPatientModel')->getAllRegistration();
            $data['medicines'] = $this->model('MedicineModel')->getAllMedicine();
            
            $this->view('templates/header', $data);
            $this->view('templates/topBar', $data);
            $this->view('pages/dokter/listPatient', $data);
            $this->view('templates/footer');
        }
    }

    public function getUser()
    {
        echo json_encode($this->model('UserModel')->getUserById($_POST['id']));
    }
    
    public function makeRecipe()
    {
        $medicines = $_POST['recipe'];
        $data['medicines'] = array();
        $data['dokter'] = $this->model('UserModel')->getUser($_SESSION['email']);
        $this->model('RegistrationPatientModel')->updateRegistrationTotalPrice($_POST);
        $data['registration'] = $this->model('RegistrationPatientModel')->getRegistrationById($_POST['id_registration']);
        foreach ($medicines as $medicine) {
            $data['medicines'][] = $this->model('MedicineModel')->getMedicineById($medicine);
        }
        $this->view('pages/dokter/recipePDF', $data);
    }

    public function updateDataRegistration()
    {
        if ($this->model('RegistrationPatientModel')->updateRegistration($_SESSION)>0) {
            header('Location:' . BASE_URL . '/dokter/listpatients');
            unset($_SESSION['id_reg']);
            unset($_SESSION['tgl_create_recipe']);
        } else {
            header('Location:' . BASE_URL . '/dokter/listpatients');
            Flasher::setFlash('danger', "Recipe can't created");
        }
    }

    public function getPrice()
    {
        foreach ($_POST['id'] as $id) {
            $medicine_id = $id;
        }
        echo json_encode($this->model('MedicineModel')->getMedicineById($medicine_id));
    }
}
