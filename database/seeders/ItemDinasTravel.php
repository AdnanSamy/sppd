<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ItemDinasTravel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            [
                'item' => 'Kebutuhan Makan',
            ],
            [
                'item' => 'Perlatan Kerja',
            ],
            [
                'item' => 'Ongkos Perjalanan',
            ]
        ];

        foreach ($arr as $item) {
            DB::table('item_dinas_travel')->insert($item);
        };
    }
}
