<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/hederv2.css') }}">
</head>

<body>
    <header>
        <div class="custom-header">
            <!-- Logo -->
            <div class="logo-area">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('style/medNewsHeader.svg') }}" alt="MedNews Logo" class="logo-img">
                </a>
            </div>

            <!-- Menu -->
            <nav class="menu-area">
                <ul class="menu-nav">
                    <li><a href="{{ url('/interview') }}" class="menu-item">ՀԱՐՑԱԶՐՈՒՅՑ</a></li>
                    <li><a href="{{ url('/news') }}" class="menu-item">ՆՈՐՈՒԹՅՈՒՆ</a></li>
                    <li><a href="{{ url('/videos') }}" class="menu-item">ՏԵՍԱԴԱՐԱՆ</a></li>
                </ul>
            </nav>

            <!-- Social Icons -->
            <div class="social-area">
                <div class="social-icons">
                    <a href="#" class="social-icon">
                        <img src="{{ asset('style/fbLogo.svg') }}" alt="Facebook">
                    </a>
                    <a href="mailto:someone@example.com" class="social-icon">
                        <img src="{{ asset('style/emailIcon.svg') }}" alt="Email">
                    </a>
                    <a href="tel:+123456789" class="social-icon">
                        <img src="{{ asset('style/phoneIcon.svg') }}" alt="Phone">
                    </a>
                </div>
            </div>

            <!-- Y Logo -->
            <a href="#">
                <img src="{{ asset('style/yWebHeader.svg') }}" alt="Y Logo" class="y-logo-img">
            </a>
        </div>
    </header>

</body>

</html>