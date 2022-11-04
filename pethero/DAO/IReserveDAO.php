<?php
    namespace DAO;

    use Models\Reserve as Reserve;

    interface IReserveDAO
    {
        function GenerateId();
        function Add(Reserve $reserve);
        function Search($id);
        function SearchByUserId($userId);
        function GetAll();
    }
    ?>