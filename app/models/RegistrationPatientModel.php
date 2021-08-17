<?php

class RegistrationPatientModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllRegistration()
    {
        $query = "SELECT * FROM registration_patient LEFT JOIN user ON user.id = registration_patient.id_registration";
        $this->db->query($query);
        return $this->db->results();
    }

    public function getAllRegistrationByUserEmail($email)
    {
        $query = "SELECT * FROM user INNER JOIN registration_patient ON user.id = registration_patient.id_registration WHERE user.email=:email";
        $this->db->query($query);
        $this->db->bind('email', $email);
        return $this->db->results();
    }

    public function getRegistrationById($id)
    {
        $query = "SELECT * FROM registration_patient INNER JOIN user ON user.id = registration_patient.id_registration WHERE registration_patient.id_reg=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->result();
    }

    public function addRegistration($data)
    {
        $query = "INSERT INTO registration_patient VALUES ('', :address, :complaint, :description, :action, :id_registration, :tgl_create_recipe)";
        $this->db->query($query);
        $this->db->bind('address', $data['address']);
        $this->db->bind('complaint', $data['complaint']);
        if ($data['description'] == "") {
            $this->db->bind('description', "-");
        } else {
            $this->db->bind('description', $data['description']);
        }
        $this->db->bind('action', 1);
        $this->db->bind('id_registration', $data['id_registration']);
        $this->db->bind('tgl_create_recipe', null);
        $this->db->bind('is_pay', null);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateRegistration($data)
    {
        $query = "UPDATE registration_patient SET action=:action, tgl_create_recipe=:tgl, is_pay=:is_pay WHERE id_reg=:id_reg";
        $this->db->query($query);
        $this->db->bind('id_reg', $data['id_reg']);
        $this->db->bind('action', 2);
        $this->db->bind('tgl', $data['tgl_create_recipe']);
        $this->db->bind('is_pay', null);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateRegistrationTotalPrice($data)
    {
        $query = "UPDATE registration_patient SET total_price=:total_price WHERE id_reg=:id_reg";
        $this->db->query($query);
        $this->db->bind('id_reg', $data['id_registration']);
        $this->db->bind('total_price', $data['totalPrice']);
        $this->db->execute();

        return $this->db->rowCount();
    }
    
    public function updatePayment($data)
    {
        $query = "UPDATE registration_patient SET is_pay=:is_pay WHERE id_reg=:id_reg";
        $this->db->query($query);
        $this->db->bind('id_reg', $data['id']);
        $this->db->bind('is_pay', 1);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
