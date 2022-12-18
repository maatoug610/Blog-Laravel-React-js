<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;

use App\Models\Product;
use App\Models\Role;

class AdminUserSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        // Product::create([
        //     'title' => $this->generateRandomString(),
        //     'content' => $this->generateRandomString(),
        //     'description' => $this->generateRandomString(),
        //     'image' => $this->generateRandomString(),
        //     'deleted_by' => $this->generateRandomInteger(),
        //     'created_by' => $this->generateRandomInteger(),
        //     'updated_by' => $this->generateRandomInteger(),

        // ]);

        // Role::create([
        //     'title' => $this->generateRandomString(),
        //     'description' => $this->generateRandomString(),
        //     'isdraft' => $this->generateRandomBoolean(),
        // ]);
    }


        // //Random integer:
        // public function generateRandomInteger($length = 2){
        //     $integer = '0123456789';
        //     $intg_Length = strlen($integer);
        //     $randomInteger = '';
        //     for($i=0;$i<$length;$i++){
        //         $randomInteger = $integer[rand(0,$intg_Length -1)];
        //     }
        //     return $randomInteger;
        // }
        //Random zero one:
        // public function generateRandomBoolean($length = 2){
        //     $boolean = '01';
        //     $length_boolean = strlen($boolean);
        //     $randomBoolean = '';
        //     for($i=0;$i<$length;$i++){
        //         $randomBoolean = $boolean[rand(0, $length_boolean -1)];
        //     }
        //     return $randomBoolean;
        // }


}
