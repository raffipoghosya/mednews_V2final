<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/footerv2.css') }}">
</head>

<body>
    <footer>
        <div class="footer-content">
            <!-- Left Side Links -->
            <div class="footer-left">
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}"><p>ԳԼԽԱՎՈՐ</p></a></li>
                    <li><a href="{{ url('/interview') }}"><p>ՀԱՐՑԱԶՐՈՒՅՑ</p></a></li>
                    <li><a href="{{ url('/news') }}"><p>ՆՈՐՈՒԹՅՈՒՆ</p></a></li>
                    <li><a href="{{ url('/videos') }}"><p>ՏԵՍԱԴԱՐԱՆ</p></a></li>
                </ul>
            </div>

            <!-- Right Side Contact Info -->
            <div class="footer-right">
                <div class="contact-info">
                    <p>info@mednews.am</p>
                    <div style =' height: 6px;'></div>
                    <p>Yerevan, Armenia</p>
                </div>

                <div class="logos">
                    <a href="#"><img src="{{ asset('style/yWeb.svg') }}" alt="Y Logo"></a>
                    <a href="#"> <img src="{{ asset('style/medNews.svg') }}" alt="Mednews logo" class="secondLogo">
                    </a>
                </div>

                <div class="yweb-text">
                    <img src="{{ asset('style/copyright.svg') }}" alt="Copyright symbol" class="copyright">
                    <p> Yweb</p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>