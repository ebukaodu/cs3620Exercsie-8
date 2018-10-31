<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $item = new \App\Item([
            'name'   => 'TicWatch Pro Bluetooth Smart Watch',
            'detail' => 'Layered Display, NFC Payment, Google Assistant, Wear OS by Google (Formerly Android Wear),Compatible with iPhone and Android (Black)',
            'price' => '$252.45'
        ]);
        $item->save();

        $item = new \App\Item([
            'name'   => 'Asus 14" Intel Celeron, 4GB, 32GB, Windows 10 Laptop (R420SA-RS01-BL / R420SARS01BL)',
            'detail' => 'This ASUS 14" laptop is lightweight, stylish and is a perfect choice as a travel laptop or portable workstation. ',
            'price' => '$250'
        ]);
        $item->save();
    }

}
