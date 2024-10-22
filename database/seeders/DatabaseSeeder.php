<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('karyawans')->insert([
            ['nuptk' => '12345', 'nama' => 'Surya', 'jabatan' => 'guru honor', 'no_hp' => '082226352912', 'password' => bcrypt('password')],
            ['nuptk' => '1415415', 'nama' => 'Fahri', 'jabatan' => 'guru honorer', 'no_hp' => '0822263529118', 'password' => bcrypt('password')]
        ]);

        DB::table('dinas')->insert([
            ['nuptk' => '12345', 'tipe_dinas' => 'Dinas Luar Full', 'alamat_dinas' => 'Serpong Tangerang Selatan', 'tgl_mulai' => '2024-06-08', 'tgl_selesai' => '2024-06-27', 'waktu_mulai' => '06:33:00', 'waktu_selesai' => '15:33:00', 'keterangan' => 'dinas', 'status_approved' => '1'],
            ['nuptk' => '12345', 'tipe_dinas' => 'Masuk Kerja, Dinas Luar', 'alamat_dinas' => 'Serpong Tangerang Selatan', 'tgl_mulai' => '2024-06-20', 'tgl_selesai' => '2024-07-04', 'waktu_mulai' => '08:50:00', 'waktu_selesai' => '19:49:00', 'keterangan' => 'dsada', 'status_approved' => '1']
        ]);

        DB::table('izins')->insert([
            ['nuptk' => '12345', 'tgl_izin' => '2024-06-07', 'status' => 'i', 'keterangan' => 'Sakit', 'status_approved' => '1'],
            ['nuptk' => '12345', 'tgl_izin' => '2024-06-12', 'status' => 'i', 'keterangan' => 'dadsad', 'status_approved' => '2']
        ]);

        DB::table('presensis')->insert([
            ['nuptk_absen' => '12345', 'tgl_presensi' => '2024-06-07', 'hari' => 'Jumat', 'jam_masuk' => '09:50:50', 'jam_pulang' => '00:51:02', 'foto_masuk' => '12345-2024-06-07-masuk.png', 'foto_pulang' => '12345-2024-06-07-pulang.png', 'lokasi_masuk' => '-6.18243,106.58866', 'lokasi_pulang' => '-6.18243,106.58866']
        ]);

        DB::table('users')->insert([
            ['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('password')],
            ['name' => 'admin2', 'email' => 'admin2@gmail.com', 'password' => bcrypt('password')]
        ]);
    }
}
