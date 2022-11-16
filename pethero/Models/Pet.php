<?php

namespace Models;

class Pet
{
    private $id;
    private $name;
    private $image;
    private $breed;
    private $size;
    private $vaccination_plan;
    private $observations;
    private $video;
    private $owner;
    private $petType;


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
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of race
     */
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * Set the value of race
     *
     * @return  self
     */
    public function setBreed($breed)
    {
        $this->breed = $breed;

        return $this;
    }

    /**
     * Get the value of size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of vaccination_plan
     */
    public function getVaccination_plan()
    {
        return $this->vaccination_plan;
    }

    /**
     * Set the value of vaccination_plan
     *
     * @return  self
     */
    public function setVaccination_plan($vaccination_plan)
    {
        $this->vaccination_plan = $vaccination_plan;

        return $this;
    }

    /**
     * Get the value of observations
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Set the value of observations
     *
     * @return  self
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get the value of video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set the value of video
     *
     * @return  self
     */
    public function setVideo($video)
    {
        $this->video = $video;

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
     * Get the value of petType
     */
    public function getPetType()
    {
        return $this->petType;
    }

    /**
     * Set the value of petType
     *
     * @return  self
     */
    public function setPetType($petType)
    {
        $this->petType = $petType;

        return $this;
    }

    public function __toString()
    {
        return $this->getPetType() . ' - ' . $this->breed . ' [' . $this->size . ']';
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
}
