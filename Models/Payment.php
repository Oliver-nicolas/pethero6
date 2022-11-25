<?php

namespace Models;

class Payment
{
    private $id;
    private $reserve;
    private $amount;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of reserve
     */
    public function getReserve()
    {
        return $this->reserve;
    }

    /**
     * Set the value of reserve
     *
     * @return  self
     */
    public function setReserve($reserve)
    {
        $this->reserve = $reserve;

        return $this;
    }

    /**
     * Get the value of amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }
}
