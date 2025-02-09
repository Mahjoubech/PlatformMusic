<?php
namespace App\Repositories;

use App\Models\Playlist;
use App\Models\Song;
use Config\Database;

class PlaylistRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create(Playlist $playlist): ?int {
        $stmt = $this->db->prepare(
            'INSERT INTO playlists (name, visibility, created_by) 
             VALUES (:name, :visibility, :created_by) RETURNING playlist_id'
        );
        
        $stmt->execute([
            'name' => $playlist->getName(),
            'visibility' => $playlist->isPublic(),
            'created_by' => $playlist->getCreatedBy()
        ]);
        
        return $stmt->fetchColumn();
    }

    public function addSong(int $playlistId, int $songId): bool {
        $stmt = $this->db->prepare(
            'INSERT INTO playlist_songs (playlist_id, song_id) VALUES (:playlist_id, :song_id)'
        );
        
        return $stmt->execute([
            'playlist_id' => $playlistId,
            'song_id' => $songId
        ]);
    }

    public function getUserPlaylists(int $userId): array {
        $stmt = $this->db->prepare(
            'SELECT * FROM playlists WHERE created_by = :user_id ORDER BY create_date DESC'
        );
        $stmt->execute(['user_id' => $userId]);
        
        $playlists = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $playlists[] = new Playlist($row);
        }
        
        return $playlists;
    }

    public function getPlaylistSongs(int $playlistId): array {
        $stmt = $this->db->prepare(
            'SELECT s.* FROM songs s
             JOIN playlist_songs ps ON s.song_id = ps.song_id
             WHERE ps.playlist_id = :playlist_id'
        );
        $stmt->execute(['playlist_id' => $playlistId]);
        
        $songs = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $songs[] = new Song($row);
        }
        
        return $songs;
    }
}