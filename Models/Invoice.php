<?php
namespace Models;

class Invoice{

    private $id;
    private $keeper;
    private $owner;
    private $pet;
    private $reserve;

    

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
     * Get the value of owner
     */ 
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set the value of owner
     *
     * @return  self
     */ 
    public function setOwner($owner)
    {
        $this->owner = $owner;

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
}


?>