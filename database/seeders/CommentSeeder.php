<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $lola = User::where('email', 'lola.amparo@bulletin.test')->firstOrFail();
        $pinnedPost = Post::where('title', 'Purok Amparo Clean-up Drive')->firstOrFail();

        Post::where('is_published', true)
            ->whereKeyNot($pinnedPost->id)
            ->each(function (Post $post) use ($users): void {
                Comment::factory(random_int(0, 5))
                    ->make()
                    ->each(function (Comment $comment) use ($post, $users): void {
                        $comment->user_id = $users->random()->id;
                        $post->comments()->save($comment);
                    });
            });

        Comment::factory(3)->make()->each(
            function (Comment $comment, int $index) use ($pinnedPost, $users, $lola): void {
                $comment->user_id = $index === 0 ? $lola->id : $users->random()->id;
                $pinnedPost->comments()->save($comment);
            }
        );
    }
}
