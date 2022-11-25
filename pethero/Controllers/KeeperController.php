<?php

namespace Controllers;

use DAO\KeeperDAO as KeeperDAO;
use DAO\ReserveDAO as ReserveDAO;
use DAO\ChatDAO as ChatDAO;
use DAO\MessageDAO as MessageDAO;

use Models\Chat as Chat;
use Models\Message as Message;

class KeeperController
{
    private $keeperDAO;
    private $reserveDAO;
    private $chatDAO;
    private $messageDAO;
    private $userLogged;

    public function __construct()
    {
        AuthController::validateLogged();
        AuthController::validateRole('Keeper');

        $this->keeperDAO = new KeeperDAO();
        $this->reserveDAO = new ReserveDAO();
        $this->chatDAO = new ChatDAO();
        $this->messageDAO = new MessageDAO();

        $this->userLogged = $_SESSION['user'];
    }

    public function ShowIndex()
    {
        $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
        require_once(VIEWS_PATH . "keeper/index.php");
    }

    public function ShowPerfil()
    {
        $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
        require_once(VIEWS_PATH . "keeper/perfil.php");
    }

    public function Update($name, $lastName, $address, $email, $startDate, $endDate, $days, $price)
    {
        try {

            $sizePet = array();
            if(isset($_POST['small'])){
                array_push($sizePet, 'Small');
            }
            if(isset($_POST['medium'])){
                array_push($sizePet, 'Medium');
            }
            if(isset($_POST['big'])){
                array_push($sizePet, 'Big');
            }

            $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
            $keeper->setName($name);
            $keeper->setLastname($lastName);
            $keeper->setAddress($address);
            $keeper->setEmail($email);
            $keeper->setPrice($price);
            $keeper->setStartdate($startDate);
            $keeper->setEnddate($endDate);
            $keeper->setDays($days);
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

    public function ShowMyReserves(){
        $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
        $reserves = $this->reserveDAO->GetAllByKeeper($keeper->getId());
        require_once(VIEWS_PATH . "keeper/my-reserves.php");
    }

    public function AcceptReserve($reserveId){        
        try {
            $reserve = $this->reserveDAO->Search($reserveId);
            $reserves = $this->reserveDAO->GetAllByRangeDate($reserve->getStartDate(), $reserve->getEndDate());

            foreach ($reserves as $item) {
                if($item->getPet()->getPetType()->getId() != $reserve->getPet()->getPetType()->getId()){
                    $_SESSION['error'] = 'You can not take care of different types of pets in the same day';
                    $this->ShowMyReserves();
                    return;
                }
            }

            if ($reserve->getState() == 'Waiting' && $this->reserveDAO->Accept($reserve)) {
                $_SESSION['success'] = 'Reserve accepted';
            } else {
                $_SESSION['error'] = 'Reserve could not be accepted';
            }

        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowMyReserves();
    }

    public function DeclineReserve($reserveId){        
        try {
            $reserve = $this->reserveDAO->Search($reserveId);          

            if ($reserve->getState() == 'Waiting' && $this->reserveDAO->Decline($reserve)) {
                $_SESSION['success'] = 'Reserve declined';
            } else {
                $_SESSION['error'] = 'Reserve could not be declined';
            }

        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowMyReserves();
    }

    public function ShowMyChats($chatId = null)
    {
        $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
        $chats = $this->chatDAO->SearchByKeeper($keeper->getId());
        $keepers = $this->keeperDAO->GetAll();

        $messages = [];

        if (count($chats) > 0) {
            if($chatId == null){
                $chatId = $chats[0]->getId();
            }
            
            $messages = $this->messageDAO->SearchByChat($chatId);
        }

        require_once(VIEWS_PATH . "keeper/my-chats.php");
    }
}
