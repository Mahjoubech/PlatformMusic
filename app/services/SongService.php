<?php
namespace App\Services;

use App\Repositories\SongRepository;

class SongService {
    private $songRepository;

    public function __construct(SongRepository $songRepository) {
        $this->songRepository = $songRepository;
    }

    public function getSongById($id) {
        return $this->songRepository->findById($id);
    }

    public function getAllSongs() {
        return $this->songRepository->findAll();
    }
}