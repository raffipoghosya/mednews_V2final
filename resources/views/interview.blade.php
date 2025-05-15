<!DOCTYPE html>
<html lang="hy">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MedNews</title>
    <link rel="stylesheet" href="{{ asset('css/interw.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

    @include('components.header')

    <div class="container">
        <!-- Left Column: News -->
        <div class="news-column">
            <h1 class="news-heading"><a href="#">Հարցազրույցներ</a></h1>

            <div class="news-group-card">
                @foreach($interviews as $news)
                    <div class="news-card">
                        <img src="{{ asset('images/posts/' . ($news->img ?? 'default.jpg')) }}" alt="{{ $news->title }}"
                            onerror="this.onerror=null;this.src='{{ asset('images/posts/default.jpg') }}';" />
                        <div class="news-content">
                            <h3>
                                <a href="/single/{{ $news->id }}">{{ $news->title }}</a>
                            </h3>
                            <p>{{ Str::limit(strip_tags($news->description), 100) }}</p>
                            <span class="news-date">{{ \Carbon\Carbon::parse($news->date)->format('d.m.y') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                {{ $interviews->links('vendor.pagination.custom') }}
            </div>
        </div>

        <!-- Vertical Separator Line -->
        <div class="separator-line"></div>

        <!-- Right Column: Videos and Ads -->
        <div class="ads-column">
            <h2 class="section-title">ՏԵՍԱՆՅՈՒԹԵՐ</h2>
            <div class="slider-wrapper">
                <div class="slider-track">
                    @foreach($video as $vid)
                        <div class="video-card">
                            <div class="video-thumb">
                                <img src="{{ asset('images/videos/' . $vid->img) }}" alt="Video" />
                                <div class="play-button">&#9658;</div>
                            </div>
                            <p>{{ $vid->title }} / {{ $vid->author }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="ad-items">
            @foreach($reclambanners as $banner)
                <div class="ad-item">
                    <a href="{{ $banner->href ?? '#' }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('images/reclam/' . $banner->img) }}" alt="Ad {{ $loop->iteration }}" />
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>

</body>

</html>
