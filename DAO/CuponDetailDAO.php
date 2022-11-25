<?php

namespace DAO;

use DAO\ICuponDetailDAO as ICuponDetailDAO;
use Models\CuponDetail as CuponDetail;

use DAO\ReserveDAO as ReserveDAO;
use DAO\CuponDAO as CuponDAO;
use DateTime;
use Exception;

class CuponDetailDAO implements ICuponDetailDAO
{
    private $connection;
    private $tableName = "cupondetails";

    private $reserveDAO;
    private $cuponDAO;

    public function __construct()
    {
        $this->reserveDAO = new ReserveDAO();
        $this->cuponDAO = new CuponDAO();
    }

    public function UpdateCupon($cuponId)
    {
        $cupon = $this->cuponDAO->Search($cuponId);
        $details = $this->ListByCupon($cuponId);

        $total = 0;
        $email = '';
        foreach ($details as $item) {
            $fecha1 = new DateTime($item->getReserve()->getStartDate());
            $fecha2 = new DateTime($item->getReserve()->getEndDate());
            $diff = $fecha1->diff($fecha2);
            $total += ($diff->days + 1) * $item->getReserve()->getKeeper()->getPrice();
            $email = $item->getReserve()->getPet()->getOwner()->getEmail();
        }
        $cupon->setPrice($total/2);
        $cupon->setOwnerEmail($email);
        return $this->cuponDAO->Update($cupon);
    }

    public function Add(CuponDetail $cuponDetail)
    {
        try {

            $query = "INSERT INTO " . $this->tableName . " (id, reserveId, cuponId) VALUES (:id, :reserveId, :cuponId);";
            $parameters["id"] = 0;
            $parameters["reserveId"] = $cuponDetail->getReserve()->getId();
            $parameters["cuponId"] = $cuponDetail->getCupon()->getId();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            return $this->UpdateCupon($cuponDetail->getCupon()->getId());
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
                $cuponDetail = new CuponDetail();
                $cuponDetail->setId($row["id"]);
                $cuponDetail->setReserve($this->reserveDAO->Search($row["reserveId"]));
                $cuponDetail->setCupon($this->cuponDAO->Search($row["cuponId"]));

                return $cuponDetail;
            }

            return null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function SearchByCuponReserve($cuponId, $reserveId)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE cuponId = :cuponId AND reserveId = :reserveId";
            $parameters["cuponId"] = $cuponId;
            $parameters["reserveId"] = $reserveId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $cuponDetail = new CuponDetail();
                $cuponDetail->setId($row["id"]);
                $cuponDetail->setReserve($this->reserveDAO->Search($row["reserveId"]));
                $cuponDetail->setCupon($this->cuponDAO->Search($row["cuponId"]));

                return $cuponDetail;
            }

            return null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function ListByCupon($cuponId)
    {
        try {
            $cuponDetailList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE cuponId = :cuponId";
            $parameters["cuponId"] = $cuponId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $cuponDetail = new CuponDetail();
                $cuponDetail->setId($row["id"]);
                $cuponDetail->setReserve($this->reserveDAO->Search($row["reserveId"]));
                $cuponDetail->setCupon($this->cuponDAO->Search($row["cuponId"]));

                array_push($cuponDetailList, $cuponDetail);
            }

            return $cuponDetailList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function Delete($id)
    {
        try {
            $cuponDetail = $this->Search($id);

            $query = "DELETE FROM " . $this->tableName . " WHERE id = :id";
            $parameters["id"] = $id;

            $this->connection = Connection::GetInstance();
            $this->connection->Execute($query, $parameters);

            return $this->UpdateCupon($cuponDetail->getCupon()->getId());;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
