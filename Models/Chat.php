<?php

namespace Models;

class Chat
{
    private $id;
    private $createDate;
    private $owner;
    private $keeper;

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
     * Get the value of createDate
     */ 
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set the value of createDate
     *
     * @return  self
     */ 
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

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
}