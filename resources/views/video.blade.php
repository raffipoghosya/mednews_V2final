<!DOCTYPE html>
<html lang="hy">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MedNews</title>
    <link rel="stylesheet" href="{{ asset('css/video1.css') }}" />
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

    <div class="container-fluid">

        <!-- Video Gallery Section (slider) -->
    <h2 class="section-title">ՏԵՍԱԴԱՐԱՆ</h2>
    <div class="video-container">
        @for ($i = 0; $i < 20; $i++)
            @php 
                $vid = $video[$i % count($video)]; 
                // iframe-ից կամ video_url-ից վիդեո src-ը հանում ենք
                preg_match('/src="([^"]+)"/', $vid->iframe ?? '', $matches);
                $videoSrc = $matches[1] ?? ($vid->video_url ?? '');
            @endphp
            <div class="video-card" data-video="{{ $videoSrc }}" data-title="{{ $vid->title }}" style="cursor: pointer;">
                <div class="video-thumb">
                    <img src="{{ asset('images/videos/' . $vid->img) }}" alt="Video" />
                    <img src="{{ asset('style/play_button.svg') }}" alt="Play Button" class="play-button">
                </div>
                <p>{{ $vid->title }} / {{ $vid->author }}</p>
            </div>
        @endfor
    </div>



        <!-- Shorts Section -->
        <section class="video-short-section">
            <h2 class="section-title">SHORTS</h2>
            <div class="video-short-container">
                @foreach($shorts as $short)
                    @php
                        preg_match('/src="([^"]+)"/', $short->iframe ?? '', $matches);
                        $shortVideoSrc = $matches[1] ?? ($short->video_url ?? '');
                    @endphp

                    <div class="video-card-short" data-video="{{ $shortVideoSrc }}" data-title="{{ $short->title }}" style="cursor: pointer;">
                        <div class="video-thumb">
                            <img src="{{ asset('images/videos/' . ($short->img ?? 'default.jpg')) }}" alt="{{ $short->title }}" />
                             <img src="{{ asset('style/play_button.svg') }}" alt="Play Button" class="play-button">
                        </div>
                        <p>{{ $short->title }} / {{ $short->author }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if ($shorts instanceof \Illuminate\Pagination\LengthAwarePaginator && $shorts->hasPages())
                <ul class="pagination pagination-centered">
                    {{-- Previous Page Link --}}
                    @if ($shorts->onFirstPage())
                        <li class="disabled"><span><img src="{{ asset('style/paginationLeft.svg') }}" alt="Arrow"></span></li>
                    @else
                        <li><a href="{{ $shorts->previousPageUrl() }}" rel="prev"><img src="{{ asset('style/paginationLeftDisabled.svg') }}" alt="Arrow"></a></li>
                    @endif

                    @php
                        $total = $shorts->lastPage();
                        $current = $shorts->currentPage();
                        $start = max($current - 1, 1);
                        $end = min($current + 3, $total);
                    @endphp

                    @if ($start > 1)
                        <li><a href="{{ $shorts->url(1) }}">1</a></li>
                        @if ($start > 2)
                            <li class="disabled"><span>...</span></li>
                        @endif
                    @endif

                    @for ($i = $start; $i <= $end; $i++)
                        @if ($i == $current)
                            <li class="active"><span>{{ $i }}</span></li>
                        @else
                            <li><a href="{{ $shorts->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endfor

                    @if ($end < $total)
                        @if ($end < $total - 1)
                            <li class="disabled"><span style = 'color: #274F73;'>...</span></li>
                        @endif
                        <li><a href="{{ $shorts->url($total) }}">{{ $total }}</a></li>
                    @endif

                    @if ($shorts->hasMorePages())
                        <li><a href="{{ $shorts->nextPageUrl() }}" rel="next"><img src="{{ asset('style/paginationRight.svg') }}" alt="Arrow"></a></li>
                    @else
                        <li class="disabled"><span><img src="{{ asset('style/paginationRightDisabled.svg') }}" alt="Arrow"></span></li>
                    @endif
                </ul>
            @endif
        </section>

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
                const title = card.getAttribute("data-title") || "Տեսանյութ";

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
