<?php

    class Story{
        private $id;
        private $userId;
        private $title;
        private $storyChapters;
        private $otherUsers;

        public function __construct($userId, $title, $storyChapters, $otherUsers){
            $this->userId = $userId;
            $this->title = $title;
            $this->storyChapters = $storyChapters;
            $this->otherUsers = $otherUsers;
        }

        public function getId(){
            return $this->id;
        }

        public function getUserId(){
            return $this->getUserId;
        }

        public function getTite(){
            return $this->title;
        }
    }

?>