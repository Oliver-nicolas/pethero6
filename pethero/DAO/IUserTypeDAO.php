<?php
    namespace DAO;

    use Models\UserType as UserType;

    interface IUserTypeDAO
    {
        function Add(UserType $student);
        function Search($id);
        function GetAll();
    }
?>