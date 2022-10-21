<?php

namespace Models;

class Pet
{
    private $id;
    private $foto;
    private $raza;
    private $tamano;
    private $plan_vacunacion;
    private $observaciones_generales;
    private $video;
    private $owner;

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
     * Get the value of foto
     */ 
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     *
     * @return  self
     */ 
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get the value of raza
     */ 
    public function getRaza()
    {
        return $this->raza;
    }

    /**
     * Set the value of raza
     *
     * @return  self
     */ 
    public function setRaza($raza)
    {
        $this->raza = $raza;

        return $this;
    }

    /**
     * Get the value of tamano
     */ 
    public function getTamano()
    {
        return $this->tamano;
    }

    /**
     * Set the value of tamano
     *
     * @return  self
     */ 
    public function setTamano($tamano)
    {
        $this->tamano = $tamano;

        return $this;
    }

    /**
     * Get the value of plan_vacunacion
     */ 
    public function getPlan_vacunacion()
    {
        return $this->plan_vacunacion;
    }

    /**
     * Set the value of plan_vacunacion
     *
     * @return  self
     */ 
    public function setPlan_vacunacion($plan_vacunacion)
    {
        $this->plan_vacunacion = $plan_vacunacion;

        return $this;
    }

    /**
     * Get the value of observaciones_generales
     */ 
    public function getObservaciones_generales()
    {
        return $this->observaciones_generales;
    }

    /**
     * Set the value of observaciones_generales
     *
     * @return  self
     */ 
    public function setObservaciones_generales($observaciones_generales)
    {
        $this->observaciones_generales = $observaciones_generales;

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

    public function __toString()
    {
        return $this->id . ' - ' . $this->raza;
    }
}