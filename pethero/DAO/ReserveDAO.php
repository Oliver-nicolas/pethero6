<?php

namespace DAO;

use DAO\IReserveDAO as IReserveDAO;
use DAO\KeeperDAO as KeeperDAO;
use DAO\PetDAO as PetDAO;
use DAO\OwnerDAO as OwnerDAO;
use Models\Mailer as Mailer;
use Models\Reserve as Reserve;

use Exception;

class ReserveDAO implements IReserveDAO
{
    private $connection;
    private $tableName = "reserves";

    private $keeperDAO;
    private $petDAO;
    private $ownerDAO;

    public function __construct()
    {
        $this->keeperDAO = new keeperDAO();
        $this->petDAO = new PetDAO();
        $this->ownerDAO = new OwnerDAO();
    }

    public function Add(Reserve $reserve)
    {
        try {

            $query = "INSERT INTO " . $this->tableName . " (id, keeperId, petId, startDate, endDate, state) VALUES (:id, :keeperId, :petId, :startDate, :endDate, :state);";
            $parameters["id"] = 0;
            $parameters["keeperId"] = $reserve->getKeeper()->getId();
            $parameters["petId"] = $reserve->getPet()->getId();
            $parameters["startDate"] = $reserve->getStartDate();
            $parameters["endDate"] = $reserve->getEndDate();
            $parameters["state"] = $reserve->getState();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
        return false;
    }

    public function Accept(Reserve $reserve)
    {
        try {

            $query = "UPDATE " . $this->tableName . " SET state=:state, cupon_generated=:cupon_generated WHERE id = :id;";
            $parameters["id"] = $reserve->getId();
            $parameters["state"] = 'Accepted';
            $parameters["cupon_generated"] = 'K' . $reserve->getKeeper()->getId() . 'P' . $reserve->getPet()->getId() . 'R' . $reserve->getId();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
        return false;
    }

    public function Decline(Reserve $reserve)
    {
        try {

            $query = "UPDATE " . $this->tableName . " SET state=:state WHERE id = :id;";
            $parameters["id"] = $reserve->getId();
            $parameters["state"] = 'Declined';

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
                $reserve = new Reserve();
                $reserve->setId($row["id"]);
                $reserve->setKeeper($this->keeperDAO->Search($row["keeperId"]));
                $reserve->setPet($this->petDAO->Search($row["petId"]));
                $reserve->setStartDate($row["startDate"]);
                $reserve->setEndDate($row["endDate"]);
                $reserve->setState($row["state"]);
                $reserve->setCupon_generated($row["cupon_generated"]);

                return $reserve;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return null;
    }

    public function GetAllByKeeper($keeperId)
    {
        try {
            $reserveList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE keeperId = :keeperId ORDER BY state DESC, startDate DESC";
            $parameters["keeperId"] = $keeperId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $reserve = new Reserve();
                $reserve->setId($row["id"]);
                $reserve->setKeeper($this->keeperDAO->Search($row["keeperId"]));
                $reserve->setPet($this->petDAO->Search($row["petId"]));
                $reserve->setStartDate($row["startDate"]);
                $reserve->setEndDate($row["endDate"]);
                $reserve->setState($row["state"]);
                $reserve->setCupon_generated($row["cupon_generated"]);

                array_push($reserveList, $reserve);
            }

            return $reserveList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAllByOwner($ownerId)
    {
        try {
            $reserveList = array();

            $query = "SELECT s.* FROM " . $this->tableName . " s INNER JOIN pets p ON p.id = s.petId WHERE p.ownerId = :ownerId";
            $parameters["ownerId"] = $ownerId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $reserve = new Reserve();
                $reserve->setId($row["id"]);
                $reserve->setKeeper($this->keeperDAO->Search($row["keeperId"]));
                $reserve->setPet($this->petDAO->Search($row["petId"]));
                $reserve->setStartDate($row["startDate"]);
                $reserve->setEndDate($row["endDate"]);
                $reserve->setState($row["state"]);
                $reserve->setCupon_generated($row["cupon_generated"]);

                array_push($reserveList, $reserve);
            }

            return $reserveList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAllByRangeDate($startDate, $endDate)
    {
        try {
            $reserveList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE state <> 'Waiting' AND (( :startDate >= startDate AND :endDate <= endDate) OR startDate BETWEEN :startDate AND :endDate OR endDate BETWEEN :startDate AND :endDate )";
            $parameters["startDate"] = $startDate;
            $parameters["endDate"] = $endDate;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $reserve = new Reserve();
                $reserve->setId($row["id"]);
                $reserve->setKeeper($this->keeperDAO->Search($row["keeperId"]));
                $reserve->setPet($this->petDAO->Search($row["petId"]));
                $reserve->setStartDate($row["startDate"]);
                $reserve->setEndDate($row["endDate"]);
                $reserve->setState($row["state"]);
                $reserve->setCupon_generated($row["cupon_generated"]);

                array_push($reserveList, $reserve);
            }

            return $reserveList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function generateEmail($reserve){

        $ownerList =  $this->ownerDAO->GetAll();

        foreach($ownerList as $aux){

            if($aux->getId() == $reserve->getPet()->getOwner()->getId()){
                
                $mail = new Mailer();
                $mail->sendMail($reserve); 
            }
        }
    }
}
