<?php

namespace Models;

class CuponDetail
{
    private $id;
    private $reserve;
    private $cupon;

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