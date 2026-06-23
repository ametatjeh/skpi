<?php
$file = fopen('dummy_mahasiswa.csv', 'w');
fputcsv($file, ['NIM', 'NIK', 'Nama Mahasiswa', 'Prodi', 'Tanggal Masuk', 'Status', 'Jenis Kelamin', 'Angkatan']);

$prodis = ['Pembangunan Sosial', 'Sistem Informasi', 'Manajemen', 'Akuntansi', 'Ilmu Hukum'];
$status = ['Aktif', 'Aktif', 'Aktif', 'Cuti', 'Lulus'];
$jk = ['L', 'P'];

for ($i = 1; $i <= 50; $i++) {
    $nim = '2151' . str_pad($i, 5, '0', STR_PAD_LEFT);
    $nik = '1234567890123' . str_pad($i, 3, '0', STR_PAD_LEFT);
    $nama = 'Dummy Mahasiswa ' . $i;
    $prodi = $prodis[array_rand($prodis)];
    $tgl_masuk = '2021-08-01';
    $stat = $status[array_rand($status)];
    $jenis_kelamin = $jk[array_rand($jk)];
    $angkatan = '2021';

    fputcsv($file, [$nim, $nik, $nama, $prodi, $tgl_masuk, $stat, $jenis_kelamin, $angkatan]);
}

fclose($file);
echo "dummy_mahasiswa.csv created.";
