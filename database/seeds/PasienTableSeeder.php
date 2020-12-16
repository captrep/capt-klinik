<?php

use Illuminate\Database\Seeder;
use App\Pasien;

class PasienTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [            
            ['nama' => 'Pasien satu', 'noktp' => '08212525', 'jenkel' => 'Laki-laki', 'alamat' => 'Jln pamanukan', 'nohp' => '08223144321'],
            ['nama' => 'Pasien dua', 'noktp' => '082397971', 'jenkel' => 'Laki-laki', 'alamat' => 'Jln pamanukan', 'nohp' => '334111'],
            ['nama' => 'Pasien tiga', 'noktp' => '0834535221', 'jenkel' => 'Laki-laki', 'alamat' => 'Jln pamanukan', 'nohp' => '082321'],
        ];
    
        foreach ($data as $d) {
            Pasien::create($d);
        }
    }
}
