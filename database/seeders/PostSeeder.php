<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kagawad = Author::where('email', 'kagawad.perez@bulletin.test')->firstOrFail();

        Post::create([
            'author_id' => $kagawad->id,
            'title' => 'Purok Perez Clean-up Drive',
            'category' => 'Announcement',
            'body' => 'Join us this Saturday for the Purok Perez clean-up drive. Bring gloves and sacks. Meet at the Matina Crossing Hall at 6:00 AM.',
            'is_published' => true,
            'is_pinned' => true,
            'published_at' => '2026-09-04 08:00:00', // my birthday in 2026
        ]);

        $authors = Author::all();

        Post::factory()->count(40)
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();
        
        Post::factory()->count(10)->draft()
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();
    }
}
