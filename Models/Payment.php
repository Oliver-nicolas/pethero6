<?php

namespace Models;

class Payment
{
    private $id;
    private $cupon;
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

    /**
     * Get the value of cupon
     */ 
    public function getCupon()
    {
        return $this->cupon;
    }

    /**
     * Set the value of cupon
     *
     * @return  self
     */ 
    public function setCupon($cupon)
    {
        $this->cupon = $cupon;

        return $this;
    }
}
