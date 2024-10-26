<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	// $data =[
    	// 	['color_name'=>'Red','color_slug'=>'red'],
    	// 	['color_name'=>'Green','color_slug'=>'green'],
    	// 	['color_name'=>'Blue','color_slug'=>'blue'],
    	// 	['color_name'=>'Yellow','color_slug'=>'yellow'],
    	// 	['color_name'=>'White','color_slug'=>'white'],
    	// 	['color_name'=>'Gray','color_slug'=>'gray'],
    	// 	['color_name'=>'Ash','color_slug'=>'ash'],
    	// ];

    	// foreach($data as $info){
    	// 	Color::create($info);
    	// }
    	 \App\Models\Color::factory()->count(500)->create();
      
    }
}
