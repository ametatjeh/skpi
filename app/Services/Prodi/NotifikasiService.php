<?php

namespace App\Services\Prodi;

use App\Models\Notifikasi;
use App\Models\Mahasiswa;

class NotifikasiService
{
    /**
     * Kirim notifikasi ke user tertentu
     *
     * @param int $userId
     * @param string $judul
     * @param string $pesan
     * @param string $tipe (info|success|warning|error|approval)
     * @param string|null $link
     * @return Notifikasi
     */
    public function sendToUser($userId, $judul, $pesan, $tipe = 'info', $link = null)
    {
        return Notifikasi::create([
            'user_id' => $userId,
            'judul' => $judul,
            'pesan' => $pesan,
            'tipe' => $tipe,
            'is_read' => false,
            'link' => $link,
        ]);
    }

    /**
     * Kirim notifikasi ke mahasiswa berdasarkan mahasiswa_id
     *
     * @param int $mahasiswaId
     * @param string $judul
     * @param string $pesan
     * @param string $tipe
     * @param string|null $link
     * @return Notifikasi|null
     */
    public function sendToMahasiswa($mahasiswaId, $judul, $pesan, $tipe = 'info', $link = null)
    {
        $mahasiswa = Mahasiswa::find($mahasiswaId);

        if (!$mahasiswa || !$mahasiswa->user_id) {
            return null;
        }

        return $this->sendToUser($mahasiswa->user_id, $judul, $pesan, $tipe, $link);
    }

    /**
     * Tandai semua notifikasi user sebagai sudah dibaca
     *
     * @param int $userId
     * @return int Jumlah notifikasi yang di-update
     */
    public function markAllAsRead($userId)
    {
        return Notifikasi::where('user_id', $userId)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
    }

    /**
     * Ambil notifikasi terbaru untuk user
     *
     * @param int $userId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentNotifications($userId, $limit = 10)
    {
        return Notifikasi::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * Hitung jumlah notifikasi belum dibaca
     *
     * @param int $userId
     * @return int
     */
    public function getUnreadCount($userId)
    {
        return Notifikasi::where('user_id', $userId)
            ->where('is_read', false)
            ->count();
    }
}
