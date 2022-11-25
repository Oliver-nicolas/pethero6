<?php
    namespace DAO;

    use Models\PetType as PetType;

    interface IPetTypeDAO
    {
        function Add(PetType $typePet);
        function Search($id);
        function GetAll();
    }
?>