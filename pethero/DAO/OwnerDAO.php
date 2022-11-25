<?php

namespace DAO;

use DAO\IOwnerDAO as IOwnerDAO;
use Models\Owner as Owner;

use DAO\UserDAO as UserDAO;

use Exception;

class OwnerDAO implements IOwnerDAO
{
    private $connection;
    private $tableName = "owners";

    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function Add(Owner $owner)
    {
        try {

            $query = "INSERT INTO " . $this->tableName . " (id, name, lastname, address, email, userId) VALUES (:id, :name, :lastname, :address, :email, :userId);";
            $parameters["id"] = 0;
            $parameters["name"] = $owner->getName();
            $parameters["lastname"] = $owner->getLastname();
            $parameters["address"] = $owner->getAddress();
            $parameters["email"] = $owner->getEmail();
            $parameters["userId"] = $owner->getUser()->getId();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
        return false;
    }

    public function Search($id)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
            $parameters["id"] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $owner = new Owner();
                $owner->setId($row["id"]);
                $owner->setName($row["name"]);
                $owner->setLastname($row["lastname"]);
                $owner->setAddress($row["address"]);
                $owner->setEmail($row["email"]);
                $owner->setUser($this->userDAO->Search($row["userId"]));

                return $owner;
            }

            return null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function SearchByUserId($userId)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE userId = :userId";
            $parameters["userId"] = $userId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $owner = new Owner();
                $owner->setId($row["id"]);
                $owner->setName($row["name"]);
                $owner->setLastname($row["lastname"]);
                $owner->setAddress($row["address"]);
                $owner->setEmail($row["email"]);
                $owner->setUser($this->userDAO->Search($row["userId"]));

                return $owner;
            }

            return null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $ownerList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $owner = new Owner();
                $owner->setId($row["id"]);
                $owner->setName($row["name"]);
                $owner->setLastname($row["lastname"]);
                $owner->setAddress($row["address"]);
                $owner->setEmail($row["email"]);
                $owner->setUser($this->userDAO->Search($row["userId"]));

                array_push($ownerList, $owner);
            }

            return $ownerList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function ListByReserveWithKeeper($keeperId)
    {
        try {
            $ownerList = array();

            $query = "SELECT o.* FROM " . $this->tableName . " ";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $owner = new Owner();
                $owner->setId($row["id"]);
                $owner->setName($row["name"]);
                $owner->setLastname($row["lastname"]);
                $owner->setAddress($row["address"]);
                $owner->setEmail($row["email"]);
                $owner->setUser($this->userDAO->Search($row["userId"]));

                array_push($ownerList, $owner);
            }

            return $ownerList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
