<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama
        DB::table('verifikasi_skpi')->delete();
        DB::table('skpi')->delete();
        DB::table('prestasi')->delete();
        DB::table('organisasi')->delete();
        DB::table('sertifikasi_kompetensi')->delete();
        DB::table('pengabdian_masyarakat')->delete();
        DB::table('mahasiswa')->where('id', '>', 1)->delete();
        DB::table('users')->where('id', '>', 8)->delete();

        // 1. BUAT USER & MAHASISWA DUMMY
        $mahasiswaData = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@student.umpar.ac.id',
                'nim' => '215180002',
                'prodi_id' => 1
            ],
            [
                'name' => 'Siti Rahma',
                'email' => 'siti@student.umpar.ac.id',
                'nim' => '215180003',
                'prodi_id' => 1
            ],
            [
                'name' => 'Andi Wijaya',
                'email' => 'andi@student.umpar.ac.id',
                'nim' => '215180004',
                'prodi_id' => 1
            ]
        ];

        $mahasiswaIds = [];
        foreach ($mahasiswaData as $data) {
            $userId = DB::table('users')->insertGetId([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $mahasiswaId = DB::table('mahasiswa')->insertGetId([
                'user_id' => $userId,
                'prodi_id' => $data['prodi_id'],
                'nim' => $data['nim'],
                'nama' => $data['name'],
                'tempat_lahir' => 'Parepare',
                'tanggal_lahir' => '2001-06-15',
                'tahun_masuk' => '2019',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $mahasiswaIds[] = $mahasiswaId;
        }

        // 2. BUAT DATA PRESTASI
        $prestasiData = [
            // Budi Santoso
            ['mahasiswa_id' => $mahasiswaIds[0], 'nama_kegiatan' => 'Lomba Coding Nasional', 'tingkat' => 'nasional', 'tahun' => 2023],
            ['mahasiswa_id' => $mahasiswaIds[0], 'nama_kegiatan' => 'Hackathon Universitas', 'tingkat' => 'lokal', 'tahun' => 2022],

            // Siti Rahma  
            ['mahasiswa_id' => $mahasiswaIds[1], 'nama_kegiatan' => 'Olimpiade Matematika', 'tingkat' => 'nasional', 'tahun' => 2023],
            ['mahasiswa_id' => $mahasiswaIds[1], 'nama_kegiatan' => 'Kompetisi Debat', 'tingkat' => 'lokal', 'tahun' => 2022],

            // Andi Wijaya
            ['mahasiswa_id' => $mahasiswaIds[2], 'nama_kegiatan' => 'Robotic Competition', 'tingkat' => 'internasional', 'tahun' => 2024],
        ];

        foreach ($prestasiData as $prestasi) {
            DB::table('prestasi')->insert([
                'mahasiswa_id' => $prestasi['mahasiswa_id'],
                'nama_kegiatan' => $prestasi['nama_kegiatan'],
                'tingkat' => $prestasi['tingkat'],
                'tahun' => $prestasi['tahun'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // 3. BUAT DATA ORGANISASI
        $organisasiData = [
            // Budi Santoso
            ['mahasiswa_id' => $mahasiswaIds[0], 'nama_organisasi' => 'Himpunan Mahasiswa Informatika', 'jabatan' => 'Ketua Divisi Teknologi', 'periode' => '2022-2023'],
            ['mahasiswa_id' => $mahasiswaIds[0], 'nama_organisasi' => 'UKM Programming', 'jabatan' => 'Anggota', 'periode' => '2021-2022'],

            // Siti Rahma
            ['mahasiswa_id' => $mahasiswaIds[1], 'nama_organisasi' => 'Badan Eksekutif Mahasiswa', 'jabatan' => 'Sekretaris', 'periode' => '2023-2024'],

            // Andi Wijaya
            ['mahasiswa_id' => $mahasiswaIds[2], 'nama_organisasi' => 'UKM Robotika', 'jabatan' => 'Ketua', 'periode' => '2023-2024'],
        ];

        foreach ($organisasiData as $organisasi) {
            DB::table('organisasi')->insert([
                'mahasiswa_id' => $organisasi['mahasiswa_id'],
                'nama_organisasi' => $organisasi['nama_organisasi'],
                'jabatan' => $organisasi['jabatan'],
                'periode' => $organisasi['periode'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // 4. BUAT DATA SERTIFIKASI
        $sertifikasiData = [
            // Budi Santoso
            ['mahasiswa_id' => $mahasiswaIds[0], 'nama_sertifikasi' => 'TOEFL ITP', 'lembaga_penerbit' => 'Lembaga Bahasa UMPAR', 'tahun' => 2022],
            ['mahasiswa_id' => $mahasiswaIds[0], 'nama_sertifikasi' => 'AWS Cloud Practitioner', 'lembaga_penerbit' => 'Amazon Web Services', 'tahun' => 2023],

            // Siti Rahma
            ['mahasiswa_id' => $mahasiswaIds[1], 'nama_sertifikasi' => 'IELTS', 'lembaga_penerbit' => 'British Council', 'tahun' => 2023],

            // Andi Wijaya
            ['mahasiswa_id' => $mahasiswaIds[2], 'nama_sertifikasi' => 'Google Cloud Associate', 'lembaga_penerbit' => 'Google', 'tahun' => 2024],
        ];

        foreach ($sertifikasiData as $sertifikasi) {
            DB::table('sertifikasi_kompetensi')->insert([
                'mahasiswa_id' => $sertifikasi['mahasiswa_id'],
                'nama_sertifikasi' => $sertifikasi['nama_sertifikasi'],
                'lembaga_penerbit' => $sertifikasi['lembaga_penerbit'],
                'tahun' => $sertifikasi['tahun'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // 5. BUAT DATA PENGABDIAN MASYARAKAT
        $pengabdianData = [
            ['mahasiswa_id' => $mahasiswaIds[0], 'nama_kegiatan' => 'Pelatihan Komputer untuk Anak Jalanan', 'tahun' => 2023],
            ['mahasiswa_id' => $mahasiswaIds[1], 'nama_kegiatan' => 'Bimbingan Belajar Gratis', 'tahun' => 2022],
            ['mahasiswa_id' => $mahasiswaIds[2], 'nama_kegiatan' => 'Workshop Teknologi untuk UMKM', 'tahun' => 2024],
        ];

        foreach ($pengabdianData as $pengabdian) {
            DB::table('pengabdian_masyarakat')->insert([
                'mahasiswa_id' => $pengabdian['mahasiswa_id'],
                'nama_kegiatan' => $pengabdian['nama_kegiatan'],
                'tahun' => $pengabdian['tahun'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // 6. BUAT DATA SKPI DENGAN STATUS BERBEDA
        $skpiData = [
            // Status: DIAJUKAN (untuk test approve/reject)
            ['mahasiswa_id' => $mahasiswaIds[0], 'status' => 'diajukan', 'catatan' => null, 'tanggal_pengajuan' => now()->subDays(1)],
            ['mahasiswa_id' => $mahasiswaIds[1], 'status' => 'diajukan', 'catatan' => null, 'tanggal_pengajuan' => now()->subDays(2)],
            ['mahasiswa_id' => $mahasiswaIds[2], 'status' => 'diajukan', 'catatan' => null, 'tanggal_pengajuan' => now()->subDays(3)],

            // Status: DIVERIFIKASI_PRODI (sudah disetujui)
            ['mahasiswa_id' => $mahasiswaIds[0], 'status' => 'diverifikasi_prodi', 'catatan' => 'Data sudah lengkap dan valid', 'tanggal_pengajuan' => now()->subDays(10), 'nomor_skpi' => 'SKPI-UMPAR-2024-TI-0001'],

            // Status: DITOLAK (sudah ditolak)
            ['mahasiswa_id' => $mahasiswaIds[1], 'status' => 'ditolak', 'catatan' => 'Data prestasi belum dilengkapi dengan bukti yang valid', 'tanggal_pengajuan' => now()->subDays(7)],
        ];

        foreach ($skpiData as $skpi) {
            DB::table('skpi')->insert([
                'mahasiswa_id' => $skpi['mahasiswa_id'],
                'nomor_skpi' => $skpi['nomor_skpi'] ?? null,
                'status' => $skpi['status'],
                'catatan' => $skpi['catatan'],
                'tanggal_pengajuan' => $skpi['tanggal_pengajuan'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $this->command->info('🎉 DATA DUMMY BERHASIL DIBUAT!');
        $this->command->info('================================');
        $this->command->info('📊 STATISTIK DATA:');
        $this->command->info('• Mahasiswa: ' . DB::table('mahasiswa')->count());
        $this->command->info('• SKPI: ' . DB::table('skpi')->count());
        $this->command->info('  - Diajukan: ' . DB::table('skpi')->where('status', 'diajukan')->count());
        $this->command->info('  - Diverifikasi: ' . DB::table('skpi')->where('status', 'diverifikasi_prodi')->count());
        $this->command->info('  - Ditolak: ' . DB::table('skpi')->where('status', 'ditolak')->count());
        $this->command->info('• Prestasi: ' . DB::table('prestasi')->count());
        $this->command->info('• Organisasi: ' . DB::table('organisasi')->count());
        $this->command->info('• Sertifikasi: ' . DB::table('sertifikasi_kompetensi')->count());
        $this->command->info('• Pengabdian: ' . DB::table('pengabdian_masyarakat')->count());
        $this->command->info('================================');
        $this->command->info('🔑 LOGIN UNTUK TESTING:');
        $this->command->info('Prodi: prodi.ti@umpar.ac.id / password');
        $this->command->info('Mahasiswa: budi@student.umpar.ac.id / password');
    }
}
