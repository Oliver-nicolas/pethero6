<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use DAO\Connection as Connection;
    use \Exception as Exception;
    use DAO\UserTypeDAO as UserTypeDAO;

    class UserDAO implements IUserDAO
    {
        private $userList = array();
        private $userTypeDAO;
        private $connection;
    

        public function __construct(){
            $this->userTypeDAO = new UserTypeDAO();
        }

        public function GenerateId(){
            $registers = count($this->userList);
            if($registers > 0){
                return $this->userList[$registers - 1]->getId() + 1;
            }
            return 1;
        }

        /*public function Add(User $user){
            try
            {
                $query = "INSERT INTO ".$this->tableUser." (id, username, password, usertype) VALUES (:id, :username, :password, :usertype);";
                
                if($this->GetByUsername($user->getUsername()) != null){
                    return false;
                }

                $parameters["id"] = $user->getId();
                $parameters["username"] = $user->getUsername();
                $parameters["password"] = $user->getPassword();
                $parameters["usertype"] = $user->getUsertype();
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, true);

                return true;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }*/

        public function Add(User $user)
        {
            $this->RetrieveData();
            
            if($this->GetByUsername($user->getUsername()) != null){
                return false;
            }

            $user->setId($this->GenerateId());
            array_push($this->userList, $user);

            $this->SaveData();
            return true;
        }

        /*public function GetAll(){
            try
            {
                
                $query = "SELECT * FROM ".$this->tableUser;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $user = new User();
                    
                    $user->getId($row["id"]);
                    $user->getUsername($row["username"]);
                    $user->getPassword($row["password"]);
                    $user->getUsertype($row["usertype"]);

                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }*/

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->userList;
        }

        /*public function GetByUsername($username){
            $sql = "SELECT * FROM user where  $username * :username";

            $parameters["username"] = $username;

            try {
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->execute($sql, $parameters);
            } catch(Exception $ex){
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->mapear($resultSet);
            }else{
                return false;
            }
        }*/

        public function GetByUsername($username){
            $this->RetrieveData();
            foreach ($this->userList as $item) {
                if($item->getUsername() == $username){
                    return $item;
                }
            }
            return null;
        }

        /*public function GetByType($type){
            $sql = "SELECT * FROM user where  $type * :type";

            $parameters["type"] = $type;

            try {
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->execute($sql, $parameters);
            } catch(Exception $ex ){
                throw $ex;
            }

            if(!empty($resultSet))
                return $this->mapear($resultSet);
            else
                return false;
        }*/

        public function GetByType($type)
        {
            $this->RetrieveData();

            $data = array();

            foreach ($this->userList as $item) {
                if($item->getUsertype()->getType == $type){
                    array_push($data, $item);
                }
            }

            return $data;
        }

        /*public function Search($id){
            $sql = "SELECT * FROM user where  $id * :id";

            $parameters["id"] = $id;

            try {
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->execute($sql, $parameters);
            } catch(Exception $ex){
                throw $ex;
            }

            if(!empty($resultSet))
                return $this->mapear($resultSet);
            else
                return false;
        }*/

        public function Search($id){
            $this->RetrieveData();

            foreach ($this->userList as $item) {
                if($item->getId() == $id){
                    return $item;
                }
            }
            return null;
        }

        public function Login($username, $password){

            $user = $this->GetByUsername($username);

            if($user != null && $user->getPassword() == $password){
                return $user;
            }
            return null;
        }
        
        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
                $valuesArray["id"] = $user->getId();
                $valuesArray["username"] = $user->getUsername();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["userTypeId"] = $user->getUsertype()->getId();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/users.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->userList = array();

            if(file_exists('Data/users.json'))
            {
                $jsonContent = file_get_contents('Data/users.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $user = new User();
                    $user->setId($valuesArray["id"]);
                    $user->setUsername($valuesArray["username"]);
                    $user->setPassword($valuesArray["password"]);
                    $user->setUsertype($this->userTypeDAO->Search($valuesArray["userTypeId"]));

                    array_push($this->userList, $user);
                }
            }
        }

        /*protected function mapear($value){

            $value = is_array($value) ? $value : [];

            $resp = array_map(function($p)){
                return new M_User($p["id"], $p["username"], $p["password"], $p["usertype"]}, $value);

            return count($resp) > 1 ? $resp : $resp["0"];
        }*/
    }
?>