<x-frontend.shell
    title="Categorie: {{ $category->name }}"
    meta-description="{{ $category->description ?: 'Bekijk alle artikels in de categorie ' . $category->name }}">
    <section class="gazette-category-posts-area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h4 class="font-pt">Categorie: {{ $category->name }}</h4>
                        @if($category->description)
                            <p class="mt-2">{{ $category->description }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($posts as $post)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="gazette-single-catagory-post mb-50">
                            @if($post->media)
                                <div class="single-catagory-post-thumb">
                                    <a href="{{ route('posts.show', $post) }}">
                                        <img src="{{ $post->media->url() }}" alt="{{ $post->title }}">
                                    </a>
                                </div>
                            @endif
                            <div class="single-catagory-post-content mt-3">
                                <div class="gazette-post-tag">
                                    @foreach($post->categories->take(1) as $cat)
                                        <a href="{{ route('categories.show', $cat) }}">{{ $cat->name }}</a>
                                    @endforeach
                                </div>
                                <h5>
                                    <a href="{{ route('posts.show', $post) }}" class="font-pt">{{ $post->title }}</a>
                                </h5>
                                <span class="gazette-post-date">
                                    {{ optional($post->published_at)->format('F d, Y') }}
                                </span>
                                <p>
                                    {{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->body), 110) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p>Geen artikels gevonden in deze categorie.</p>
                    </div>
                @endforelse
            </div>

            <div class="row">
                <div class="col-12">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </section>
</x-frontend.shell>
