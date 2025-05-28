<!DOCTYPE html>
<html lang="hy">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MedNews</title>
    <link rel="stylesheet" href="{{ asset('css/interw.css') }}" />
</head>
 <!-- Video Modal -->
    <div id="videoModal" class="custom-modal">
    <div class="custom-modal-content">
        <button class="custom-modal-close" id="closeModalBtn">
             <img src="{{ asset('style/closeIcon.svg') }}" alt="closeIcon" />
        </button>
        
        <div class="custom-modal-body">
        <div class="video-wrapper">
            <iframe id="videoFrame" src="" allowfullscreen allow="autoplay"></iframe>
        </div>
        </div>
    <p class="custom-modal-title" id="videoModalLabel">Տեսանյութ</p>

        <img src="{{ asset('style/videoModalLogo.svg') }}" class="videoLogo" alt="Decoration" />
    </div>
    </div>
<body>

    @include('components.header')

    <main>
        <!-- Left Column: News -->
        <div class="news-column">
            <h1 class="news-heading">ՀԱՐՑԱԶՐՈՒՅՑ</h1>

            <div class="news-group-card">
                @foreach($interviews as $news)
                    <div class="news-card">
                        <img src="{{ asset('images/posts/' . ($news->img ?? 'default.jpg')) }}" alt="{{ $news->title }}"
                            onerror="this.onerror=null;this.src='{{ asset('images/posts/default.jpg') }}';" />
                        <div class="news-content">
                            <p class="title">
                                {{ Str::limit(strip_tags($news->title), 50) }}
                            </p>
                            <p class="description">{{ Str::limit(strip_tags($news->description), 350) }}</p>
                            <a class="readMore" href="/single/{{ $news->id }}">
                                <p>Կարդալ ավելին</p>
                            </a>
                            <span class="news-date">{{ \Carbon\Carbon::parse($news->date)->format('d.m.y') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right Column: Videos and Ads -->
        <div class="ads-column">
            <h2 class="section-title">ՏԵՍԱԴԱՐԱՆ</h2>
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
                            <p class="videoTitle">{{ $vid->title }} / {{ $vid->author }}</p>
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
    </main>
    <!-- Pagination  -->
    <div class="pagination-container">
        {{ $interviews->links('vendor.pagination.custom') }}
    </div>
    @include('components.footer')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("videoModal");
            const videoFrame = document.getElementById("videoFrame");
            const closeModalBtn = document.getElementById("closeModalBtn");

            document.querySelectorAll(".video-card, .video-card-short").forEach((card) => {
            card.addEventListener("click", () => {
                const videoSrc = card.getAttribute("data-video");
                const title = card.getAttribute("data-title") || card.querySelector(".videoTitle")?.textContent || "Տեսանյութ";
                document.getElementById("videoModalLabel").innerText = title;
                videoFrame.src = videoSrc + "?autoplay=1&rel=0";
                modal.style.display = "flex";
            });
            });

            closeModalBtn.addEventListener("click", () => {
            modal.style.display = "none";
            videoFrame.src = "";
            });

            // Close modal when clicking outside the content
            modal.addEventListener("click", (e) => {
            if (e.target === modal) {
                modal.style.display = "none";
                videoFrame.src = "";
            }
            });
        });
    </script>

</body>

</html>