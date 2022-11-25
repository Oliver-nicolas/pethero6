<?php

namespace Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('PHPMailer/src/Exception.php');
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php');

use DAO\KeeperDAO as KeeperDAO;
use DAO\ReserveDAO as ReserveDAO;
use DAO\ChatDAO as ChatDAO;
use DAO\MessageDAO as MessageDAO;
use DAO\OwnerDAO as OwnerDAO;
use DAO\CuponDAO as CuponDAO;
use DAO\CuponDetailDAO as CuponDetailDAO;

use Models\Chat as Chat;
use Models\Cupon as Cupon;
use Models\CuponDetail as CuponDetail;
use Models\Message as Message;

use PHPMailer\PHPMailer\SMTP;

class KeeperController
{
    private $keeperDAO;
    private $reserveDAO;
    private $chatDAO;
    private $messageDAO;
    private $ownerDAO;
    private $cuponDAO;
    private $cuponDetailDAO;
    private $userLogged;

    public function __construct()
    {
        AuthController::validateLogged();
        AuthController::validateRole('Keeper');

        $this->keeperDAO = new KeeperDAO();
        $this->reserveDAO = new ReserveDAO();
        $this->chatDAO = new ChatDAO();
        $this->messageDAO = new MessageDAO();
        $this->ownerDAO = new OwnerDAO();
        $this->cuponDAO = new CuponDAO();
        $this->cuponDetailDAO = new CuponDetailDAO();

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
            if (isset($_POST['small'])) {
                array_push($sizePet, 'Small');
            }
            if (isset($_POST['medium'])) {
                array_push($sizePet, 'Medium');
            }
            if (isset($_POST['big'])) {
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

    public function ShowMyReserves()
    {
        $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
        $reserves = $this->reserveDAO->GetAllByKeeper($keeper->getId());
        require_once(VIEWS_PATH . "keeper/my-reserves.php");
    }

    public function AcceptReserve($reserveId)
    {
        try {
            $reserve = $this->reserveDAO->Search($reserveId);
            $reserves = $this->reserveDAO->GetAllByRangeDate($reserve->getStartDate(), $reserve->getEndDate());

            foreach ($reserves as $item) {
                if ($item->getPet()->getPetType()->getId() != $reserve->getPet()->getPetType()->getId()) {
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

    public function DeclineReserve($reserveId)
    {
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
        $owners = $this->ownerDAO->ListByReserveWithKeeper($keeper->getId());

        $messages = [];

        if (count($chats) > 0) {
            if ($chatId == null) {
                $chatId = $chats[0]->getId();
            }

            $messages = $this->messageDAO->SearchByChat($chatId);
        }

        require_once(VIEWS_PATH . "keeper/my-chats.php");
    }

    public function NewChat($ownerId)
    {
        try {
            $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
            $owner = $this->ownerDAO->Search($ownerId);

            $chat = $this->chatDAO->SearchByKeeperOwner($keeper->getId(), $ownerId);

            if ($chat == null) {
                $chat = new Chat();
                $chat->setCreateDate(date('Y-m-d H:i:s'));
                $chat->setOwner($owner);
                $chat->setKeeper($keeper);

                if ($this->chatDAO->Add($chat)) {
                    $_SESSION['success'] = 'Chat created';
                }
            } else {
                $_SESSION['error'] = 'You already have a chat with the owner';
            }
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowMyChats();
    }

    public function SendMessage($chatId, $text)
    {
        try {
            $message = new Message();
            $message->setText($text);
            $message->setDate(date('Y-m-d H:i:s'));
            $message->setAutor('Keeper');
            $message->setChat($this->chatDAO->Search($chatId));

            if ($this->messageDAO->Add($message)) {
                $_SESSION['success'] = 'Message sended';
            }
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowMyChats($chatId);
    }

    public function GenerateCupon($credit_card)
    {
        try {
            $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());

            $cupon = new Cupon();
            $cupon->setNroCupon('CUP' . $keeper->getId() . date('YmdHis'));
            $cupon->setDate(date('Y-m-d'));
            $cupon->setPrice(0);
            $cupon->setCredit_card($credit_card);
            $cupon->setOwnerEmail('');

            if ($this->cuponDAO->Add($cupon)) {
                $_SESSION['success'] = 'Cupon created. Add reserves to Cupon';
                $this->ShowNewCupon($cupon->getNroCupon());
            }
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
    }

    public function AddReserveToCupon($cuponId, $reserveId)
    {
        try {
            $reserve = $this->reserveDAO->Search($reserveId);
            $cupon = $this->cuponDAO->Search($cuponId);

            $cuponDetail = new CuponDetail();
            $cuponDetail->setReserve($reserve);
            $cuponDetail->setCupon($cupon);

            if ($this->cuponDetailDAO->SearchByCuponReserve($cuponId, $reserveId) == null) {
                if ($this->cuponDetailDAO->Add($cuponDetail)) {
                    $_SESSION['success'] = 'Reserve added to Cupon';
                }
            } else {
                $_SESSION['error'] = 'The reserve exists in the Cupon';
            }
            $this->ShowNewCupon($cupon->getNroCupon(), $reserve->getPet()->getOwner()->getId());
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
    }

    public function DeleteReserveToCupon($cuponDetailId)
    {
        try {
            $cuponDetail = $this->cuponDetailDAO->Search($cuponDetailId);

            if ($this->cuponDetailDAO->Delete($cuponDetail->getId())) {
                $_SESSION['success'] = 'Reserve removed from Cupon';
                $this->ShowNewCupon($cuponDetail->getCupon()->getNroCupon(), $cuponDetail->getReserve()->getPet()->getOwner()->getId());
            }
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
    }

    public function ShowNewCupon($nroCupon = null, $ownerId = null)
    {
        $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
        $reserves = [];
        if ($ownerId != null) {
            $reserves = $this->reserveDAO->ListForCuponByOwner($ownerId);
        } else {
            $reserves = $this->reserveDAO->ListForCuponByKeeper($keeper->getId());
        }

        $cupon = new Cupon();
        $details = [];

        if ($nroCupon != null) {
            $cupon = $this->cuponDAO->SearchByNroCupon($nroCupon);
            $details = $this->cuponDetailDAO->ListByCupon($cupon->getId());
        }

        require_once(VIEWS_PATH . "keeper/new-cupon.php");
    }

    public function ShowMyCupons()
    {
        $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
        $cupons = $this->cuponDAO->ListByKeeper($keeper->getId());

        require_once(VIEWS_PATH . "keeper/my-cupons.php");
    }

    public function DeleteCupon($cuponId)
    {
        try {
            $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
            if ($this->cuponDAO->Delete($cuponId)) {
                $_SESSION['success'] = 'Cupon deleted';
            }
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowMyCupons();
    }

    public function SendCuponByEmail($cuponId)
    {

        $mail = new PHPMailer(true);

        try {

            $keeper = $this->keeperDAO->SearchByUserId($this->userLogged->getId());
            $cupon = $this->cuponDAO->Search($cuponId);

            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'petheromdq22@gmail.com';                     //SMTP username
            $mail->Password   = 'qoqsghyvykpzxkyr';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;

            //Recipients
            //$mail->setFrom('petheromdq22@gmail.com', $keeper->getUser());
            //$mail->addAddress('petheromdq22@gmail.com');     //Add a recipient
            $mail->setFrom($keeper->getEmail(), $keeper->getUser());
            $mail->addAddress($cupon->getOwnerEmail());     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Cupon ' . $cupon->getNroCupon();
            $mail->Body    = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body>
                <div class="container">

                    <div class="card">
                        <div class="card-body">
                            <p>
                                <strong>Coupon Number: </strong> '. $cupon->getNroCupon() .' <br>
                                <strong>CBU / CVU: </strong> '. $cupon->getCredit_card() .' <br>
                                <strong>Date: </strong> '. $cupon->getDate() .' <br>
                                <strong>Price: </strong> $'. $cupon->getPrice() .' <br>
                            </p>
                        </div>
                    </div>

                    <a class="btn btn-primary" href="http://localhost/pethero/Home/PayCoupon/' . $cupon->getNroCupon() . '">Pay Coupon</a>
                
                </div>
            </body>
            </html>';

            $mail->send();
            $_SESSION['success'] = 'Message has been sent';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Exception. ' . $mail->ErrorInfo;
        }

        $this->ShowMyCupons();
    }
}
