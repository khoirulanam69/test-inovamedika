<?php

class MedicineModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMedicine()
    {
        $query = "SELECT * FROM medicines";
        $this->db->query($query);
        return $this->db->results();
    }

    public function getMedicineById($id)
    {
        $query = "SELECT * FROM medicines WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->result();
    }

    public function addMedicine($data)
    {
        $query = "INSERT INTO medicines VALUES('', :name, :description, :price)";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('price', $data['price']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateMedicine($data)
    {
        $query = "UPDATE medicines SET name=:name, description=:description, price=:price WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('name', $data['name']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('price', $data['price']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteMedicine($id)
    {
        $query = "DELETE FROM medicines WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
