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
        $q = request('q');

        $posts = Post::query()
            ->with(['user', 'categories', 'media'])
            ->where('is_published', true)
            ->search((string) $q)
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('frontend.posts.index', [
            'posts' => $posts,
            'q' => $q,
        ]);
    }

    public function show(Post $post): View
    {
        if (!$post->is_published) {
            abort(404);
        }

        $post->load(['user', 'categories', 'media']);

        $categories = \App\Models\Category::query()
            ->withCount(['posts' => function ($query) {
                $query->where('is_published', true)
                    ->whereNotNull('published_at');
            }])
            ->having('posts_count', '>', 0)
            ->orderByDesc('posts_count')
            ->take(10)
            ->get();

        return view('frontend.posts.show', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }
}
