<?php
    namespace DAO;

    use Models\Pet as Pet;

    interface IPetDAO
    {
        function Add(Pet $pet);
        function GetAllByOwner($ownerId);
    }
