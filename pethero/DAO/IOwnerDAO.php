<?php
    namespace DAO;

    use Models\Owner as Owner;

    interface IOwnerDAO
    {
        function Add(Owner $owner);
        function Search($id);
        function SearchByUserId($userId);
        function GetAll();
    }
