<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\RW;
use App\Models\RT;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample village
        $desa = Desa::create([
            'nama' => 'Desa Maju Jaya',
            'alamat' => 'Jl. Raya Desa No. 123, Kecamatan Maju, Kabupaten Jaya, Provinsi Maju',
            'kode_pos' => '12345',
            'telepon' => '0274-123456',
            'email' => 'info@desamajujaya.id',
            'paket_langganan' => 'premium',
            'max_users' => 100,
            'max_letters' => 5000,
            'max_storage' => 5368709120, // 5GB
            'is_active' => true,
            'subscription_expires_at' => now()->addYear(),
        ]);

        // Create users
        $superAdmin = User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@villagehub.id',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        $villageHead = User::create([
            'desa_id' => $desa->id,
            'name' => 'Pak Lurah',
            'email' => 'lurah@desamajujaya.id',
            'password' => bcrypt('password'),
            'role' => 'village_head',
            'phone' => '081234567890',
            'address' => 'Jl. Kantor Desa No. 1',
            'is_active' => true,
        ]);

        $villageAdmin = User::create([
            'desa_id' => $desa->id,
            'name' => 'Admin Desa',
            'email' => 'admin@desamajujaya.id',
            'password' => bcrypt('password'),
            'role' => 'village_admin',
            'phone' => '081234567891',
            'address' => 'Jl. Kantor Desa No. 2',
            'is_active' => true,
        ]);

        // Create RWs
        $rw1 = RW::create([
            'desa_id' => $desa->id,
            'nomor_rw' => '01',
            'nama_rw' => 'Dusun Mawar',
            'alamat' => 'Dusun Mawar, RT 01-03',
        ]);

        $rw2 = RW::create([
            'desa_id' => $desa->id,
            'nomor_rw' => '02',
            'nama_rw' => 'Dusun Melati',
            'alamat' => 'Dusun Melati, RT 04-06',
        ]);

        // Create RW chairmen
        $rwChairman1 = User::create([
            'desa_id' => $desa->id,
            'name' => 'Pak RT 01',
            'email' => 'rw01@desamajujaya.id',
            'password' => bcrypt('password'),
            'role' => 'rw_chairman',
            'phone' => '081234567892',
            'address' => 'Dusun Mawar',
            'is_active' => true,
        ]);

        $rwChairman2 = User::create([
            'desa_id' => $desa->id,
            'name' => 'Pak RW 02',
            'email' => 'rw02@desamajujaya.id',
            'password' => bcrypt('password'),
            'role' => 'rw_chairman',
            'phone' => '081234567893',
            'address' => 'Dusun Melati',
            'is_active' => true,
        ]);

        // Update RW with chairmen
        $rw1->update(['ketua_rw_id' => $rwChairman1->id]);
        $rw2->update(['ketua_rw_id' => $rwChairman2->id]);

        // Create RTs for RW 1
        $rt1 = RT::create([
            'rw_id' => $rw1->id,
            'nomor_rt' => '01',
            'nama_rt' => 'RT 01 Mawar',
            'alamat' => 'Dusun Mawar RT 01',
        ]);

        $rt2 = RT::create([
            'rw_id' => $rw1->id,
            'nomor_rt' => '02',
            'nama_rt' => 'RT 02 Mawar',
            'alamat' => 'Dusun Mawar RT 02',
        ]);

        $rt3 = RT::create([
            'rw_id' => $rw1->id,
            'nomor_rt' => '03',
            'nama_rt' => 'RT 03 Mawar',
            'alamat' => 'Dusun Mawar RT 03',
        ]);

        // Create RTs for RW 2
        $rt4 = RT::create([
            'rw_id' => $rw2->id,
            'nomor_rt' => '04',
            'nama_rt' => 'RT 04 Melati',
            'alamat' => 'Dusun Melati RT 04',
        ]);

        $rt5 = RT::create([
            'rw_id' => $rw2->id,
            'nomor_rt' => '05',
            'nama_rt' => 'RT 05 Melati',
            'alamat' => 'Dusun Melati RT 05',
        ]);

        $rt6 = RT::create([
            'rw_id' => $rw2->id,
            'nomor_rt' => '06',
            'nama_rt' => 'RT 06 Melati',
            'alamat' => 'Dusun Melati RT 06',
        ]);

        // Create RT chairmen
        $rtChairmen = [];
        foreach ([$rt1, $rt2, $rt3, $rt4, $rt5, $rt6] as $index => $rt) {
            $rtChairman = User::create([
                'desa_id' => $desa->id,
                'rt_id' => $rt->id,
                'name' => 'Pak RT ' . str_pad((string)($index + 1), 2, '0', STR_PAD_LEFT),
                'email' => 'rt' . str_pad((string)($index + 1), 2, '0', STR_PAD_LEFT) . '@desamajujaya.id',
                'password' => bcrypt('password'),
                'role' => 'rt_chairman',
                'phone' => '08123456789' . ($index + 4),
                'address' => $rt->alamat,
                'is_active' => true,
            ]);

            $rt->update(['ketua_rt_id' => $rtChairman->id]);
            $rtChairmen[] = $rtChairman;
        }

        // Create sample citizens
        $rts = [$rt1, $rt2, $rt3, $rt4, $rt5, $rt6];
        $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha'];
        $pekerjaanList = ['Petani', 'Pedagang', 'PNS', 'Swasta', 'Wiraswasta', 'Pensiunan', 'Ibu Rumah Tangga', 'Pelajar'];
        $pendidikanList = ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'];

        foreach ($rts as $rt) {
            // Create 15-25 citizens per RT
            $citizenCount = random_int(15, 25);
            for ($i = 1; $i <= $citizenCount; $i++) {
                $gender = random_int(0, 1) ? 'L' : 'P';
                $firstName = $gender === 'L' 
                    ? ['Ahmad', 'Budi', 'Candra', 'Dedi', 'Eko', 'Fajar', 'Gunawan', 'Hadi', 'Irfan', 'Joko'][random_int(0, 9)]
                    : ['Ani', 'Sari', 'Dewi', 'Eka', 'Fitri', 'Gita', 'Hana', 'Indah', 'Jihan', 'Kiki'][random_int(0, 9)];
                $lastName = ['Wijaya', 'Pratama', 'Sari', 'Putra', 'Utami', 'Handoko', 'Susanti', 'Rahman', 'Lestari', 'Cahyono'][random_int(0, 9)];
                
                $birthYear = random_int(1950, 2010);
                $birthDate = sprintf('%04d-%02d-%02d', $birthYear, random_int(1, 12), random_int(1, 28));

                Warga::create([
                    'desa_id' => $desa->id,
                    'rt_id' => $rt->id,
                    'nama' => $firstName . ' ' . $lastName,
                    'nik' => '3371' . str_pad((string)random_int(1, 999999999999), 12, '0', STR_PAD_LEFT),
                    'alamat' => $rt->alamat . ' No. ' . random_int(1, 50),
                    'tempat_lahir' => ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Medan', 'Semarang'][random_int(0, 5)],
                    'tanggal_lahir' => $birthDate,
                    'jenis_kelamin' => $gender,
                    'agama' => $agamaList[random_int(0, 4)],
                    'pekerjaan' => $pekerjaanList[random_int(0, 7)],
                    'pendidikan' => $pendidikanList[random_int(0, 6)],
                    'status_perkawinan' => ['belum_kawin', 'kawin', 'cerai_hidup', 'cerai_mati'][random_int(0, 3)],
                    'status_keluarga' => ['kepala_keluarga', 'istri', 'anak', 'orang_tua'][random_int(0, 3)],
                    'no_kk' => '3371' . str_pad((string)random_int(1, 999999999999), 12, '0', STR_PAD_LEFT),
                    'telepon' => '0812' . str_pad((string)random_int(10000000, 99999999), 8, '0', STR_PAD_LEFT),
                    'is_active' => true,
                ]);
            }
        }

        // Create some sample citizens as users
        $sampleCitizens = Warga::inRandomOrder()->limit(5)->get();
        foreach ($sampleCitizens as $citizen) {
            User::create([
                'desa_id' => $citizen->desa_id,
                'rt_id' => $citizen->rt_id,
                'name' => $citizen->nama,
                'email' => strtolower(str_replace(' ', '.', $citizen->nama)) . '@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'citizen',
                'phone' => $citizen->telepon,
                'address' => $citizen->alamat,
                'is_active' => true,
            ]);
        }
    }
}