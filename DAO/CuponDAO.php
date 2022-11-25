<?php

namespace DAO;

use DAO\ICuponDAO as ICuponDAO;
use Models\Cupon as Cupon;
use Exception;

class CuponDAO implements ICuponDAO
{
    private $connection;
    private $tableName = "cupons";

    public function __construct()
    {
    }

    public function Add(Cupon $cupon)
    {
        try {

            $query = "INSERT INTO " . $this->tableName . " (id, nroCupon, date, price, credit_card, ownerEmail) VALUES (:id, :nroCupon, :date, :price, :credit_card, :ownerEmail);";
            $parameters["id"] = 0;
            $parameters["nroCupon"] = $cupon->getNroCupon();
            $parameters["date"] = $cupon->getDate();
            $parameters["price"] = $cupon->getPrice();
            $parameters["credit_card"] = $cupon->getCredit_card();
            $parameters["ownerEmail"] = $cupon->getOwnerEmail();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Update(Cupon $cupon)
    {
        try {

            $query = "UPDATE " . $this->tableName . " SET price = :price, ownerEmail = :ownerEmail WHERE id = :id";
            $parameters["id"] = $cupon->getId();
            $parameters["price"] = $cupon->getPrice();
            $parameters["ownerEmail"] = $cupon->getOwnerEmail();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            return true;
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
                $cupon = new Cupon();
                $cupon->setId($row["id"]);
                $cupon->setNroCupon($row["nroCupon"]);
                $cupon->setDate($row["date"]);
                $cupon->setPrice($row["price"]);
                $cupon->setCredit_card($row["credit_card"]);
                $cupon->setOwnerEmail($row["ownerEmail"]);

                return $cupon;
            }

            return null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function SearchByNroCupon($nroCupon)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE nroCupon = :nroCupon";
            $parameters["nroCupon"] = $nroCupon;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $cupon = new Cupon();
                $cupon->setId($row["id"]);
                $cupon->setNroCupon($row["nroCupon"]);
                $cupon->setDate($row["date"]);
                $cupon->setPrice($row["price"]);
                $cupon->setCredit_card($row["credit_card"]);
                $cupon->setOwnerEmail($row["ownerEmail"]);

                return $cupon;
            }

            return null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function ListByKeeper($keeperId)
    {
        try {
            $cuponList = array();

            $query = "SELECT c.id, c.nroCupon, c.date, c.price, c.credit_card, c.ownerEmail
                FROM cupons c
                INNER JOIN cupondetails cd ON cd.cuponId = c.id
                INNER JOIN reserves r ON r.id = cd.reserveId
                WHERE r.keeperId = :keeperId
                GROUP BY c.id, c.nroCupon, c.date, c.price, c.credit_card, c.ownerEmail";
            $parameters["keeperId"] = $keeperId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $cupon = new Cupon();
                $cupon->setId($row["id"]);
                $cupon->setNroCupon($row["nroCupon"]);
                $cupon->setDate($row["date"]);
                $cupon->setPrice($row["price"]);
                $cupon->setCredit_card($row["credit_card"]);
                $cupon->setOwnerEmail($row["ownerEmail"]);

                array_push($cuponList, $cupon);
            }

            return $cuponList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function Delete($id)
    {
        try {
            $queryDetail = "DELETE FROM cupondetails WHERE cuponId = :id";
            $query = "DELETE FROM " . $this->tableName . " WHERE id = :id";
            $parameters["id"] = $id;

            $this->connection = Connection::GetInstance();

            $this->connection->Execute($queryDetail, $parameters);
            $this->connection->Execute($query, $parameters);

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
