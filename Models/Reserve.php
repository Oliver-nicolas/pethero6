<?php

namespace Models;

class Reserve
{
    private $id;
    private $keeper;
    private $pet;
    private $startDate;
    private $endDate;
    private $state;
    private $cupon_generated;

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
     * Get the value of keeper
     */
    public function getKeeper()
    {
        return $this->keeper;
    }

    /**
     * Set the value of keeper
     *
     * @return  self
     */
    public function setKeeper($keeper)
    {
        $this->keeper = $keeper;

        return $this;
    }

    /**
     * Get the value of pet
     */
    public function getPet()
    {
        return $this->pet;
    }

    /**
     * Set the value of pet
     *
     * @return  self
     */
    public function setPet($pet)
    {
        $this->pet = $pet;

        return $this;
    }

    /**
     * Get the value of startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set the value of startDate
     *
     * @return  self
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the value of endDate
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set the value of endDate
     *
     * @return  self
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get the value of cupon_generated
     */
    public function getCupon_generated()
    {
        return $this->cupon_generated;
    }

    /**
     * Set the value of cupon_generated
     *
     * @return  self
     */
    public function setCupon_generated($cupon_generated)
    {
        $this->cupon_generated = $cupon_generated;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }
}
