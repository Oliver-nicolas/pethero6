<?php
    namespace DAO;

    use Models\PetType as PetType;

    interface IPetTypeDAO
    {
        function Add(PetType $petType);
        function Search($id);
        function GetAll();
    }
?>