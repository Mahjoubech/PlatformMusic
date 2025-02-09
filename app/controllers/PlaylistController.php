<?php
namespace App\Controllers;

use App\Services\PlaylistService;
use App\Services\AuthService;

class PlaylistController {
    private $playlistService;
    private $authService;

    public function __construct() {
        $this->playlistService = new PlaylistService();
        $this->authService = new AuthService();
    }

    public function create() {
        if (!$this->authService->isAuthenticated()) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $playlistData = [
                'name' => $_POST['name'] ?? '',
                'visibility' => isset($_POST['visibility']) && $_POST['visibility'] === 'public'
            ];
            
            $playlistId = $this->playlistService->createPlaylist($playlistData, $userId);
            if ($playlistId) {
                header('Location: /playlist/' . $playlistId);
                exit;
            }
            
            $error = 'Failed to create playlist';
        }
        
        require_once 'views/playlist/create.php';
    }

    public function list() {
        if (!$this->authService->isAuthenticated()) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $playlists = $this->playlistService->getUserPlaylists($userId);
        
        require_once 'views/playlist/list.php';
    }
}

