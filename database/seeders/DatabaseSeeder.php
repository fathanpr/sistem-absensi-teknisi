<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Atm;
use App\Models\User;
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
        \App\Models\User::factory(5)->create();

        // User::create([
        //     'nip_teknisi' => '1928346547',
        //     'nama_lengkap' => 'Gilang Maulana',
        //     'no_telp' => '089545345495',
        //     'email' => 'gilang14@gmail.com',
        //     'password' => '12345678'
        // ]);

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
