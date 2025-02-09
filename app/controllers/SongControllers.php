<?php
namespace App\Controllers;

use App\Services\SongService;

class SongController {
    private $songService;

    public function __construct(SongService $songService) {
        $this->songService = $songService;
    }

    public function play($songId) {
        $song = $this->songService->getSongById($songId);
        include __DIR__ . '/../Views/player.php';
    }

    public function index() {
        $songs = $this->songService->getAllSongs();
        include __DIR__ . '/../Views/home.php';
    }
}