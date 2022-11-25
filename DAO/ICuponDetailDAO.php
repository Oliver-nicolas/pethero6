<?php
    namespace DAO;

    use Models\CuponDetail as CuponDetail;

    interface ICuponDetailDAO
    {
        function UpdateCupon($cuponId);
        function Add(CuponDetail $cuponDetail);
        function Search($id);
        function SearchByCuponReserve($cuponId, $reserveId);
        function ListByCupon($cuponId);
        function Delete($id);
    }
