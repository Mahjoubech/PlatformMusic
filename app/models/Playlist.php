<?php
namespace App\Models;

class Playlist {
    private $id;
    private $name;
    private $visibility;
    private $createDate;
    private $createdBy;
    private $songs = [];

    public function __construct(array $data = []) {
        $this->id = $data['playlist_id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->visibility = $data['visibility'] ?? false;
        $this->createDate = $data['create_date'] ?? null;
        $this->createdBy = $data['created_by'] ?? null;
    }

    // Getters and setters
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function isPublic() { return $this->visibility; }
    public function getCreatedBy() { return $this->createdBy; }
    public function getSongs() { return $this->songs; }
    public function setSongs(array $songs) { $this->songs = $songs; }
}
