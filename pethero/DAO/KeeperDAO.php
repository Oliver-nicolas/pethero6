<?php
    namespace DAO;

    use DAO\IKeeperDAO as IKeeperDAO;
    use Models\Keeper as Keeper;

    use DAO\UserDAO as UserDAO;

    class KeeperDAO implements IKeeperDAO
    {
        private $keeperList = array();
        private $userDAO;

        public function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function GenerateId()
        {
            $registers = count($this->keeperList);
            if($registers > 0){
                return $this->keeperList[$registers - 1]->getId() + 1;
            }
            return 1;
        }

        public function Add(Keeper $keeper)
        {
            $this->RetrieveData();

            $keeper->setId($this->GenerateId());
            array_push($this->keeperList, $keeper);

            $this->SaveData();
            return true;
        }

        public function Update(Keeper $keeper)
        {
            $this->RetrieveData();

            $keeper->setId($this->GenerateId());
            array_push($this->keeperList, $keeper);

            $this->SaveData();
            return true;
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->keeperList;
        }
        
        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->keeperList as $keeper)
            {
                $valuesArray["id"] = $keeper->getId();
                $valuesArray["name"] = $keeper->getName();
                $valuesArray["lastname"] = $keeper->getLastname();
                $valuesArray["address"] = $keeper->getAddress();
                $valuesArray["sizePet"] = $keeper->getSizepet();
                $valuesArray["price"] = $keeper->getPrice();
                $valuesArray["startDate"] = $keeper->getStartdate();
                $valuesArray["endDate"] = $keeper->getEnddate();
                $valuesArray["days"] = $keeper->getDays();
                $valuesArray["userId"] = $keeper->getUser()->getId();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/keepers.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->keeperList = array();

            if(file_exists('Data/keepers.json'))
            {
                $jsonContent = file_get_contents('Data/keepers.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $keeper = new Keeper();
                    $keeper->setId($valuesArray["id"]);
                    $keeper->setName($valuesArray["name"]);
                    $keeper->setLastname($valuesArray["lastname"]);
                    $keeper->setAddress($valuesArray["address"]);
                    $keeper->setSizePet($valuesArray["sizePet"]);
                    $keeper->setPrice($valuesArray["price"]);
                    $keeper->setStartDate($valuesArray["startDate"]);
                    $keeper->setEndDate($valuesArray["endDate"]);
                    $keeper->setDays($valuesArray["days"]);
                    $keeper->setUser($this->userDAO->Search($valuesArray["UserId"]));

                    array_push($this->keeperList, $keeper);
                }
            }
        }
    }
