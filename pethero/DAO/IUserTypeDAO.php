<?php
    namespace DAO;

    use Models\UserType as UserType;

    interface IUserTypeDAO
    {
        function Add(UserType $userType);
        function Search($id);
        function GetAll();
    }
?>