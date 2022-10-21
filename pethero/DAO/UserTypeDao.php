<?php
    namespace DAO;

    use DAO\IUserTypeDAO as IUserTypeDAO;
    use Models\UserType as UserType;

    class UserTypeDAO implements IUserTypeDAO
    {
        private $userTypeList = array();

        public function Add(UserType $userType)
        {
            $this->RetrieveData();
            
            array_push($this->userTypeList, $userType);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->userTypeList;
        }

        public function Search($id){
            $this->RetrieveData();
            
            foreach($this->userTypeList as $userType){
                if($userType->getId() == $id){
                    return $userType;
                }
            }
            return null;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userTypeList as $userType)
            {
                $valuesArray["id"] = $userType->getId();
                $valuesArray["type"] = $userType->getType();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/userTypes.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->userTypeList = array();

            if(file_exists('Data/userTypes.json'))
            {
                $jsonContent = file_get_contents('Data/userTypes.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $userType = new UserType();
                    $userType->setId($valuesArray["id"]);
                    $userType->setType($valuesArray["type"]);

                    array_push($this->userTypeList, $userType);
                }
            }
        }
    }
?>