<?php
    namespace DAO;

    use Models\Reserve as Reserve;

    interface IReserveDAO
    {
        function Add(Reserve $reserve);
        function Accept(Reserve $reserve);
        function Decline(Reserve $reserve);
        function Search($id);
        function GetAllByKeeper($keeperId);
        function GetAllByOwner($ownerId);
    }
?>