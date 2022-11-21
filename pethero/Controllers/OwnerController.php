<?php

namespace Controllers;

use DAO\OwnerDAO as OwnerDAO;
use DAO\PetDAO as PetDAO;
use DAO\KeeperDAO as KeeperDAO;
use DAO\PetTypeDAO as PetTypeDAO;
use DAO\ReserveDAO as ReserveDAO;
use Models\Pet as Pet;
use Models\Reserve as Reserve;

class OwnerController
{
    private $ownerDAO;
    private $petDAO;
    private $petTypeDAO;
    private $keeperDAO;
    private $reserveDAO;
    private $userLogged;

    public function __construct()
    {
        AuthController::validateLogged();
        AuthController::validateRole('Owner');

        $this->ownerDAO = new OwnerDAO();
        $this->petDAO = new PetDAO();
        $this->petTypeDAO = new PetTypeDAO();
        $this->keeperDAO = new KeeperDAO();
        $this->reserveDAO = new ReserveDAO();
        $this->userLogged = $_SESSION['user'];
    }

    public function ShowPerfil()
    {
        $owner = $this->ownerDAO->SearchByUserId($this->userLogged->getId());
        require_once(VIEWS_PATH . "owner/perfil-owner.php");
    }

    public function ShowMyPets()
    {
        $owner = $this->ownerDAO->SearchByUserId($this->userLogged->getId());
        $pets = $this->petDAO->GetAllByOwner($owner->getId());
        require_once(VIEWS_PATH . "owner/my-pets.php");
    }

    public function ShowNewPet()
    {
        $petTypes = $this->petTypeDAO->GetAll();
        require_once(VIEWS_PATH . "owner/new-pet.php");
    }

    public function AddPet($name, $breed, $size, $observations, $petTypeId, $image, $vaccination_plan, $video)
    {
        try {

            $owner = $this->ownerDAO->SearchByUserId($this->userLogged->getId());
            $pet = new Pet();
            $pet->setName($name);
            $pet->setBreed($breed);
            $pet->setSize($size);
            $pet->setObservations($observations);
            $pet->setPetType($this->petTypeDAO->Search($petTypeId));
            $pet->setOwner($owner);

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
                $_SESSION['error'] = "El archivo Vaccination plan no corresponde a una imágen";
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
                $_SESSION['success'] = 'Pet registered';
            } else {
                $_SESSION['error'] = 'Pet could not be registered';
            }
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowNewPet();
    }

    public function ShowListKeepers($startDate = null, $endDate = null)
    {
        $keepers = [];

        if ($startDate == null && $endDate == null) {
            $keepers = $this->keeperDAO->GetAll();
        } else {
            $keepers = $this->keeperDAO->GetAllByDate($startDate, $endDate);
        }

        require_once(VIEWS_PATH . "owner/list-keepers.php");
    }

    public function ShowNewReserve($keeperId)
    {
        $owner = $this->ownerDAO->SearchByUserId($this->userLogged->getId());
        $pets = $this->petDAO->GetAllByOwner($owner->getId());
        require_once(VIEWS_PATH . "owner/new-reserve.php");
    }

    public function AddLike($keeperId){
        $keeper = $this->keeperDAO->SearchByUserId($keeperId);
        $keeper->setScore(+1);
       
    }

    public function AddReserve($keeperId, $petId, $startDate, $endDate)
    {
        try {
            $reserve = new Reserve();
            $reserve->setKeeper($this->keeperDAO->Search($keeperId));
            $reserve->setPet($this->petDAO->Search($petId));
            $reserve->setStartDate($startDate);
            $reserve->setEndDate($endDate);
            $reserve->setState('Waiting');

            if ($reserve->getStartDate() > $reserve->getEndDate()) {
                $_SESSION['error'] = 'Date range is invalid';
                $this->ShowNewReserve($keeperId);
                return;
            }

            if ($reserve->getStartDate() >= $reserve->getKeeper()->getStartDate() && $reserve->getEndDate() <= $reserve->getKeeper()->getEndDate()) {
                if ($this->reserveDAO->Add($reserve)) {
                    $_SESSION['success'] = 'Reserve registered';
                } else {
                    $_SESSION['error'] = 'Reserve could not be registered';
                }
            } else {
                $_SESSION['error'] = 'The Keeper cannot be reserved for selected dates';
            }
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowNewReserve($keeperId);
    }

    public function AddPayment($reserve, $amount){

            $payment = new Payment();
            $payment->setReserve($this->reserveDAO-Search($reserveId));
            $payment->setAmount($this->KeeperDAO-Search($keeperId));
    }
}
