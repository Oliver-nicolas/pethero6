<?php
    namespace DAO;

    use Models\Pet as Pet;

    interface IPetDAO
    {
        function GenerateId();
        function Add(Pet $student);
        function GetAllByOwner($ownerId);
    }
