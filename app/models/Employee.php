<?php 
    class Employee{
        private $id;
        private $name;
        private $birthday;

        private $roomid;

        public function __construct($id,$name, $birthday, $roomid){
            $this->id = $id;
            $this->name = $name;
            $this->birthday = $birthday;
            $this->roomid = $roomid;
        }

        public function getID(){
            return $this->id;
        }

        public function getName(){
            return $this->name;
        }

        public function getBirthday(){
            return $this->birthday;
        }

        public function getRoomID(){
            return $this->roomid;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function setBirthday($birthday){
            $this->birthday = $birthday;
        }

        public function setRoomID($roomid){
            $this->roomid = $roomid;
        }
    }
    
?>