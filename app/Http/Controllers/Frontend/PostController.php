<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->with(['user', 'categories', 'media'])
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(12);

        return view('frontend.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post): View
    {
        if (!$post->is_published) {
            abort(404);
        }

        $post->load(['user', 'categories', 'media']);

        return view('frontend.posts.show', [
            'post' => $post,
        ]);
    }
}
