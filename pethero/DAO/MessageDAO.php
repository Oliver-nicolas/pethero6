<?php

namespace DAO;

use DAO\IMessageDAO as IMessageDAO;
use Models\Message as Message;

use DAO\ChatDAO as ChatDAO;
use Exception;

class MessageDAO implements IMessageDAO
{
    private $connection;
    private $tableName = "messages";

    private $chatDAO;

    public function __construct()
    {
        $this->chatDAO = new ChatDAO();
    }

    public function Add(Message $message)
    {
        try {

            $query = "INSERT INTO " . $this->tableName . " (id, text, date, autor, chatId) VALUES (:id, :text, :date, :autor, :chatId);";
            $parameters["id"] = 0;
            $parameters["text"] = $message->getText();
            $parameters["date"] = $message->getDate();
            $parameters["autor"] = $message->getAutor();
            $parameters["chatId"] = $message->getChat()->getId();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
        return false;
    }

    public function Search($id)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
            $parameters["id"] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $message = new Message();
                $message->setId($row["id"]);
                $message->setText($row["text"]);
                $message->setDate($row["date"]);
                $message->setAutor($row["autor"]);
                $message->setChat($this->chatDAO->Search($row["chatId"]));                

                return $message;
            }

            return null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function SearchByChat($chatId)
    {
        try {
            $messageList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE chatId = :chatId ORDER BY date DESC LIMIT 20";
            $parameters["chatId"] = $chatId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $message = new Message();
                $message->setId($row["id"]);
                $message->setText($row["text"]);
                $message->setDate($row["date"]);
                $message->setAutor($row["autor"]);
                $message->setChat($this->chatDAO->Search($row["chatId"])); 

                array_push($messageList, $message);
            }

            return $messageList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
