<?php
    namespace DAO;

    use Models\Keeper as Keeper;

    interface IKeeperDAO
    {
        function Add(Keeper $keeper);
        function Update(Keeper $keeper);
        function Search($id);
        function SearchByUserId($userId);
        function GetAll();
    }
