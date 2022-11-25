<?php

namespace DAO;

use DAO\IChatDAO as IChatDAO;
use Models\Chat as Chat;

use DAO\OwnerDAO as OwnerDAO;
use DAO\KeeperDAO as KeeperDAO;
use Exception;

class ChatDAO implements IChatDAO
{
    private $connection;
    private $tableName = "chats";

    private $ownerDAO;
    private $keeperDAO;

    public function __construct()
    {
        $this->ownerDAO = new OwnerDAO();
        $this->keeperDAO = new KeeperDAO();
    }

    public function Add(Chat $chat)
    {
        try {

            $query = "INSERT INTO " . $this->tableName . " (id, createDate, ownerId, keeperId) VALUES (:id, :createDate, :ownerId, :keeperId);";
            $parameters["id"] = 0;
            $parameters["createDate"] = $chat->getCreateDate();
            $parameters["ownerId"] = $chat->getOwner()->getId();
            $parameters["keeperId"] = $chat->getKeeper()->getId();

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
                $chat = new Chat();
                $chat->setId($row["id"]);
                $chat->setCreateDate($row["createDate"]);
                $chat->setOwner($this->ownerDAO->Search($row["ownerId"]));
                $chat->setKeeper($this->keeperDAO->Search($row["keeperId"]));                

                return $chat;
            }

            return null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function SearchByKeeperOwner($keeperId, $ownerId)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE keeperId = :keeperId AND ownerId = :ownerId";
            $parameters["keeperId"] = $keeperId;
            $parameters["ownerId"] = $ownerId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $chat = new Chat();
                $chat->setId($row["id"]);
                $chat->setCreateDate($row["createDate"]);
                $chat->setOwner($this->ownerDAO->Search($row["ownerId"]));
                $chat->setKeeper($this->keeperDAO->Search($row["keeperId"]));                

                return $chat;
            }

            return null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function SearchByOwner($ownerId)
    {
        try {
            $chatList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE ownerId = :ownerId ORDER BY createDate DESC";
            $parameters["ownerId"] = $ownerId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $chat = new Chat();
                $chat->setId($row["id"]);
                $chat->setCreateDate($row["createDate"]);
                $chat->setOwner($this->ownerDAO->Search($row["ownerId"]));
                $chat->setKeeper($this->keeperDAO->Search($row["keeperId"]));  

                array_push($chatList, $chat);
            }

            return $chatList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function SearchByKeeper($keeperId)
    {
        try {
            $chatList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE keeperId = :keeperId ORDER BY createDate DESC";
            $parameters["keeperId"] = $keeperId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $chat = new Chat();
                $chat->setId($row["id"]);
                $chat->setCreateDate($row["createDate"]);
                $chat->setOwner($this->ownerDAO->Search($row["ownerId"]));
                $chat->setKeeper($this->keeperDAO->Search($row["keeperId"]));  

                array_push($chatList, $chat);
            }

            return $chatList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
