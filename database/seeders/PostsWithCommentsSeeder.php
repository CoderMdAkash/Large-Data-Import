<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Faker\Factory as Faker;
use Exception;

class PostsWithCommentsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $postChunks = 1000;
        $commentBatchSize = 500; 
        $postCount = 5000000; // total post

        try {
            DB::transaction(function () use ($faker, $postChunks, $commentBatchSize, $postCount) {
                collect(range(1, $postCount))
                    ->chunk($postChunks)
                    ->each(function ($postChunk) use ($faker, $commentBatchSize) {
                        $postData = [];
                        $commentData = [];

                        foreach ($postChunk as $i) {
                            $postData[] = [
                                'title' => $faker->sentence,
                                'content' => $faker->paragraph,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];

                            $commentsCount = rand(1, 3);
                            for ($j = 0; $j < $commentsCount; $j++) {
                                $commentData[] = [
                                    'post_id' => $i,
                                    'content' => $faker->sentence,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ];

                                if (count($commentData) >= $commentBatchSize) {
                                    DB::table('comments')->insert($commentData);
                                    $commentData = [];
                                }
                            }
                        }

                        DB::table('posts')->insert($postData);

                        if (!empty($commentData)) {
                            DB::table('comments')->insert($commentData);
                        }
                    });
            });

            echo "Data seeded successfully!";

        } catch (Exception $e) {
            Log::error("Data seeding failed: " . $e->getMessage());
            echo "Data seeding failed. Transaction rolled back.";
        }
    }
}
