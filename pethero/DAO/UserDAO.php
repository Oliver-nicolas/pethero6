<?php

namespace DAO;

use DAO\IUserDAO as IUserDAO;
use Models\User as User;

use DAO\UserTypeDAO as UserTypeDAO;
use Exception;

class UserDAO implements IUserDAO
{
    private $connection;
    private $tableName = "users";

    private $userTypeDAO;

    public function __construct()
    {
        $this->userTypeDAO = new UserTypeDAO();
    }

    public function Add(User $user)
    {
        try {

            $query = "INSERT INTO " . $this->tableName . " (id, username, password, userTypeId) VALUES (:id, :username, :password, :userTypeId);";
            $parameters["id"] = 0;
            $parameters["username"] = $user->getUsername();
            $parameters["password"] = $user->getPassword();
            $parameters["userTypeId"] = $user->getUsertype()->getId();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
        return false;
    }

    public function GetAll()
    {
        try {
            $userList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $user = new User();
                $user->setId($row["id"]);
                $user->setUsername($row["username"]);
                $user->setPassword($row["password"]);
                $user->setUsertype($this->userTypeDAO->Search($row["userTypeId"]));

                array_push($userList, $user);
            }

            return $userList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetByUsername($username)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE username = :username";
            $parameters["username"] = $username;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $user = new User();
                $user->setId($row["id"]);
                $user->setUsername($row["username"]);
                $user->setPassword($row["password"]);
                $user->setUsertype($this->userTypeDAO->Search($row["userTypeId"]));

                return $user;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return null;
    }

    public function GetByType($type)
    {
        try {
            $userList = array();

            $query = "SELECT u.* FROM " . $this->tableName . " u INNER JOIN userTypes ut ON ut.id = u.userTypeId.id WHERE ut.type = :type";
            $parameters["type"] = $type;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $user = new User();
                $user->setId($row["id"]);
                $user->setUsername($row["username"]);
                $user->setPassword($row["password"]);
                $user->setUsertype($this->userTypeDAO->Search($row["userTypeId"]));

                array_push($userList, $user);
            }

            return $userList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Search($id)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
            $parameters["id"] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $user = new User();
                $user->setId($row["id"]);
                $user->setUsername($row["username"]);
                $user->setPassword($row["password"]);
                $user->setUsertype($this->userTypeDAO->Search($row["userTypeId"]));

                return $user;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return null;
    }

    public function Login($username, $password)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE username = :username AND password = :password";
            $parameters["username"] = $username;
            $parameters["password"] = $password;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $user = new User();
                $user->setId($row["id"]);
                $user->setUsername($row["username"]);
                $user->setPassword($row["password"]);
                $user->setUsertype($this->userTypeDAO->Search($row["userTypeId"]));

                return $user;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return null;
    }
}
