<?php

namespace Models;

class Keeper
{
    private $id;
    private $name;
    private $lastname;
    private $address;
    private $sizePet = array();
    private $price;
    private $startDate;
    private $endDate;
    private $days;
    private $user;

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
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of sizePet
     */
    public function getSizePet()
    {
        return $this->sizePet;
    }

    /**
     * Set the value of sizePet
     *
     * @return  self
     */
    public function setSizePet($sizePet)
    {
        $this->sizePet = $sizePet;

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
     * Get the value of days
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * Set the value of days
     *
     * @return  self
     */
    public function setDays($days)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function checkSizePet($size){
        return in_array($size, $this->sizePet);
    }

    public function descriptionSizePet(){
        $description = '';
        if($this->checkSizePet('small')){
            $description = $description . '[ small ] '; 
        }

        if($this->checkSizePet('medium')){
            $description = $description . '[ medium ] '; 
        }

        if($this->checkSizePet('big')){
            $description = $description . '[ big ] '; 
        }
        return $description;
    }

    public function __toString()
    {
        return $this->name . ' ' . $this->lastname;
    }
}
