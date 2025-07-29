<?php

namespace Database\Seeders;

use App\Models\Kue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Kue::insert([
            ['nama' => 'Bolu Coklat',        'kategori_id' => 3, 'satuan_id' => 3, 'harga' => 25000, 'stok' => 10, 'foto' => 'upload/produk/default.jpg'],
            ['nama' => 'Kue Kering Kacang',  'kategori_id' => 4, 'satuan_id' => 3, 'harga' => 20000, 'stok' => 15, 'foto' => 'upload/produk/default.jpg'],
            ['nama' => 'Kue Basah Pandan',   'kategori_id' => 5, 'satuan_id' => 3, 'harga' => 15000, 'stok' => 8,  'foto' => 'upload/produk/default.jpg'],
            ['nama' => 'Tart Stroberi',      'kategori_id' => 6, 'satuan_id' => 3, 'harga' => 45000, 'stok' => 5,  'foto' => 'upload/produk/default.jpg'],
            ['nama' => 'Lemper',             'kategori_id' => 7, 'satuan_id' => 5, 'harga' => 10000, 'stok' => 12, 'foto' => 'upload/produk/default.jpg'],
            ['nama' => 'Salad Buah',         'kategori_id' => 1, 'satuan_id' => 5, 'harga' => 18000, 'stok' => 10, 'foto' => 'upload/produk/default.jpg'],
            ['nama' => 'Jus Jeruk',          'kategori_id' => 1, 'satuan_id' => 1, 'harga' => 12000, 'stok' => 20, 'foto' => 'upload/produk/default.jpg'],
            ['nama' => 'Bolu Kukus',         'kategori_id' => 3, 'satuan_id' => 3, 'harga' => 22000, 'stok' => 6,  'foto' => 'upload/produk/default.jpg'],
            ['nama' => 'Kue Kering Keju',    'kategori_id' => 4, 'satuan_id' => 3, 'harga' => 23000, 'stok' => 7,  'foto' => 'upload/produk/default.jpg'],
            ['nama' => 'Lapis Legit',        'kategori_id' => 5, 'satuan_id' => 3, 'harga' => 30000, 'stok' => 3,  'foto' => 'upload/produk/default.jpg'],
            ['nama' => 'Tart Coklat',        'kategori_id' => 1, 'satuan_id' => 3, 'harga' => 47000, 'stok' => 4,  'foto' => 'upload/produk/default.jpg'],
            ['nama' => 'Klepon',             'kategori_id' => 1, 'satuan_id' => 5, 'harga' => 8000,  'stok' => 20, 'foto' => 'upload/produk/default.jpg'],
            ['nama' => 'Snack Sehat',        'kategori_id' => 1, 'satuan_id' => 3, 'harga' => 15000, 'stok' => 10, 'foto' => 'upload/produk/default.jpg'],
            ['nama' => 'Es Teh Manis',       'kategori_id' => 1, 'satuan_id' => 1, 'harga' => 7000,  'stok' => 30, 'foto' => 'upload/produk/default.jpg'], 
]);
    }
}
