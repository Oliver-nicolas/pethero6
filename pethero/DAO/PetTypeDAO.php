<?php
    namespace DAO;

    use DAO\IPetTypeDAO as IPetTypeDAO;
    use Models\PetType as PetType;

    class PetTypeDAO implements IPetTypeDAO
    {
        private $petTypeList = array();

        public function Add(petType $petType)
        {
            $this->RetrieveData();
            
            array_push($this->petTypeList, $petType);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->petTypeList;
        }

        public function Search($id){
            $this->RetrieveData();
            
            foreach($this->petTypeList as $petType){
                if($petType->getId() == $id){
                    return $petType;
                }
            }
            return null;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->petTypeList as $petType)
            {
                $valuesArray["id"] = $petType->getId();
                $valuesArray["type"] = $petType->getType();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/petTypes.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->petTypeList = array();

            if(file_exists('Data/petTypes.json'))
            {
                $jsonContent = file_get_contents('Data/petTypes.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $petType = new petType();
                    $petType->setId($valuesArray["id"]);
                    $petType->setType($valuesArray["type"]);

                    array_push($this->petTypeList, $petType);
                }
            }
        }
    }
?>