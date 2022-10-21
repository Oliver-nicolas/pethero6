<?php

namespace Models;

class User
{
        private $id;
        private $username;
        private $password;
        private $usertype;

        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of username
         */
        public function getUsername()
        {
                return $this->username;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */
        public function setUsername($username)
        {
                $this->username = $username;

                return $this;
        }

        /**
         * Get the value of password
         */
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of usertype
         */
        public function getUsertype()
        {
                return $this->usertype;
        }

        /**
         * Set the value of usertype
         *
         * @return  self
         */
        public function setUsertype($usertype)
        {
                $this->usertype = $usertype;

                return $this;
        }

        public function isOwner()
        {
                return $this->usertype->getType() == 'Owner';
        }

        public function isKeeper()
        {
                return $this->usertype->getType() == 'Keeper';
        }

        public function isAdmin()
        {
                return $this->usertype->getType() == 'Admin';
        }

        public function getRole()
        {
                return $this->usertype->getType();
        }

        public function __toString()
        {
                return $this->username;
        }
}
