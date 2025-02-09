<?php
namespace App\Models;

class Song {
    private $id;
    private $name;
    private $path;
    private $categoryId;
    private $albumId;

    public function __construct(array $data = []) {
        $this->id = $data['song_id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->path = $data['path'] ?? '';
        $this->categoryId = $data['category_id'] ?? null;
        $this->albumId = $data['album'] ?? null;
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getPath() { return $this->path; }
    public function getCategoryId() { return $this->categoryId; }
    public function getAlbumId() { return $this->albumId; }
}