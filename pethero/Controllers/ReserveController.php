<?php

namespace Controllers;

use DAO\ReserveDAO as ReserveDAO;
use DAO\OwnerDAO as OwnerDAO;
use DAO\KeeperDAO as KeeperDAO;

class ReserveController
{
    private $reserveDAO;
    private $userLogged;
    private $keeperDAO;

    public function __construct()
    {
        AuthController::validateLogged();
        AuthController::validateRole('Owner');

        $this->reserveDAO = new ReserveDAO();
        $this->keeperDAO = new KeeperDAO();
        $this->userLogged = $_SESSION['user'];
    }

    public function ShowReserves()
    {
        $reserve = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
        $reserveList = $this->reserveDAO->GetAll();
        require_once(VIEWS_PATH . "reserves/list-reserve.php");
    }

    public function ShowModifyReserve()
    {
        $reserve = $this->reserveDAO->SearchByUserId($this->userLogged->getId());
        require_once(VIEWS_PATH . "reserves/add-reserve.php");
    }

    public function ShowNewReserve()
    {
        $keeperList = $this->keeperDAO->GetAll();
        require_once(VIEWS_PATH . "reserves/add-reserve.php");
    }

    public function Update($keeper, $pet, $startDate, $endDate)
    {
        try {

            $reserve = $this->reserveDAO->SearchByUserId($this->userLogged->getId());
            $reserve->setKeeper($keeper);
            $reserve->setPet($pet);
            $reserve->setStartDate($startDate);
            $reserve->setEndDate($endDate);
           
            if($keeper->getSizePet()== $pet->getSize()){
                if ($this->reserveDAO->Update($reserve)) {
                    $_SESSION['success'] = 'Reserva realizada';
                } else {
                    $_SESSION['error'] = 'No se puedo realizar la reserva';
                }
            }else {
                $_SESSION['error'] = 'No se puedo realizar la reserva';
            }

        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowReserve();
    }
}
