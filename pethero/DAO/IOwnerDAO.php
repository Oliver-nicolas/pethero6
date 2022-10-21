<?php
    namespace DAO;

    use Models\Owner as Owner;

    interface IOwnerDAO
    {
        function GenerateId();
        function Add(Owner $student);
        function Search($id);
        function SearchByUserId($userId);
        function GetAll();
    }
