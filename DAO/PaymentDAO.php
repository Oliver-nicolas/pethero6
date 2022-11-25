<?php

namespace DAO;

use DAO\IPaymentDAO as IPaymentDAO;
use DAO\CuponDetailDAO as CuponDetailDAO;
use DAO\CuponDAO as CuponDAO;
use DAO\ReserveDAO as ReserveDAO;
use Exception;
use Models\Payment as Payment;

class PaymentDAO implements IPaymentDAO
{
    private $connection;
    private $tableName = "Payments"; 

    private $cuponDAO;
    private $cuponDetailDAO;
    private $reserveDAO;

    public function __construct()
    {
        $this->cuponDAO = new CuponDAO();
        $this->cuponDetailDAO = new CuponDetailDAO();
        $this->reserveDAO = new ReserveDAO();
    }

    public function Add(Payment $Payment)
    {
        try {

            $query = "INSERT INTO " . $this->tableName . " (id, cuponId, amount) VALUES (:id, :cuponId, :amount);";
            $parameters["id"] = 0;
            $parameters["cuponId"] = $Payment->getCupon()->getId();
            $parameters["amount"] = $Payment->getAmount();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            $details = $this->cuponDetailDAO->ListByCupon($Payment->getCupon()->getId());
            foreach ($details as $item) {
                $this->reserveDAO->Pay($item->getReserve()->getId());
            }

            return true;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function SearchByCoupon($couponId)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE cuponId = :cuponId";
            $parameters["cuponId"] = $couponId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $payment = new Payment();
                $payment->setId($row["id"]);
                $payment->setCupon($this->cuponDAO->Search($row["cuponId"]));
                $payment->setAmount($row["amount"]);

                return $payment;
            }

            return null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
