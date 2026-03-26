<div class="row g-3">

    <div class="col-12 col-md-6">
        <label class="form-label">Title</label>
        <input
            type="text"
            name="title"
            value="{{ old('title', $post?->title ?? '') }}"
            class="form-control @error('title') is-invalid @enderror"
        >

        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Slug</label>
        <input
            type="text"
            name="slug"
            value="{{ old('slug', $post?->slug ?? '') }}"
            class="form-control @error('slug') is-invalid @enderror"
        >

        @error('slug')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="form-text">Leave blank to generate automatically from the title.</div>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Author</label>
        <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
            <option value="">No author</option>

            @foreach($authors as $author)
                <option value="{{ $author->id }}"
                    @selected((string) old('user_id', $post?->user_id ?? '') === (string) $author->id)>
                    {{ $author->name }}
                </option>
            @endforeach
        </select>

        @error('user_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-3 d-flex align-items-center">
        <div class="form-check mt-3">
            <input
                type="hidden"
                name="is_published"
                value="0"
            >
            <input
                type="checkbox"
                name="is_published"
                value="1"
                id="is_published"
                @checked((bool) old('is_published', $post?->is_published ?? false))
                class="form-check-input @error('is_published') is-invalid @enderror"
            >
            <label class="form-check-label" for="is_published">
                Published
            </label>

            @error('is_published')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-md-3 d-flex align-items-center">
        <div class="form-check mt-3">
            <input
                type="hidden"
                name="is_featured"
                value="0"
            >
            <input
                type="checkbox"
                name="is_featured"
                value="1"
                id="is_featured"
                @checked((bool) old('is_featured', $post?->is_featured ?? false))
                class="form-check-input @error('is_featured') is-invalid @enderror"
            >
            <label class="form-check-label" for="is_featured">
                Featured post (on homepage)
            </label>

            @error('is_featured')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-md-3">
        <label class="form-label">Published at</label>
        <input
            type="datetime-local"
            name="published_at"
            value="{{ old('published_at', optional($post?->published_at)->format('Y-m-d\TH:i')) }}"
            class="form-control @error('published_at') is-invalid @enderror"
        >

        @error('published_at')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="form-text">Leave blank to use the current moment when publishing.</div>
    </div>

    <div class="col-12">
        <label class="form-label">Excerpt</label>
        <textarea
            name="excerpt"
            rows="3"
            class="form-control @error('excerpt') is-invalid @enderror"
        >{{ old('excerpt', $post?->excerpt ?? '') }}</textarea>

        @error('excerpt')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Body</label>
        <textarea
            name="body"
            rows="10"
            class="form-control @error('body') is-invalid @enderror"
        >{{ old('body', $post?->body ?? '') }}</textarea>

        @error('body')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label d-block">Categories</label>

        @php
            $selectedCategories = old(
                'categories',
                isset($post) && $post
                    ? $post->categories->pluck('id')->map(fn ($id) => (string) $id)->all()
                    : []
            );
        @endphp

        <div class="row g-2">
            @foreach($categories as $category)
                <div class="col-12 col-md-4">
                    <div class="form-check">
                        <input
                            class="form-check-input @error('categories') is-invalid @enderror"
                            type="checkbox"
                            name="categories[]"
                            value="{{ $category->id }}"
                            id="category_{{ $category->id }}"
                            @checked(in_array((string) $category->id, array_map('strval', $selectedCategories), true))
                        >
                        <label class="form-check-label" for="category_{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

        @error('categories')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror

        @error('categories.*')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Featured image</label>
        <input
            type="file"
            name="image"
            class="form-control @error('image') is-invalid @enderror"
            accept=".jpg,.jpeg,.png,.webp"
        >

        @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="form-text">
            Allowed formats: jpg, jpeg, png, webp (max 4MB)
        </div>

        @if($post?->media)
            <div class="mt-3">
                <div class="small text-muted mb-2">
                    Current image
                </div>
                <img
                    src="{{ $post->media->url() }}"
                    class="img-thumbnail"
                    style="max-width:200px;"
                >
            </div>
        @endif
    </div>

    <div class="col-12 d-flex gap-2 mt-2">
        <button class="btn btn-primary" type="submit">
            {{ $submitLabel ?? 'Save' }}
        </button>

        <a class="btn btn-outline-secondary" href="{{ route('backend.posts.index') }}">
            Cancel
        </a>
    </div>

</div>
