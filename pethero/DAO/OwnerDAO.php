<?php
    namespace DAO;

    use DAO\IOwnerDAO as IOwnerDAO;
    use Models\Owner as Owner;

    use DAO\UserDAO as UserDAO;

    class OwnerDAO implements IOwnerDAO
    {
        private $ownerList = array();
        private $userDAO;

        public function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function GenerateId()
        {
            $registers = count($this->ownerList);
            if($registers > 0){
                return $this->ownerList[$registers - 1]->getId() + 1;
            }
            return 1;
        }

        public function Add(Owner $owner)
        {
            $this->RetrieveData();

            $owner->setId($this->GenerateId());
            array_push($this->ownerList, $owner);

            $this->SaveData();
            return true;
        }

        public function Search($id){
            $this->RetrieveData();

            foreach($this->ownerList as $owner){
                if($owner->getId() == $id){
                    return $owner;
                }
            }
            return null;
        }

        function SearchByUserId($userId){
            $this->RetrieveData();

            foreach($this->ownerList as $owner){
                if($owner->getUser()->getId() == $userId){
                    return $owner;
                }
            }
            return null;
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->ownerList;
        }
        
        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->ownerList as $owner)
            {
                $valuesArray["id"] = $owner->getId();
                $valuesArray["name"] = $owner->getName();
                $valuesArray["lastname"] = $owner->getLastname();
                $valuesArray["address"] = $owner->getAddress();
                $valuesArray["userId"] = $owner->getUser()->getId();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/owners.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->ownerList = array();

            if(file_exists('Data/owners.json'))
            {
                $jsonContent = file_get_contents('Data/owners.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $owner = new Owner();
                    $owner->setId($valuesArray["id"]);
                    $owner->setName($valuesArray["name"]);
                    $owner->setLastname($valuesArray["lastname"]);
                    $owner->setAddress($valuesArray["address"]);
                    $owner->setUser($this->userDAO->Search($valuesArray["userId"]));

                    array_push($this->ownerList, $owner);
                }
            }
        }
    }
    ?>