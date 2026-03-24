@props([
'latestPosts' => collect(),
])
<div class="latest-news-marquee-area">
    <div class="simple-marquee-container">
        <div class="marquee">
            <ul class="marquee-content-items">
                @forelse($latestPosts->take(6) as $post)
                    <li>
                        <a href="{{ route('posts.show', $post) }}">
<span class="latest-news-time">
{{ optional($post->published_at)->format('H:i') }}
</span>
                            {{ $post->title }}
                        </a>
                    </li>
                @empty
                    <li>
                        <span>
                            <span class="latest-newstime">{{ now()->format('H:i') }}</span>
                            Nog geen recente artikels beschikbaar.
                        </span>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
