<?php

namespace Controllers;

class AuthController
{
    public static function validateLogged()
    {

        unset($_SESSION['error']);
        unset($_SESSION['success']);

        if (!isset($_SESSION['user'])) {
            header('location: ' . FRONT_ROOT . 'User/ShowLogin');
        }
    }

    public static function validateRole($role)
    {
        $user = $_SESSION['user'];
        if ($user->getRole() != $role) {
            header('location: ' . FRONT_ROOT . 'User/ShowLogin');
        }
    }
}
