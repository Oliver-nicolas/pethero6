<?php
    namespace DAO;

    use Models\Cupon as Cupon;

    interface ICuponDAO
    {
        function Add(Cupon $cupon);
        function Search($id);
        function SearchByNroCupon($nroCupon);
        function ListByKeeper($keeperId);
        function Delete($id);
    }
