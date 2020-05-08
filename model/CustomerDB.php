<?php

namespace model;

class CustomerDB
{
    public $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function create($customer)
    {
        $sql = "INSERT INTO customers (name, email, address) VALUES (?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $customer->name);
        $stmt->bindParam(2, $customer->email);
        $stmt->bindParam(3, $customer->address);
        return $stmt->execute();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM customers";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $customers = [];
        foreach ($result as $row) {
            $customer = new Customer($row['name'], $row['email'], $row['address']);
            $customer->id = $row['id'];
            $customers[] = $customer;
        }
        return $customers;
    }

    public function get($id){
        $sql = "SELECT * FROM customers WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $row = $stmt->fetch();
        $customer = new Customer($row['name'], $row['email'], $row['address']);
        $customer->id = $row['id'];
        return $customer;
    }

    public function delete($id){
        $sql = "DELETE FROM customers WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id);
        return $statement->execute();
    }

    public function update($id, $customer){
        $sql = "UPDATE customers SET name = ?, email = ?, address = ? WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $customer->name);
        $statement->bindParam(2, $customer->email);
        $statement->bindParam(3, $customer->address);
        $statement->bindParam(4, $id);
        return $statement->execute();
    }
}