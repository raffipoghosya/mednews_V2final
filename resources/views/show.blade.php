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
                <div class='information'>
                    <div class="news-image-and-title">
                        <img src="{{ asset('images/posts/' . ($post->img ?? 'default.jpg')) }}"
                            alt="{{ $post->title }}" class="news-img"
                            onerror="this.onerror=null;this.src='{{ asset('images/posts/default.jpg') }}';">
                        <div class="news-heading">
                            <h1>{{ $post->title }}</h1>
                        </div>
                    </div>

                    @php
                        $html = cleanHtml($post->description ?? '');

                        preg_match_all('/<img[^>]+src="([^">]+)"/i', $html, $imgMatches);
                        $imageUrls = $imgMatches[1] ?? [];

                         /* ------   examppleeeeee
                        array_push($imageUrls, 'https://letsenhance.io/static/73136da51c245e80edc6ccfe44888a99/1015f/MainBefore.jpg');
                        array_push($imageUrls, 'https://letsenhance.io/static/73136da51c245e80edc6ccfe44888a99/1015f/MainBefore.jpg');
                        ------ */

                        $htmlWithoutMedia = preg_replace('/<img[^>]*>/i', '', $html);

                        preg_match_all('/https?:\/\/[^\s"]+\.(mp4|webm|mov)/i', $html, $videoMatches);
                        $videoUrls = $videoMatches[0] ?? [];
                    /* ------   examppleeeeee
                        array_push($videoUrls, 'https://www.youtube.com/watch?v=27EP04T824Y&t=1512s');
                        ------ */
                        foreach ($videoUrls as $vid) {
                            $htmlWithoutMedia = str_replace($vid, '', $htmlWithoutMedia);
                        }

                    @endphp

                    <div class="news-content">
                        {!! $htmlWithoutMedia !!}
                    </div>
                    <p class="postDate">{{$post -> date}}</p>
                </div>

                    @if (!empty($imageUrls) || !empty($videoUrls))
                    <div class="media-gallery-wrapper">
                <button class="media-scroll-arrow left" onclick="scrollMediaGallery(-1)">
                    <img src="{{ asset('style/scrollRight.svg') }}" alt="Scroll Left" style="transform: rotate(180deg);" />
                </button>

                <div class="media-gallery" id="mediaGallery">
                    @foreach ($imageUrls as $url)
                        <div class="media-item">
                            <img src="{{ $url }}" alt="Gallery Image">
                        </div>
                    @endforeach
                   @foreach ($videoUrls as $video)
                        <div class="media-item">
                            @if (Str::contains($video, 'youtube.com') || Str::contains($video, 'youtu.be'))
                                @php
                                    // Convert to embeddable format
                                    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\s&]+)/', $video, $matches);
                                    $youtubeId = $matches[1] ?? null;
                                @endphp
                                @if ($youtubeId)
                                    <iframe width="100%" height="200" 
                                        src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen></iframe>
                                @endif
                            @else
                                <video controls>
                                    <source src="{{ $video }}" type="video/{{ pathinfo($video, PATHINFO_EXTENSION) }}">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </div>
                    @endforeach

                </div>

        @if (count($imageUrls) + count($videoUrls) > 3)
            <button class="media-scroll-arrow right" onclick="scrollMediaGallery(1)">
                <img src="{{ asset('style/scrollRight.svg') }}" alt="Scroll Right">
            </button>
        @endif
    </div>

                @endif
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

        <script>
            const gallery = document.getElementById('mediaGallery');
            const leftArrow = document.querySelector('.media-scroll-arrow.left');
            const rightArrow = document.querySelector('.media-scroll-arrow.right');

            function scrollMediaGallery(direction) {
                const scrollAmount = gallery.clientWidth * 0.9;
                gallery.scrollBy({ left: scrollAmount * direction, behavior: 'smooth' });
            }

            function updateArrowVisibility() {
                if (!leftArrow || !rightArrow || !gallery) return;

                const scrollLeft = gallery.scrollLeft;
                const maxScrollLeft = gallery.scrollWidth - gallery.clientWidth;

                // Show/hide left arrow
                if (scrollLeft > 10) {
                    leftArrow.classList.add('visible');
                } else {
                    leftArrow.classList.remove('visible');
                }

                // Show/hide right arrow
                if (scrollLeft >= maxScrollLeft - 10) {
                    rightArrow.style.display = 'none';
                } else {
                    rightArrow.style.display = 'flex';
                }
            }

            if (gallery) {
                updateArrowVisibility();

                gallery.addEventListener('scroll', updateArrowVisibility);
                window.addEventListener('resize', updateArrowVisibility);
            }
        </script>



</body>

</html>
