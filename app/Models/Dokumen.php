<?php

namespace App\Models;

/**
 * Model Dokumen - alias untuk DokumenPendukung
 * 
 * Digunakan untuk backward-compatibility jika ada referensi
 * ke model Dokumen di controller atau view lama.
 */
class Dokumen extends DokumenPendukung
{
    // Inherit semua dari DokumenPendukung
    // Tabel: dokumen_pendukung
    // Fillable: mahasiswa_id, nama_dokumen, jenis_dokumen, file_path, ukuran_file, tipe_file, status
}
