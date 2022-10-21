<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;

    use DAO\UserTypeDAO as UserTypeDAO;

    class UserDAO implements IUserDAO
    {
        private $userList = array();
        private $userTypeDAO;

        public function __construct(){
            $this->userTypeDAO = new UserTypeDAO();
        }

        public function GenerateId()
        {
            $registers = count($this->userList);
            if($registers > 0){
                return $this->userList[$registers - 1]->getId() + 1;
            }
            return 1;
        }

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

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->userList;
        }

        public function GetByUsername($username){
            $this->RetrieveData();
            foreach ($this->userList as $item) {
                if($item->getUsername() == $username){
                    return $item;
                }
            }
            return null;
        }

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
                $valuesArray["userTypeId"] = $user->getUserType()->getId();

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
    }
?>