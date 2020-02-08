<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category=[
            'Deportes','Nacionales',
            'Internacionales','Entretenimiento','Sucesos','Regionales','Salud'
        
        ];
        foreach ($category as $key => $value) {
            DB::table('categorys')->insert([
                'name'=> $value,
                'created_at'=>carbon::now()->format('y-m-d H:i:s')

            ]);
        }
    }
}
