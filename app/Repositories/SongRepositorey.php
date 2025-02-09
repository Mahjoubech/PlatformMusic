<?php
namespace App\Repositories;

use App\Models\Song;

class SongRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function findById($id) {
        // Fetch song from the database
        $query = "SELECT * FROM songs WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $songData = $stmt->fetch();

        if ($songData) {
            return new Song($songData['id'], $songData['title'], $songData['artist'], $songData['file_path']);
        }
        return null;
    }

    public function findAll() {
        // Fetch all songs from the database
        $query = "SELECT * FROM songs";
        $stmt = $this->db->query($query);
        $songs = [];

        while ($songData = $stmt->fetch()) {
            $songs[] = new Song($songData['id'], $songData['title'], $songData['artist'], $songData['file_path']);
        }
        return $songs;
    }
}