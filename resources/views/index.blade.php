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
    
<body style="display: flex; flex-direction: column; min-height: 100vh;   overflow-x: hidden;
    width: 100%;
    max-width: 100vw;">
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
                        {!! Str::limit(strip_tags(optional($lastPost)->description), 600) !!}
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
    <div class="ad-banner" id="ad-banner">
    @foreach($advertisements as $key => $item)
        <a href="{{ $item->href }}" target="_blank" class="ad-slide" style="display: {{ $key === 0 ? 'block' : 'none' }};">
            <img src="{{ asset('storage/'. $item->image) }}"
                 class="ad-image"
                 alt="Ad {{ $key + 1 }}">
        </a>
    @endforeach
</div>




    <!-- News Section -->
    <!-- <section class="news-section"> -->
    <div class="news-container">
        <!-- Left Column -->
        <div class="news-column">
            <h1 class="news-heading"><a href="#">ԼՐԱՀՈՍ</a></h1>
            <div class="news-group-card">
                @foreach($lastPosts->take(3) as $item)
                    <div class="news-card">
                        <a href="{{ route('news.show', $item->id) }}">
                            <img src="{{ asset('images/posts/' . ($item->img ?? 'default.jpg')) }}" alt="{{ $item->title }}"
                                onerror='this.onerror=null;this.src="{{ asset("images/posts/default.jpg") }}";'>
                        </a>
                        <div class="news-content">
                            <h3><a style="text-decoration: none;"
                                    href="{{ route('news.show', $item->id) }}">{{ $item->title }}</h3>
                            <p>{{ Str::limit(strip_tags($item->description), 250) }}</p>
                            <span class="news-date">{{ \Carbon\Carbon::parse($item->date)->format('d.m.y') }}</a></span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="divider"></div>
        <!-- Right Column -->
        <div class="news-column">
            <h1 class="news-heading"><a href="#">ԱՌԱՎԵԼ ԸՆԹԵՐՑՎԱԾ</a></h1>
            <div class="news-group-card">
                @foreach($mostViewed as $item)
                    <div class="news-card">
                        <a href="{{ route('news.show', $item->id) }}">
                            <img src="{{ asset('images/posts/' . ($item->img ?? 'default.jpg')) }}" alt="{{ $item->title }}"
                                onerror='this.onerror=null;this.src="{{ asset("images/posts/default.jpg") }}";'>
                        </a>
                        <div class="news-content">
                            <h3><a style="text-decoration: none;"
                                    href="{{ route('news.show', $item->id) }}">{{ $item->title }}</h3>
                            <p>{{ Str::limit(strip_tags($item->description), 250) }}</p>
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
            <img src="{{ asset('style/left.svg') }}" alt="Left Arrow" class="arrow">
        </button>
        <div class="slider-wrapper">
        <a style="text-decoration: none;" href="/videos"><h2 class="section-title">ՏԵՍԱԴԱՐԱՆ</h2></a>
            <div class="slider-track">
                @foreach($videos as $video)
                    @php
    // iframe src-ի արժեքը կստանանք regex-ով՝ $video->iframe դաշտից
    preg_match('/src="([^"]+)"/', $video->iframe, $matches);
    $videoSrc = $matches[1] ?? '';
                    @endphp
                <div class="video-card" data-video="{{ $videoSrc }}" data-title="{{ $video->title }}">
                        <div class="video-thumb" style="cursor: pointer;">
                            <img src="{{ asset('images/videos/' . ($video->img ?? 'default.jpg')) }}"
                                alt="{{ $video->title }}">
                            <img src="{{ asset('style/play_button.svg') }}" alt="Play Button" class="play-button">
                        </div>
                     <p class="videoTitle">{{ $video->title }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <button class="slider-btn next" id="nextBtn">
            <img src="{{ asset('style/right.svg') }}" alt="Right Arrow" class="arrow">
        </button>
    </section>

    @include('components.footer')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("videoModal");
            const videoFrame = document.getElementById("videoFrame");
            const closeModalBtn = document.getElementById("closeModalBtn");

            document.querySelectorAll(".video-card, .video-card-short").forEach((card) => {
                card.addEventListener("click", () => {
                    const videoSrc = card.getAttribute("data-video");
                const title = card.querySelector(".videoTitle")?.textContent;
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('#ad-banner .ad-slide');
        let currentIndex = 0;
        const totalSlides = slides.length;

        setInterval(() => {
            // Հետ դ隐藏 текущее изображение
            slides[currentIndex].style.display = 'none';

            // Փոխում ենք ինդեքսը հաջորդի
            currentIndex = (currentIndex + 1) % totalSlides;

            // Ցույց ենք տալիս հաջորդ նկարը
            slides[currentIndex].style.display = 'block';
        }, 7000); // 7000 ms = 7 վարկյան
    });
</script>





</body>

</html>