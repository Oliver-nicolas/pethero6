<?php

namespace Controllers;

use DAO\OwnerDAO as OwnerDAO;
use DAO\PetDAO as PetDAO;
use DAO\KeeperDAO as KeeperDAO;
use Models\Pet as Pet;

class OwnerController
{
    private $ownerDAO;
    private $petDAO;
    private $keeperDAO;
    private $userLogged;

    public function __construct()
    {
        AuthController::validateLogged();
        AuthController::validateRole('Dueño');

        $this->ownerDAO = new OwnerDAO();
        $this->petDAO = new PetDAO();
        $this->keeperDAO = new KeeperDAO();
        $this->userLogged = $_SESSION['user'];
    }

    public function ShowPerfil()
    {
        $owner = $this->ownerDAO->SearchByUserId($this->userLogged->getId());
        $ownerList = $this->ownerDAO->GetAll();
        require_once(VIEWS_PATH . "owner/mainOwner.php");
    }

    public function ShowModifyPerfil()
    {
        $owner = $this->ownerDAO->SearchByUserId($this->userLogged->getId());
        require_once(VIEWS_PATH . "auth/register.php");
    }

    public function ShowMyPets()
    {
        $owner = $this->ownerDAO->SearchByUserId($this->userLogged->getId());
        $pet = $this->petDAO->GetAll();
        require_once(VIEWS_PATH . "owner/my-pets.php");
    }

    public function ShowNewPet()
    {
        $owner = $this->ownerDAO->SearchByUserId($this->userLogged->getId());
        $pet = $this->petDAO->GetAllByOwner($owner->getId());
        require_once(VIEWS_PATH . "owner/new-pet.php");
    }

    public function AddPet($animal, $race, $size, $observations, $image, $vaccination_plan, $video)
    {
        try {

            $animal = array();
            if(isset($_POST['Perro'])){
                array_push($animal, 'Perro');
            }
            if(isset($_POST['Gato'])){
                array_push($animal, 'Gato');
            }
           
            $owner = $this->ownerDAO->SearchByUserId($this->userLogged->getId());
            $pet = new Pet();
            
            $pet->setRace($race);
            $pet->setSize($size);
            $pet->setObservations($observations);
            $pet->setOwner($owner);
            
            $pet->setAnimal($animal);

            if($pet->getAnimal()=='Gato'){
                $pet->setSize('Pequeño');
            }

            $imageName = date('Ymdhisu') . $image["name"];
            $tempImageName = $image["tmp_name"];

            $filePath = UPLOADS_PATH . basename($imageName);
            $imageSize = getimagesize($tempImageName);

            if ($imageSize !== false) {
                if (move_uploaded_file($tempImageName, $filePath)) {
                    $pet->setImage($imageName);
                } else {
                    $_SESSION['error'] = "Ocurrió un error al intentar subir la imagen";
                    $this->ShowNewPet();
                    return;
                }
            } else {
                $_SESSION['error'] = "El archivo no corresponde a una imágen";
            }

            $imageName = date('Ymdhisu') . $vaccination_plan["name"];
            $tempImageName = $vaccination_plan["tmp_name"];

            $filePath = UPLOADS_PATH . basename($imageName);
            $imageSize = getimagesize($tempImageName);

            if ($imageSize !== false) {
                if (move_uploaded_file($tempImageName, $filePath)) {
                    $pet->setVaccination_plan($imageName);
                } else {
                    $_SESSION['error'] = "Ocurrió un error al intentar subir la imagen";
                    $this->ShowNewPet();
                    return;
                }
            } else {
                $_SESSION['error'] = "El plan vacunatorio no corresponde a una imágen";
            }

            $imageName = date('Ymdhisu') . $video["name"];
            $tempImageName = $video["tmp_name"];

            $filePath = UPLOADS_PATH . basename($imageName);

            if (move_uploaded_file($tempImageName, $filePath)) {
                $pet->setVideo($imageName);
            } else {
                $pet->setVideo(null);
            }

            if ($this->petDAO->Add($pet)) {
                $_SESSION['success'] = 'Mascota registrada';
            } else {
                $_SESSION['error'] = 'La mascota no se puedo registrar';
            }
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowMyPets();
    }

    public function ShowListKeepers()
    {
        $keepers = $this->keeperDAO->GetAll();
        require_once(VIEWS_PATH . "owner/list-keepers.php");
    }
}
