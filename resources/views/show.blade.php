<!DOCTYPE html>
<html lang="hy">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>

<body style="display: flex; flex-direction: column; min-height: 100vh;">

    @include('components.header')

    <section class="news-section">
        <div class="news-container">

            <!-- Left Column: News Content -->
            <div class="news-column">
                <div class="news-image-and-title">
                    <img src="{{ asset('images/posts/' . ($post->img ?? 'default.jpg')) }}" 
                         alt="{{ $post->title }}"
                         class="news-img"
                         onerror="this.onerror=null;this.src='{{ asset('images/posts/default.jpg') }}';">
                    <div class="news-heading">
                        <h1>{{ $post->title }}</h1>
                    </div>
                </div>
                <div class="news-content">
                    {!! cleanHtml($post->description ?? '') !!}
                </div>
            </div>

            <!-- Right Column: Ads -->
            <div class="ads-column">
                <div class="ad-item">
                    <img src="{{ asset('images/reclam/reklam1.png') }}" alt="Ad 1">
                </div>
                <div class="ad-item">
                    <img src="{{ asset('images/reclam/reklam2.png') }}" alt="Ad 2">
                </div>
            </div>

        </div>
    </section>

    @include('components.footer')

</body>

</html>
