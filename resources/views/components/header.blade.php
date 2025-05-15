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
                <img src="{{ asset('style/logo.png') }}" alt="MedNews Logo" class="logo-img">
            </a>
        </div>

        <!-- Menu -->
        <nav class="menu-area">
            <ul class="menu-nav">
                <li><a href="{{ url('/interview') }}" class="menu-item">Հարցազրույց</a></li>
                <li><a href="{{ url('/news') }}" class="menu-item">Նորություն</a></li>
                <li><a href="{{ url('/videos') }}" class="menu-item">Տեսանյութ</a></li>
            </ul>
        </nav>

        <!-- Social Icons -->
        <div class="social-area">
            <div class="social-icons">
                <a href="#" class="social-icon">
                    <img src="{{ asset('style/facebook-icon.png') }}" alt="Facebook">
                </a>
                <a href="mailto:someone@example.com" class="social-icon">
                    <img src="{{ asset('style/email-icon.png') }}" alt="Email">
                </a>
                <a href="tel:+123456789" class="social-icon">
                    <img src="{{ asset('style/phone-icon.png') }}" alt="Phone">
                </a>
            </div>
        </div>

        <!-- Y Logo -->
        <div class="y-logo">
            <a href="#">
                <img src="{{ asset('style/y-logo.png') }}" alt="Y Logo" class="y-logo-img">
            </a>
        </div>
    </div>
</header>

</body>
</html>