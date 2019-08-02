<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Post::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 25; $i++) {
            Post::create([
                'description' => $faker->sentence,
                'left_image' => $faker->imageUrl(),
                'right_image' => $faker->imageUrl(),
                'user_id' => 1,
            ]);
        }
    }
}
