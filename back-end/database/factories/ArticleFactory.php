<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => app()->make('generateString'),
            'content' => app()->make('generateString'),
            'description' => app()->make('generateString'),
            'image' => app()->make('generateString'),
            'isdraft' => app()->make('generateBool'),
            'ischecked' => app()->make('generateBool'),
            'read_number' => app()->make('generateInteger'),
            // 'last_read_at' => now(),
            'deleted_by' => app()->make('generateInteger'),
            'created_by' => app()->make('generateInteger'),
            'updated_by' => app()->make('generateInteger'),
        ];
    }
}
