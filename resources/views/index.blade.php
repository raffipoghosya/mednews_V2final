<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style_v2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reclam.css') }}">
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
    <link rel="stylesheet" href="{{ asset('css/videosc.css') }}">
    <title>Document</title>
</head>

<body style="display: flex; flex-direction: column; min-height: 100vh;">
    @include('components.header')

    @php $fallback = asset('images/posts/default.jpg'); @endphp

    <main>
        <section class="main-banner-section">
            <div class="container-two-column">
                <!-- Left Side: Main News -->
                <div class="left-banner">
                    <div class="image-wrapper">
                        <img id="main-img"
                            src="{{ asset('images/posts/' . (optional($lastPost)->img ?? 'default.jpg')) }}"
                            alt="{{ optional($lastPost)->title }}" class="banner-img"
                            onerror="this.onerror=null;this.src='{{ asset('images/posts/default.jpg') }}';">
                        <div class="dot-indicators"></div>
                    </div>

                    <h2 id="main-title" class="banner-title">{{ optional($lastPost)->title }}</h2>
                    <p id="main-text" class="banner-text">
                        {!! Str::limit(strip_tags(optional($lastPost)->description), 120) !!}
                        <a href="{{ route('news.show', optional($lastPost)->id) }}">Կարդալ ավելին</a>
                    </p>
                </div>

                <!-- Right Side: Doctors Grid -->
                <div class="right-doctors">
                    <div class="doctors-grid">
                        @foreach($lastPosts as $item)
                            <div class="doctor-card" data-id="{{ $item->id }}" data-title="{{ $item->title }}"
                                data-text="{{ strip_tags(Str::limit($item->description, 300)) }}"
                                data-url="{{ route('news.show', $item->id) }}">

                                <img src="{{ asset('images/posts/' . ($item->img ?? 'default.jpg')) }}"
                                    alt="{{ $item->title }}"
                                    onerror="this.onerror=null;this.src='{{ asset('images/posts/default.jpg') }}';">

                                <a href="{{ route('news.show', $item->id) }}" style="text-decoration: none;">
                                    <p>{!! Str::limit(strip_tags($item->description), 30) !!}</p>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Reclambanner -->
    <!-- <section class="ad-section"> -->
        <div class="ad-banner">
            @foreach($advertisements as $key => $item)
                <a href="{{ $item->href }}" target="_blank">
                    <img src="{{ asset('images/reclam/' . $item->img) }}" class="ad-image {{ $key === 0 ? 'active' : '' }}"
                        alt="Ad {{ $key + 1 }}">
                </a>
            @endforeach
        </div>
    <!-- </section> -->

    <!-- News Section -->
    <!-- <section class="news-section"> -->
        <div class="news-container">
            <!-- Left Column -->
            <div class="news-column">
                <h1 class="news-heading"><a href="#">ԼՐԱՏՎՈՒԹՅՈՒՆ</a></h1>
                <div class="news-group-card">
                    @foreach($lastPosts->take(3) as $item)
                        <div class="news-card">
                            <a href="{{ route('news.show', $item->id) }}">
                                <img src="{{ asset('images/posts/' . ($item->img ?? 'default.jpg')) }}"
                                    alt="{{ $item->title }}"
                                    onerror='this.onerror=null;this.src="{{ asset("images/posts/default.jpg") }}";'>
                            </a>
                            <div class="news-content">
                                <h3><a style="text-decoration: none;"
                                        href="{{ route('news.show', $item->id) }}">{{ $item->title }}</h3>
                                <p>{{ Str::limit(strip_tags($item->description), 100) }}</p>
                                <span class="news-date">{{ \Carbon\Carbon::parse($item->date)->format('d.m.y') }}</a></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Column -->
            <div class="news-column">
                <h1 class="news-heading"><a href="#">ԱՌԱՎԵԼ ԸՆԹԵՐՑՎԱԾ</a></h1>
                <div class="news-group-card">
                    @foreach($mostViewed as $item)
                        <div class="news-card">
                            <a href="{{ route('news.show', $item->id) }}">
                                <img src="{{ asset('images/posts/' . ($item->img ?? 'default.jpg')) }}"
                                    alt="{{ $item->title }}"
                                    onerror='this.onerror=null;this.src="{{ asset("images/posts/default.jpg") }}";'>
                            </a>
                            <div class="news-content">
                                <h3><a style="text-decoration: none;"
                                        href="{{ route('news.show', $item->id) }}">{{ $item->title }}</h3>
                                <p>{{ Str::limit(strip_tags($item->description), 100) }}</p>
                                <span class="news-date">{{ \Carbon\Carbon::parse($item->date)->format('d.m.y') }}</a></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    <!-- </section> -->

    <section class="video-slider-section">

        <button class="slider-btn prev" id="prevBtn" disabled>
            <img src="{{ asset('style/left.svg') }}" alt="Left Arrow">
        </button>
        <div class="slider-wrapper">
            <h2 class="section-title">ՏԵՍԱՆՅՈՒԹԵՐ</h2>
            <div class="slider-track">
                @foreach($videos as $video)
                    @php
                        // iframe src-ի արժեքը կստանանք regex-ով՝ $video->iframe դաշտից
                        preg_match('/src="([^"]+)"/', $video->iframe, $matches);
                        $videoSrc = $matches[1] ?? '';
                    @endphp
                    <div class="video-card" data-video="{{ $videoSrc }}">
                        <div class="video-thumb" style="cursor: pointer;">
                            <img src="{{ asset('images/videos/' . ($video->img ?? 'default.jpg')) }}"
                                alt="{{ $video->title }}">
                            <div class="play-button">&#9658;</div>
                        </div>
                        <p>{{ $video->title }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <button class="slider-btn next" id="nextBtn">
            <img src="{{ asset('style/right.svg') }}" alt="Right Arrow">
        </button>
    </section>

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
                    // Ավելացնում ենք autoplay
                    iframe.src = videoUrl + '?autoplay=1&rel=0';
                    modal.style.display = 'flex';
                });
            });

            closeModalBtn.addEventListener('click', () => {
                iframe.src = ''; // դադարեցնել վիդեո նվագարկումը
                modal.style.display = 'none';
            });

            // Կափարիչի կտտոցը նաև modal-ի ետին հատվածի վրա, փակելու համար
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    iframe.src = '';
                    modal.style.display = 'none';
                }
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const doctorCards = document.querySelectorAll('.doctor-card');
            const mainImg = document.getElementById('main-img');
            const mainTitle = document.getElementById('main-title');
            const mainText = document.getElementById('main-text');
            const dotContainer = document.querySelector('.dot-indicators');

            if (!doctorCards.length) return;

            let index = 0;

            doctorCards.forEach((_, i) => {
                const dot = document.createElement('div');
                dot.classList.add('dot');
                if (i === 0) dot.classList.add('active');
                dot.dataset.index = i;
                dot.addEventListener('click', () => {
                    index = i;
                    showSlide(index);
                });
                dotContainer.appendChild(dot);
            });

            function showSlide(i) {
                const card = doctorCards[i];
                const imgSrc = card.querySelector('img').src;
                const title = card.dataset.title || 'Բժիշկ';
                const text = card.dataset.text || 'Բժշկական գիտական միության ղեկավար';
                const url = card.dataset.url || '#';

                mainImg.src = imgSrc;
                mainTitle.textContent = title;
                mainText.innerHTML = text + ` <a href="${url}">Կարդալ ավելին</a>`;

                document.querySelectorAll('.dot').forEach(dot => dot.classList.remove('active'));
                document.querySelectorAll('.dot')[i].classList.add('active');
            }

            setInterval(() => {
                index = (index + 1) % doctorCards.length;
                showSlide(index);
            }, 5000);
        });

        document.addEventListener("DOMContentLoaded", function () {
            const adImages = document.querySelectorAll('.ad-banner img');
            let currentAd = 0;

            if (adImages.length > 0) {
                setInterval(() => {
                    adImages[currentAd].classList.remove('active');
                    currentAd = (currentAd + 1) % adImages.length;
                    adImages[currentAd].classList.add('active');
                }, 5000);
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            const sliderTrack = document.querySelector('.slider-track');
            const prevBtn = document.querySelector('.slider-btn.prev');
            const nextBtn = document.querySelector('.slider-btn.next');
            let scrollAmount = 0;
            const cardWidth = document.querySelector('.video-card').offsetWidth + 20;

            nextBtn.addEventListener('click', () => {
                scrollAmount += cardWidth;
                if (scrollAmount >= sliderTrack.scrollWidth - sliderTrack.offsetWidth) {
                    scrollAmount = sliderTrack.scrollWidth - sliderTrack.offsetWidth;
                }
                sliderTrack.style.transform = `translateX(-${scrollAmount}px)`;
                checkArrows();
            });

            prevBtn.addEventListener('click', () => {
                scrollAmount -= cardWidth;
                if (scrollAmount < 0) scrollAmount = 0;
                sliderTrack.style.transform = `translateX(-${scrollAmount}px)`;
                checkArrows();
            });

            function checkArrows() {
                prevBtn.disabled = scrollAmount === 0;
                nextBtn.disabled = scrollAmount >= (sliderTrack.scrollWidth - sliderTrack.offsetWidth);
            }

            checkArrows();
        });
    </script>

</body>

</html>