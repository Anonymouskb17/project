<?php 
    class Room{
        private $roomid;
        private $name;

        public function __construct($roomid,$name){
            $this->roomid= $roomid;
            $this->name = $name;
        }

        public function getRoomID(){
            return $this->roomid;
        }

        public function getRoomName(){
            return $this->name;
        }
    }
?>