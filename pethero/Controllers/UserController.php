<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use DAO\UserTypeDAO as UserTypeDAO;
use DAO\KeeperDAO as KeeperDAO;
use DAO\OwnerDAO as OwnerDAO;
use Models\User as User;
use Models\Owner as Owner;
use Models\Keeper as Keeper;

class UserController
{
    private $userDAO;
    private $userTypeDAO;
    private $keeperDAO;
    private $ownerDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
        $this->userTypeDAO = new UserTypeDAO();
        $this->keeperDAO = new KeeperDAO();
        $this->ownerDAO = new OwnerDAO();
    }

    public function ShowLogin()
    {
        require_once(VIEWS_PATH . "auth/login.php");
    }

    public function Login($username, $password)
    {
        unset($_SESSION['error']);

        $user = $this->userDAO->Login($username, $password);
        if ($user != null) {
            $_SESSION['user'] = $user;

            if ($user->isOwner()) {
                header('Location: ../Owner/ShowPerfil');
            } elseif ($user->isKeeper()) {
                header('Location: ../Keeper/ShowPerfil');
            } elseif ($user->isAdmin()) {
                header('Location: ../Admin/');
            }

            return;
        }
        $_SESSION['error'] = 'Credenciales incorrectas';
        $this->ShowLogin();
    }

    public function ShowRegister()
    {
        $usertypes = $this->userTypeDAO->GetAll();
        require_once(VIEWS_PATH . "auth/register.php");
    }

    public function Register($name, $lastname, $address, $username, $password, $usertype)
    {
        unset($_SESSION['error']);
        unset($_SESSION['success']);

        try {

            $user = new User();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setUsertype($this->userTypeDAO->Search($usertype));

            if ($this->userDAO->Add($user)) {

                if ($user->getUsertype()->getType() == 'Owner') {
                    $owner = new Owner();
                    $owner->setName($name);
                    $owner->setLastname($lastname);
                    $owner->setAddress($address);
                    $owner->setUser($user);

                    $this->ownerDAO->Add($owner);
                } elseif ($user->getUsertype()->getType() == 'Keeper') {
                    $keeper = new Keeper();
                    $keeper->setName($name);
                    $keeper->setLastname($lastname);
                    $keeper->setAddress($address);
                    $keeper->setUser($user);

                    $this->keeperDAO->Add($keeper);
                }

                $this->ShowLogin();
                return;
            } else {
                $_SESSION['error'] = 'The username exists';
            }
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Exception. ' . $th->getMessage();
        }
        $this->ShowRegister();
    }

    public function Logout()
    {
        session_destroy();

        header('location:' . FRONT_ROOT);
    }
}
