<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Application::create([
            'title' => $this->generateRandomString(),
            'content' => $this->generateRandomString(),
            'description' => $this->generateRandomString(),
            'image' => $this->generateRandomString(),
            'deleted_by' => $this->generateRandomInteger(),
            'created_by' => $this->generateRandomInteger(),
            'updated_by' => $this->generateRandomInteger(),

        ]);
    }
}
