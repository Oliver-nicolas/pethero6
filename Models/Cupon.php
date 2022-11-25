<?php

namespace Models;

class Cupon
{
    private $id;
    private $nroCupon;
    private $date;
    private $price;
    private $credit_card;
    private $ownerEmail;
    

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
     * Get the value of nroCupon
     */ 
    public function getNroCupon()
    {
        return $this->nroCupon;
    }

    /**
     * Set the value of nroCupon
     *
     * @return  self
     */ 
    public function setNroCupon($nroCupon)
    {
        $this->nroCupon = $nroCupon;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of credit_card
     */ 
    public function getCredit_card()
    {
        return $this->credit_card;
    }

    /**
     * Set the value of credit_card
     *
     * @return  self
     */ 
    public function setCredit_card($credit_card)
    {
        $this->credit_card = $credit_card;

        return $this;
    }

    /**
     * Get the value of ownerEmail
     */ 
    public function getOwnerEmail()
    {
        return $this->ownerEmail;
    }

    /**
     * Set the value of ownerEmail
     *
     * @return  self
     */ 
    public function setOwnerEmail($ownerEmail)
    {
        $this->ownerEmail = $ownerEmail;

        return $this;
    }    

    public function __toString()
    {
        return $this->nroCupon;
    }
}