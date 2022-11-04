<?php

namespace Controllers;

use DAO\ReserveDAO as ReserveDAO;

class ReserveController
{
    private $reserveDAO;
    private $userLogged;

    public function __construct()
    {
        AuthController::validateLogged();
        AuthController::validateRole('reserve');

        $this->reserveDAO = new ReserveDAO();
        $this->userLogged = $_SESSION['user'];
    }

    public function ShowReserve()
    {
        $reserve = $this->reserveDAO->SearchByUserId($this->userLogged->getId());
        require_once(VIEWS_PATH . "reserve/list-reserve.php");
    }

    public function ShowModifyReserve()
    {
        $reserve = $this->reserveDAO->SearchByUserId($this->userLogged->getId());
        require_once(VIEWS_PATH . "reserve/add-reserve.php");
    }

    public function Update($keeper, $pet, $startDate, $endDate)
    {
        try {

            $reserve = $this->reserveDAO->SearchByUserId($this->userLogged->getId());
            $reserve->setKeeper($keeper);
            $reserve->setPet($pet);
            $reserve->setStartDate($startDate);
            $reserve->setEndDate($endDate);

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
            $reserve->setSizePet($sizePet);

            if ($this->reserveDAO->Update($reserve)) {
                $_SESSION['success'] = 'reserve updated';
            } else {
                $_SESSION['error'] = 'reserve could not be updated';
            }
            
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowReserve();
    }
}
