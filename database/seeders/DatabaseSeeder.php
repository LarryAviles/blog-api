<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $userTest = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $authorTest = User::factory()->create([
            'name' => 'Test Author',
            'email' => 'author@example.com',
        ]);

        for($i = 1; $i <= 3; $i++) {
            $post = Post::factory()->create([
                'user_id' => $authorTest->id
            ]);

            for($a = 1; $a <= 3; $a++) {
                Comment::factory()->create([
                    'user_id' => $userTest->id,
                    'post_id' => $post->id
                ]);
            }
        }

    }
}
