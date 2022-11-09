<?php

namespace DAO;

use DAO\IPetTypeDAO as IPetTypeDAO;
use Exception;
use Models\PetType as PetType;

class PetTypeDAO implements IPetTypeDAO
{
    private $connection;
    private $tableName = "PetTypes"; 

    public function Add(PetType $PetType)
    {
        try {

            $query = "INSERT INTO " . $this->tableName . " (id, type) VALUES (:id, :type);";
            $parameters["id"] = 0;
            $parameters["type"] = $PetType->getType();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $petTypeList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $petType = new PetType();
                $petType->setId($row["id"]);
                $petType->setType($row["type"]);

                array_push($petTypeList, $petType);
            }

            return $petTypeList;
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
                $petType = new PetType();
                $petType->setId($row["id"]);
                $petType->setType($row["type"]);

                return $petType;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return null;
    }

}
