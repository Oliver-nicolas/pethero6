<?php

namespace Controllers;

use DAO\KeeperDAO as KeeperDAO;

class KeeperController
{
    private $keeperDAO;
    private $userLogged;

    public function __construct()
    {
        AuthController::validateLogged();
        AuthController::validateRole('Keeper');

        $this->keeperDAO = new KeeperDAO();
        $this->userLogged = $_SESSION['user'];
    }

    public function ShowPerfil()
    {
        $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
        require_once(VIEWS_PATH . "keeper/mainKeeper.php");
    }

    public function Update($name, $lastname, $address, $price)
    {
        try {

            $sizePet = array();
            if(isset($_POST['small'])){
                array_push($sizePet, 'small');
            }
            if(isset($_POST['medium'])){
                array_push($sizePet, 'medium');
            }
            if(isset($_POST['big'])){
                array_push($sizePet, 'big');
            }

            $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
            $keeper->setName($name);
            $keeper->setLastname($lastname);
            $keeper->setAddress($address);
            $keeper->setPrice($price);
           
            $keeper->setSizePet($sizePet);

            if ($this->keeperDAO->Update($keeper)) {
                $_SESSION['success'] = 'Keeper updated';
            } else {
                $_SESSION['error'] = 'Keeper could not be updated';
            }
            
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowPerfil();
    }
}
