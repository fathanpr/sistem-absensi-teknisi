<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Atm;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();

        // User::create([
        //     'nip_teknisi' => '1928346547',
        //     'nama_lengkap' => 'Gilang Maulana',
        //     'no_telp' => '089545345495',
        //     'email' => 'gilang14@gmail.com',
        //     'password' => '12345678'
        // ]);

        $this->call(RoleSeeder::class);

        User::create([
            'role_id' => 1,
            'nip_teknisi' => '1201070075',
            'nama_lengkap' => 'Gilang Maulana',
            'no_telp' => '08945534425',
            'email' => 'gilang@gmail.com',
            'password' => '$2y$10$m4Gbn8/W19WoubWkh.BNrOdteSVaB2i4e.imSTx9ikoQ7gw5r9dQW',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        User::create([
            'role_id' => 1,
            'nip_teknisi' => '1201070076',
            'nama_lengkap' => 'Fathan Pebrilistyo',
            'no_telp' => '085573425289',
            'email' => 'fathanpr@gmail.com',
            'password' => '$2y$10$m4Gbn8/W19WoubWkh.BNrOdteSVaB2i4e.imSTx9ikoQ7gw5r9dQW',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        User::create([
            'role_id' => 2,
            'nip_teknisi' => '2201070077',
            'nama_lengkap' => 'Ilhan Firaldi',
            'no_telp' => '089987342439',
            'email' => 'ilhan@gmail.com',
            'password' => '$2y$10$m4Gbn8/W19WoubWkh.BNrOdteSVaB2i4e.imSTx9ikoQ7gw5r9dQW',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        User::create([
            'role_id' => 2,
            'nip_teknisi' => '2201070078',
            'nama_lengkap' => 'Darmawan Riski',
            'no_telp' => '089288573685',
            'email' => 'darmawan@gmail.com',
            'password' => '$2y$10$m4Gbn8/W19WoubWkh.BNrOdteSVaB2i4e.imSTx9ikoQ7gw5r9dQW',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Atm::create([
            
            'nama_atm' => 'ATM Galuh Mas',
            'alamat_atm' => 'Jl. Galuh Mas Raya, Sukaharja, Telukjambe Timur, Karawang, Jawa Barat 41361',
            'kode_mesin' => '10751330994'
        ]);

        Atm::create(
            [
                'nama_atm' => 'ATM Johar',
                'alamat_atm' => 'Jl. Syech Quro No. 2 Johar Tengah Wetan, Adiarsa Tim., Kec. Karawang Tim., Karawang, Jawa Barat 41314',
                'kode_mesin' => '13461550794'
            ]
        );

        Atm::create([
            'nama_atm' => 'ATM Nagasari',
            'alamat_atm' => 'Jl. Tuparev No.429, Nagasari, Kec. Karawang Bar., Karawang, Jawa Barat 41314',
            'kode_mesin' => '19954126344'
        ]);
    }
}
