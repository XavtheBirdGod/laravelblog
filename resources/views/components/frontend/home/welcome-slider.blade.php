@props([
'featuredPosts' => collect(),
])
<section class="welcome-blog-post-slide owl-carousel">
    @forelse($featuredPosts as $post)
        <div class="single-blog-post-slide bg-img background-overlay-5"
             style="background-image: url('{{ $post->media ?
$post->media->url() : asset('frontend/gazette/img/blog-img/1.jpg') }}');">
            <div class="single-blog-post-content">
                <div class="tags">
                    @foreach($post->categories->take(2) as $category)
                        <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
                <h3>
                    <a href="{{ route('posts.show', $post) }}" class="font-pt">{{ $post->title }}</a>
                </h3>
                <div class="date">
                    <span>{{ optional($post->published_at)->format('M, d, Y') }}</span>
                </div>
            </div>
        </div>
    @empty
        <div class="single-blog-post-slide bg-img background-overlay-5"
             style="background-image:url('{{ asset('frontend/gazette/img/blog-img/1.jpg') }}');">
            <div class="single-blog-post-content">
                <div class="tags">
                    <span>Frontend</span>
                </div>
                <h3>
                    <span>Nog geen gepubliceerde posts beschikbaar</span>
                </h3>
                <div class="date">
                    <span>{{ now()->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
    @endforelse
</section>
