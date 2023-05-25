<?php

    class Chapter{
        private $id;
        private $chapterText;
        private $storyId;

        public function __construct($chapterText, $storyId){
            $this->chapterText = $chapterText;
            $this->storyId = $storyId;
        }

        public function getId(){
            return $this->id;
        }

        public function getChapterText(){
            return $this->chapterText;
        }

        public function getStoryId(){
            return $this->storyId;
        }
    }

?>