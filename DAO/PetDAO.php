<?php

namespace DAO;

use DAO\IPetDAO as IPetDAO;
use Models\Pet as Pet;

use DAO\OwnerDAO as OwnerDAO;
use DAO\PetTypeDAO as PetTypeDAO;

use Exception;

class PetDAO implements IPetDAO
{
    private $connection;
    private $tableName = "pets";

    private $ownerDAO;
    private $petTypeDAO;

    public function __construct()
    {
        $this->ownerDAO = new OwnerDAO();
        $this->petTypeDAO = new PetTypeDAO();
    }

    public function Add(Pet $pet)
    {
        try {

            $query = "INSERT INTO " . $this->tableName . " (id, breed, size, observations, image, vaccinationPlan, video, ownerId, petTypeId) VALUES (:id, :breed, :size, :observations, :image, :vaccinationPlan, :video, :ownerId, :petTypeId);";
            $parameters["id"] = 0;
            $parameters["breed"] = $pet->getBreed();
            $parameters["size"] = $pet->getSize();
            $parameters["observations"] = $pet->getObservations();
            $parameters["image"] = $pet->getImage();
            $parameters["vaccinationPlan"] = $pet->getVaccination_plan();
            $parameters["video"] = $pet->getVideo();
            $parameters["ownerId"] = $pet->getOwner()->getId();
            $parameters["petTypeId"] = $pet->getPetType()->getId();

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
                $pet = new Pet();
                $pet->setId($row["id"]);
                $pet->setBreed($row["breed"]);
                $pet->setSize($row["size"]);
                $pet->setObservations($row["observations"]);
                $pet->setImage($row["image"]);
                $pet->setVaccination_plan($row["vaccinationPlan"]);
                $pet->setVideo($row["video"]);
                $pet->setOwner($this->ownerDAO->Search($row["ownerId"]));
                $pet->setPetType($this->petTypeDAO->Search($row["petTypeId"]));

                return $pet;
            }

            return null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function GetAllByOwner($ownerId)
    {
        try {
            $petList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE ownerId = :ownerId";
            $parameters["ownerId"] = $ownerId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $pet = new Pet();
                $pet->setId($row["id"]);
                $pet->setBreed($row["breed"]);
                $pet->setSize($row["size"]);
                $pet->setObservations($row["observations"]);
                $pet->setImage($row["image"]);
                $pet->setVaccination_plan($row["vaccinationPlan"]);
                $pet->setVideo($row["video"]);
                $pet->setOwner($this->ownerDAO->Search($row["ownerId"]));
                $pet->setPetType($this->petTypeDAO->Search($row["petTypeId"]));

                array_push($petList, $pet);
            }
            return $petList;
        } catch (Exception $ex) {
            throw $ex;
        }
        return null;
    }
}
