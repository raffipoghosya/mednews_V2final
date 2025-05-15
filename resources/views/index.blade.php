<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/stylev2.css') }}">
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
                            src="{{ asset('images/posts/' . (optional($mainNews)->img ?? 'default.jpg')) }}"
                            alt="{{ optional($mainNews)->title }}" class="banner-img"
                            onerror="this.onerror=null;this.src='{{ asset('images/posts/default.jpg') }}';">
                        <div class="dot-indicators"></div>
                    </div>

                    <h2 id="main-title" class="banner-title">{{ optional($mainNews)->title }}</h2>
                    <p id="main-text" class="banner-text">
                        {!! Str::limit(strip_tags(optional($mainNews)->description), 460) !!}
                        <a href="{{ route('news.show', optional($mainNews)->id) }}">Կարդալ ավելին</a>
                    </p>
                </div>

                <!-- Right Side: Doctors Grid -->
                <div class="right-doctors">
                    <div class="doctors-grid">
                        @foreach($doctors as $doctor)
                            <div class="doctor-card" data-id="{{ $doctor->id }}" data-title="{{ $doctor->title }}"
                                data-text="{{ strip_tags(Str::limit($doctor->description, 100)) }}"
                                data-url="{{ route('news.show', $doctor->id) }}">
                                <img src="{{ asset('images/posts/' . ($doctor->img ?? 'default.jpg')) }}"
                                    alt="{{ $doctor->title }}"
                                    onerror="this.onerror=null;this.src='{{ asset('images/posts/default.jpg') }}';">
                                <p id="main-text" class="banner-text">
                                    {!! Str::limit(strip_tags(optional($mainNews)->description), 97) !!}
                                    <a href="{{ route('news.show', optional($mainNews)->id) }}">Կարդալ ավելին</a>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Reclambanner -->
    <section class="ad-section">
        <div class="ad-banner">
            @foreach($reclamtops as $key => $reclam)
                <a href="{{ $reclam->href }}" target="_blank">
                    <img src="{{ asset('images/reclam/' . $reclam->img) }}"
                        class="ad-image {{ $key === 0 ? 'active' : '' }}" alt="Ad {{ $key + 1 }}">
                </a>
            @endforeach
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section">
        <div class="news-container">
            <!-- Left Column -->
            <div class="news-column">
                <h1 class="news-heading"><a href="#">ԼՐԱՏՎՈՒԹՅՈՒՆ</a></h1>
                <div class="news-group-card">
                    @foreach($latestNews as $news)
                        <div class="news-card">
                            <a href="{{ route('news.show', $news->id) }}">
                                <img src="{{ asset('images/posts/' . ($news->img ?? 'default.jpg')) }}"
                                    alt="{{ $news->title }}"
                                    onerror='this.onerror=null;this.src="{{ asset("images/posts/default.jpg") }}";'>
                            </a>
                            <div class="news-content">
                                <h3><a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a></h3>
                                <p>{{ Str::limit(strip_tags($news->description), 100) }}</p>
                                <span class="news-date">{{ \Carbon\Carbon::parse($news->date)->format('d.m.y') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Column -->
            <div class="news-column">
                <h1 class="news-heading"><a href="#">ԱՌԱՎԵԼ ԸՆԹԵՐՑՎԱԾ</a></h1>
                <div class="news-group-card">
                    @foreach($mostRead as $news)
                        <div class="news-card">
                            <a href="{{ route('news.show', $news->id) }}">
                                <img src="{{ asset('images/posts/' . ($news->img ?? 'default.jpg')) }}"
                                    alt="{{ $news->title }}"
                                    onerror='this.onerror=null;this.src="{{ asset("images/posts/default.jpg") }}";'>
                            </a>
                            <div class="news-content">
                                <h3><a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a></h3>
                                <p>{{ Str::limit(strip_tags($news->description), 100) }}</p>
                                <span class="news-date">{{ \Carbon\Carbon::parse($news->date)->format('d.m.y') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Videos Section -->
    <section class="video-slider-section">
        <h2 class="section-title">ՏԵՍԱՆՅՈՒԹԵՐ</h2>
        <button class="slider-btn prev" id="prevBtn" disabled>
            <img src="{{ asset('style/left.svg') }}" alt="Left Arrow">
        </button>
        <div class="slider-wrapper">
            <div class="slider-track">
                @foreach($videos as $video)
                    <div class="video-card" data-video="{{ $video->link }}">
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
   


       <!-- Video Modal -->
       <!-- <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background: #000;">
                <div class="modal-body" style="position: relative; padding: 0;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="position: absolute; top: 10px; right: 15px; color: white; z-index: 9999;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="video-container"
                        style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                        <iframe id="videoFrame" width="100%" height="100%" frameborder="0" allowfullscreen
                            style="position: absolute; top: 0; left: 0;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const videoCards = document.querySelectorAll('.video-card');

            videoCards.forEach(card => {
                card.addEventListener('click', () => {
                    const videoSrc = card.getAttribute('data-video');
                    if (!videoSrc) return alert("Տեսանյութի հղումը բացակայում է։");

                    let embedLink = '';

                    if (videoSrc.includes("youtube.com/watch?v=")) {
                        embedLink = videoSrc.replace("watch?v=", "embed/");
                    } else if (videoSrc.includes("youtu.be/")) {
                        const id = videoSrc.split("youtu.be/")[1];
                        embedLink = "https://www.youtube.com/embed/" + id;
                    } else if (videoSrc.includes("youtube.com/embed/")) {
                        embedLink = videoSrc;
                    } else {
                        return alert("Տեսանյութի հղումը սխալ է։");
                    }

                    document.getElementById('videoFrame').src = embedLink + '?autoplay=1';
                    $('#videoModal').modal('show');
                });
            });

            $('#videoModal').on('hidden.bs.modal', function () {
                document.getElementById('videoFrame').src = '';
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