@extends('backend.layouts.main')
@section('title')
    {{ __('lang.update') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.tags.index') }}">Tag</a></li>
                <li class="breadcrumb-item active">{{ $tag->name }}</li>
                <li class="breadcrumb-item active">Tahrirlash</li>
            </ol>
        </nav>
    </div>
    <form action="{{ route('backend.tags.update', $tag->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mt-1">
                            <label for="tagsable_type" class="form-label">Tagsable Type</label>
                            <select class="form-select" name="tagsable_type" id="tagsable_type" required="">
                                <option selected="" disabled="" value="">---------</option>
                                <option value="">All</option>
                                <option value="App\Models\Content\News" {{ $tag->tagsable_type == 'App\Models\Content\News' ? 'selected' : '' }}>News</option>
                                <option value="App\Models\Content\Post" {{ $tag->tagsable_type == 'App\Models\Content\Post' ? 'selected' : '' }}>Post</option>
                                <option value="App\Models\Content\Image" {{ $tag->tagsable_type == 'App\Models\Content\Image' ? 'selected' : '' }}>Image</option>
                                <option value="App\Models\Content\Page" {{ $tag->tagsable_type == 'AApp\Models\Content\Page' ? 'selected' : '' }}>Page</option>
                                <option value="App\Models\Content\Video" {{ $tag->tagsable_type == 'App\Models\Content\Video' ? 'selected' : '' }}>Video</option>
                            </select>
                            <span class="error-data">
                                @error('tagsable_type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name_uz" class="form-label">Name uz</label>
                            <input type="text" name="name[uz]" id="name_uz"
                                class="form-control @error('name.uz') error-data-input @enderror"
                                value="{{ $tag->getTranslation('name', 'uz'), old('name.uz') }}" required>
                            <span class="error-data">
                                @error('name.uz')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name_ru" class="form-label">Name ru</label>
                            <input type="text" name="name[ru]" id="name_ru"
                                class="form-control @error('name.ru') error-data-input @enderror"
                                {{-- value="{{ $tag->getTranslation('name', 'ru'), old('name.ru') }}" --}}
                                value="{{ $tag->hasTranslation('name', 'ru') ? $tag->getTranslation('name', 'ru') : '', old('name.ru') }}"
                                >
                            <span class="error-data">
                                @error('name.ru')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name_en" class="form-label">Name en</label>
                            <input type="text" name="name[en]" id="name_en"
                                class="form-control @error('name.en') error-data-input @enderror"
                                {{-- value="{{ $tag->getTranslation('name', 'en'), old('name.en') }}" --}}
                                value="{{ $tag->hasTranslation('name', 'en') ? $tag->getTranslation('name', 'en') : '', old('name.en') }}"
                                >
                            <span class="error-data">
                                @error('name.en')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
                </div>
            </div>
        </div>

    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(e) {

        });
    </script>
@endsection
