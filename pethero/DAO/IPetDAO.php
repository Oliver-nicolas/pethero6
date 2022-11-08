<?php
    namespace DAO;

    use Models\Pet as Pet;

    interface IPetDAO
    {
        function GenerateId();
        function Add(Pet $pet);
        function GetAllByOwner($ownerId);
        function GetAllByPet($petId);
        function GetAll();
    }
    ?>