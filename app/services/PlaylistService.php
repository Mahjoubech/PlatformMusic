<?php
namespace App\Services;

use App\Models\Playlist;
use App\Repositories\PlaylistRepository;
use App\Repositories\SongRepository;

class PlaylistService {
    private $playlistRepository;
    private $songRepository;

    public function __construct() {
        $this->playlistRepository = new PlaylistRepository();
        $this->songRepository = new SongRepository();
    }

    public function createPlaylist(array $data, int $userId): ?int {
        $playlist = new Playlist([
            'name' => $data['name'],
            'visibility' => $data['visibility'] ?? false,
            'created_by' => $userId
        ]);
        
        return $this->playlistRepository->create($playlist);
    }

    public function getUserPlaylists(int $userId): array {
        $playlists = $this->playlistRepository->getUserPlaylists($userId);
        
        // Load songs for each playlist
        foreach ($playlists as $playlist) {
            $songs = $this->playlistRepository->getPlaylistSongs($playlist->getId());
            $playlist->setSongs($songs);
        }
        
        return $playlists;
    }
}
