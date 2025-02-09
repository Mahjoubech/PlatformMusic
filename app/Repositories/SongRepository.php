<?php
namespace App\Repositories;

use App\Models\Song;
use Config\Database;

class SongRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create(Song $song): ?int {
        $stmt = $this->db->prepare(
            'INSERT INTO songs (name, path, category_id, album) 
             VALUES (:name, :path, :category_id, :album) RETURNING song_id'
        );
        
        $stmt->execute([
            'name' => $song->getName(),
            'path' => $song->getPath(),
            'category_id' => $song->getCategoryId(),
            'album' => $song->getAlbumId()
        ]);
        
        return $stmt->fetchColumn();
    }

    public function addToFavorites(int $userId, int $songId): bool {
        $stmt = $this->db->prepare(
            'INSERT INTO favorite (user_id, song_id) VALUES (:user_id, :song_id)'
        );
        
        return $stmt->execute([
            'user_id' => $userId,
            'song_id' => $songId
        ]);
    }

    public function getUserFavorites(int $userId): array {
        $stmt = $this->db->prepare(
            'SELECT s.* FROM songs s
             JOIN favorite f ON s.song_id = f.song_id
             WHERE f.user_id = :user_id'
        );
        $stmt->execute(['user_id' => $userId]);
        
        $songs = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $songs[] = new Song($row);
        }
        
        return $songs;
    }
}
