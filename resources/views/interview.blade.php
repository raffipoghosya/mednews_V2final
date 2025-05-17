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
                        @php
                            // iframe-ի src-ը դուրս բերենք նույն կերպ՝ regex-ով, եթե ունես iframe դաշտ կամ վիդեոյի հղում
                            // Եթե $vid->iframe չկա, կարող ես ուղղակի հղում պահել $vid->video_url դաշտում
                            preg_match('/src="([^"]+)"/', $vid->iframe ?? '', $matches);
                            $videoSrc = $matches[1] ?? ($vid->video_url ?? '');
                        @endphp

                        <div class="video-card" data-video="{{ $videoSrc }}">
                            <div class="video-thumb" style="cursor: pointer;">
                                <img src="{{ asset('images/videos/' . ($vid->img ?? 'default.jpg')) }}"
                                    alt="{{ $vid->title }}" />
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


    <!-- Video modal -->
    <div id="videoModal"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); justify-content:center; align-items:center; z-index:9999;">
        <div style="position:relative; width:80%; max-width:900px;">
            <button id="closeModal"
                style="position:absolute; top:-30px; right:0; font-size:30px; color:white; background:none; border:none; cursor:pointer;">&times;</button>
            <iframe id="videoFrame" width="100%" height="450" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('videoModal');
            const iframe = document.getElementById('videoFrame');
            const closeModalBtn = document.getElementById('closeModal');

            document.querySelectorAll('.video-card').forEach(card => {
                card.addEventListener('click', () => {
                    const videoUrl = card.getAttribute('data-video');
                    if (!videoUrl) {
                        alert('Չհաջողվեց գտնել վիդեոյի հղումը։');
                        return;
                    }
                    iframe.src = videoUrl + '?autoplay=1&rel=0';
                    modal.style.display = 'flex';
                });
            });

            closeModalBtn.addEventListener('click', () => {
                iframe.src = '';  // դադարեցնել նվագարկումը
                modal.style.display = 'none';
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    iframe.src = '';
                    modal.style.display = 'none';
                }
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>

</body>

</html>