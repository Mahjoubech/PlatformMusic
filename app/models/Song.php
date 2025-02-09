<?php
namespace App\Models;

class Song {
    private $id;
    private $title;
    private $artist;
    private $filePath;

    public function __construct($id, $title, $artist, $filePath) {
        $this->id = $id;
        $this->title = $title;
        $this->artist = $artist;
        $this->filePath = $filePath;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getArtist() {
        return $this->artist;
    }

    public function getFilePath() {
        return $this->filePath;
    }
}