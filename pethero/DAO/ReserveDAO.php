<?php
    namespace DAO;

    use DAO\IReserveDAO as IReserveDAO;
    use Models\Reserve as Reserve;

    use DAO\UserDAO as UserDAO;

    class ReserveDAO implements IReserveDAO
    {
        private $reserveList = array();
        private $userDAO;

        public function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function GenerateId()
        {
            $registers = count($this->reserveList);
            if($registers > 0){
                return $this->reserveList[$registers - 1]->getId() + 1;
            }
            return 1;
        }

        public function Add(Reserve $reserve)
        {
            $this->RetrieveData();

            $reserve->setId($this->GenerateId());
            array_push($this->reserveList, $reserve);

            $this->SaveData();
            return true;
        }

        public function Search($id){
            $this->RetrieveData();

            foreach($this->reserveList as $reserve){
                if($reserve->getId() == $id){
                    return $reserve;
                }
            }
            return null;
        }

        function SearchByUserId($userId){
            $this->RetrieveData();

            foreach($this->reserveList as $reserve){
                if($reserve->getUser()->getId() == $userId){
                    return $reserve;
                }
            }
            return null;
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->reserveList;
        }
        
        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->reserveList as $reserve)
            {
                $valuesArray["id"] = $reserve->getId();
                $valuesArray["keeper"] = $reserve->getKeeper();
                $valuesArray["pet"] = $reserve->getPet();
                $valuesArray["startDate"] = $reserve->getStartDate();
                $valuesArray["endDate"] = $reserve->getEndDate();
                $valuesArray["accepted"] = $reserve->getAccepted();
                $valuesArray["cupon_generated"] = $reserve->getCupon_generated();
           
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/reserves.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->reserveList = array();

            if(file_exists('Data/reserves.json'))
            {
                $jsonContent = file_get_contents('Data/reserves.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $reserve = new Reserve();

                    $reserve->setId($valuesArray["id"]);
                    $reserve->setKeeper($valuesArray["keeper"]);
                    $reserve->setPet($valuesArray["pet"]);
                    $reserve->setStartDate($valuesArray["startDate"]);
                    $reserve->setEndDate($valuesArray["endDate"]);
                    $reserve->setAccepted($valuesArray["accepted"]);
                    $reserve->setCupon_generated($valuesArray["cupon_generated"]);

                    array_push($this->reserveList, $reserve);
                }
            }
        }
    }
    ?>