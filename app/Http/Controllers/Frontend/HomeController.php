<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredPosts = Post::query()
            ->with(['user', 'categories', 'media'])
            ->where('is_published', true)
            ->where('is_featured', true)
            ->latest('published_at')
            ->take(4)
            ->get();

        if ($featuredPosts->count() < 4) {
            $excludeIds = $featuredPosts->pluck('id');
            $extraPosts = Post::query()
                ->with(['user', 'categories', 'media'])
                ->where('is_published', true)
                ->whereNotIn('id', $excludeIds)
                ->latest('published_at')
                ->take(4 - $featuredPosts->count())
                ->get();

            $featuredPosts = $featuredPosts->merge($extraPosts);
        }

        $latestPosts = Post::query()
            ->with(['user', 'categories', 'media'])
            ->where('is_published', true)
            ->whereNotIn('id', $featuredPosts->pluck('id'))
            ->latest('published_at')
            ->take(8)
            ->get();

        $categoryPosts = Post::query()
            ->with(['user', 'categories', 'media'])
            ->where('is_published', true)
            ->latest('published_at')
            ->skip(4)
            ->take(10)
            ->get();

        $videoPosts = Post::query()
            ->with(['user', 'categories', 'media'])
            ->where('is_published', true)
            ->latest('published_at')
            ->skip(14)
            ->take(8)
            ->get();

        $categories = Category::query()
            ->withCount(['posts' => function ($query) {
                $query->where('is_published', true)
                    ->whereNotNull('published_at');
            }])
            ->having('posts_count', '>', 0)
            ->orderByDesc('posts_count')
            ->take(6)
            ->get();

        return view('frontend.home', [
            'featuredPosts' => $featuredPosts,
            'latestPosts' => $latestPosts,
            'categoryPosts' => $categoryPosts,
            'categories' => $categories,
            'videoPosts' => $videoPosts,
            'editorialPosts' => Post::query()
                ->where('is_published', true)
                ->latest('published_at')
                ->skip(22)
                ->take(4)
                ->get(),
        ]);
    }
}
