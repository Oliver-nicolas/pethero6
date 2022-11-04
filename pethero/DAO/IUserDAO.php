<?php
    namespace DAO;

    use Models\User as User;

    interface IUserDAO
    {
        function GenerateId();
        function Add(User $user);
        function GetByUsername($username);
        function Search($id);
        function GetAll();
        function Login($username, $password);
    }
?>