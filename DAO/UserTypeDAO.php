<?php

namespace DAO;

use DAO\IUserTypeDAO as IUserTypeDAO;
use Exception;
use Models\UserType as UserType;

class UserTypeDAO implements IUserTypeDAO
{
    private $connection;
    private $tableName = "userTypes"; 

    public function Add(UserType $userType)
    {
        try {

            $query = "INSERT INTO " . $this->tableName . " (id, type) VALUES (:id, :type);";
            $parameters["id"] = 0;
            $parameters["type"] = $userType->getType();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $userTypeList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $userType = new UserType();
                $userType->setId($row["id"]);
                $userType->setType($row["type"]);

                array_push($userTypeList, $userType);
            }

            return $userTypeList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Search($id)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id = " . $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $userType = new UserType();
                $userType->setId($row["id"]);
                $userType->setType($row["type"]);

                return $userType;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return null;
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->userTypeList as $userType) {
            $valuesArray["id"] = $userType->getId();
            $valuesArray["type"] = $userType->getType();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents('Data/userTypes.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->userTypeList = array();

        if (file_exists('Data/userTypes.json')) {
            $jsonContent = file_get_contents('Data/userTypes.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valuesArray) {
                $userType = new UserType();
                $userType->setId($valuesArray["id"]);
                $userType->setType($valuesArray["type"]);

                array_push($this->userTypeList, $userType);
            }
        }
    }
}
