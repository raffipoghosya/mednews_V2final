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
            <h1 class="news-heading"><a href="#">Նորություներ</a></h1>

            <div class="news-group-card">
                @foreach($latestNews as $news)
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
                {{ $latestNews->links('vendor.pagination.custom') }}
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
                        <div class="video-card" data-video="{{ $vid->link }}">
                            <div class="video-thumb" style="cursor: pointer;">
                                <img src="{{ asset('images/videos/' . $vid->img) }}" alt="Video" />
                                <div class="play-button">&#9658;</div>
                            </div>
                            <p>{{ $vid->title }} / {{ $vid->author }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Ads Section -->
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

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: #000;">
          <div class="modal-body" style="position: relative; padding: 0;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
              style="position: absolute; top: 10px; right: 15px; color: white; z-index: 9999;">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="video-container" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
              <iframe id="videoFrame" width="100%" height="100%" frameborder="0" allowfullscreen
                style="position: absolute; top: 0; left: 0;"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('components.footer')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.video-card').on('click', function () {
                const videoSrc = $(this).data('video');

                if (videoSrc && videoSrc.includes("youtube.com")) {
                    const embedSrc = videoSrc.replace("watch?v=", "embed/");
                    $('#videoFrame').attr('src', embedSrc + "?autoplay=1");
                    $('#videoModal').modal('show');
                } else {
                    alert("Տեսանյութի հղումը սխալ է կամ բացակայում է։");
                }
            });

            $('#videoModal').on('hidden.bs.modal', function () {
                $('#videoFrame').attr('src', '');
            });
        });
    </script>

</body>
</html>
