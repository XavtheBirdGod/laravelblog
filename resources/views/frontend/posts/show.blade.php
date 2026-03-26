<x-frontend.shell
    title="{{ $post->title }}"
    meta-description="{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->body), 150) }}">

    <section class="single-post-area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9">
                    <div class="gazette-single-post-content">
                        <div class="gazette-post-tag">
                            @foreach($post->categories as $category)
                                <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                            @endforeach
                        </div>

                        <h2 class="font-pt mb-3">{{ $post->title }}</h2>

                        <p class="gazette-post-date mb-5">
                            {{ optional($post->published_at)->format('F d, Y') }} |
                            Door <span class="text-primary">{{ $post->user?->name ?? 'Gast' }}</span>
                        </p>

                        @if($post->media)
                            <div class="blog-post-thumbnail my-5">
                                <img src="{{ $post->media->url() }}" alt="{{ $post->title }}" class="img-fluid w-100 rounded">
                            </div>
                        @endif

                        <div class="post-body font-pt" style="line-height: 1.8; font-size: 1.1rem; color: #333;">
                            {!! nl2br(e($post->body)) !!}
                        </div>

                        <div class="gazette-post-share-area d-flex align-items-center justify-content-between mt-100">
                            <div class="tags-area">
                                @foreach($post->categories as $category)
                                    <a href="{{ route('categories.show', $category) }}" class="badge bg-light text-dark p-2 border me-1">{{ $category->name }}</a>
                                @endforeach
                            </div>
                            <div class="share-area d-flex">
                                <span class="me-3">Share:</span>
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#" class="ms-3"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#" class="ms-3"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <hr>
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-dark mt-4">
                                <i class="fa fa-angle-left me-2"></i> Terug naar overzicht
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="sidebar-area">
                        <div class="breaking-news-widget">
                            <div class="widget-title">
                                <h5>Categorieën</h5>
                            </div>
                            @forelse($categories as $category)
                                <div class="single-breaking-news-widget">
                                    <a href="{{ route('categories.show', $category) }}" class="font-pt">{{ $category->name }}</a>
                                    <span>{{ $category->posts_count }} post(s)</span>
                                </div>
                            @empty
                                <p>Geen categorieën beschikbaar.</p>
                            @endforelse
                        </div>

                        <div class="donnot-miss-widget mt-50">
                            <div class="widget-title">
                                <h5>Advertentie</h5>
                            </div>
                            <div class="single-dont-miss-post-thumb">
                                <img src="{{ asset('frontend/gazette/img/bg-img/add.png') }}" alt="advertentie">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend.shell>
