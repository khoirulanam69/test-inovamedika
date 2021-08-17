<?php

class UserModel
{
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllUser()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->results();
    }

    public function getUser($email)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email=:email');
        $this->db->bind('email', $email);
        return $this->db->result();
    }

    public function addUser($data)
    {
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $query = "INSERT INTO " . $this->table . " VALUES ('', :name, :email, :password, :role)";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $password);
        $this->db->bind('role', 3);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->result();
    }

    public function updateUser($data)
    {
        $userFromDB = $this->getUserById($data['id']);
        $query = "UPDATE " . $this->table . " SET name=:name, email=:email, password=:password, role=:role WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        if ($data['password'] == "" && $data['password2'] == "") {
            $this->db->bind('password', $userFromDB['password']);
        } else {
            if (password_verify($data['password'], $userFromDB['password'])) {
                if ($data['password2'] == "") {
                    Flasher::setFlash('danger', 'New password must be filled');
                    header('Location: ' . BASE_URL . '/admin/alluser');
                } else {
                    $password = password_hash($data['password2'], PASSWORD_BCRYPT);
                    $this->db->bind('password', $password);
                }
            } else {
                Flasher::setFlash('danger', 'Old password does not match');
                header('Location: ' . BASE_URL . '/admin/alluser');
            }
        }
        $this->db->bind('role', $data['role']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteUser($id)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id=:id';
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
