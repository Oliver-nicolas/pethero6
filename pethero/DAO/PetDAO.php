<?php
    namespace DAO;

    use DAO\IPetDAO as IPetDAO;
    use Models\Pet as Pet;

    use DAO\OwnerDAO as OwnerDAO;

    class PetDAO implements IPetDAO
    {
        private $petList = array();
        private $ownerDAO;

        public function __construct(){
            $this->ownerDAO = new OwnerDAO();
        }

        public function GenerateId()
        {
            $registers = count($this->petList);
            if($registers > 0){
                return $this->petList[$registers - 1]->getId() + 1;
            }
            return 1;
        }

        public function Add(Pet $pet)
        {
            $this->RetrieveData();

            $pet->setId($this->GenerateId());
            array_push($this->petList, $pet);

            $this->SaveData();
            return true;
        }

        function GetAllByOwner($ownerId){
            $this->RetrieveData();

            $data = array();

            foreach($this->petList as $pet){
                if($pet->getOwner()->getId() == $ownerId){
                    array_push($data, $pet);
                }
            }
            return $data;
        }
        
        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->petList as $pet)
            {
                $valuesArray["id"] = $pet->getId();
                $valuesArray["race"] = $pet->getRace();
                $valuesArray["size"] = $pet->getSize();
                $valuesArray["observations"] = $pet->getObservations();
                $valuesArray["image"] = $pet->getImage();
                $valuesArray["vaccinationPlan"] = $pet->getVaccination_plan();
                $valuesArray["video"] = $pet->getVideo();
                $valuesArray["ownerId"] = $pet->getOwner()->getId();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/pets.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->petList = array();

            if(file_exists('Data/pets.json'))
            {
                $jsonContent = file_get_contents('Data/pets.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $pet = new Pet();
                    $pet->setId($valuesArray["id"]);
                    $pet->setRace($valuesArray["race"]);
                    $pet->setSize($valuesArray["size"]);
                    $pet->setObservations($valuesArray["observations"]);
                    $pet->setImage($valuesArray["image"]);
                    $pet->setVaccination_plan($valuesArray["vaccinationPlan"]);
                    $pet->setVideo($valuesArray["video"]);
                    $pet->setOwner($this->ownerDAO->Search($valuesArray["ownerId"]));

                    array_push($this->petList, $pet);
                }
            }
        }
    }
    ?>