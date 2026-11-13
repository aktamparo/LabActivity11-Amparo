<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = collect(['Purok Amparo', 'Urgent', 'Libre', 'Schedule', 'Announcement'])
            ->mapWithKeys(fn (string $name): array => [$name => Tag::create(['name' => $name])]);

        Post::with('tags')->each(function (Post $post) use ($tags): void {
            $post->tags()->attach(
                $tags->random(random_int(1, 3))->pluck('id')->all()
            );
        });

        Post::where('title', 'Purok Amparo Clean-up Drive')
            ->firstOrFail()
            ->tags()
            ->sync([$tags['Purok Amparo']->id, $tags['Urgent']->id]);
    }
}
