<!DOCTYPE html>
<html lang="hy">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MedNews</title>
    <link rel="stylesheet" href="{{ asset('css/video1.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

    @include('components.header')

    <div class="container-fluid">
        <!-- Video Gallery Section -->
        <section class="video-gallery">
            <h2 class="section-title">ՏԵՍԱՆՅՈՒԹԵՐ</h2>
            <div class="video-container">
                @for ($i = 0; $i < 20; $i++)
                    @php $vid = $video[$i % count($video)]; @endphp
                    <div class="video-card">
                        <div class="video-thumb">
                            <img src="{{ asset('images/videos/' . $vid->img) }}" alt="Video" />
                            <div class="play-button">&#9658;</div>
                        </div>
                        <p>{{ $vid->title }} / {{ $vid->author }}</p>
                    </div>
                @endfor
            </div>
        </section>

        <!-- Shorts Section -->
        <!-- Shorts Section -->
        <!-- Shorts Section -->
        <section class="video-short-section">
            <h2 class="section-title">SHORTS</h2>
            <div class="video-short-container">
                @foreach($shorts as $short)
                    <div class="video-card-short">
                        <div class="video-thumb">
                            <img src="{{ asset('images/videos/' . $short->img) }}" alt="Video" />
                            <div class="play-button">&#9658;</div>
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
                        <li class="disabled"><span>&lsaquo;</span></li>
                    @else
                        <li><a href="{{ $shorts->previousPageUrl() }}" rel="prev">&lsaquo;</a></li>
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
                            <li class="disabled"><span>...</span></li>
                        @endif
                        <li><a href="{{ $shorts->url($total) }}">{{ $total }}</a></li>
                    @endif

                    @if ($shorts->hasMorePages())
                        <li><a href="{{ $shorts->nextPageUrl() }}" rel="next">&rsaquo;</a></li>
                    @else
                        <li class="disabled"><span>&rsaquo;</span></li>
                    @endif
                </ul>
            @endif
        </section>

    </div>

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>

</body>

</html>