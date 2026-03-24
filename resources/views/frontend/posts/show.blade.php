<x-frontend.shell
    title="{{ $post->title }}"
    meta-description="{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->body), 150) }}">
    <section class="single-post-area section_padding_100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="single-post-content">
                        <div class="gazette-post-tag">
                            @foreach($post->categories as $category)
                                <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                        <h2 class="font-pt mb-4">{{ $post->title }}</h2>
                        <p class="gazette-post-date mb-4">
                            Door {{ $post->user->name }} | {{ optional($post->published_at)->format('F d, Y') }}
                        </p>

                        @if($post->media)
                            <div class="blog-post-thumbnail my-4">
                                <img src="{{ $post->media->url() }}" alt="{{ $post->title }}" class="img-fluid">
                            </div>
                        @endif

                        <div class="post-body">
                            {!! nl2br(e($post->body)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend.shell>
