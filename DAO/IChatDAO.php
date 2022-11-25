<?php
    namespace DAO;

    use Models\Chat as Chat;

    interface IChatDAO
    {
        function Add(Chat $chat);
        function Search($id);
        function SearchByOwner($ownerId);
        function SearchByKeeper($keeperId);
    }
