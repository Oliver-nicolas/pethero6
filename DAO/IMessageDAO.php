<?php
    namespace DAO;

    use Models\Message as Message;

    interface IMessageDAO
    {
        function Add(Message $message);
        function Search($id);
        function SearchByChat($chatId);
    }
