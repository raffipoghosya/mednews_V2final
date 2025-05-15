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
                <li><a href="{{ url('/') }}">Գլխավոր</a></li>
                <li><a href="{{ url('/interview') }}">Հարցազրույց</a></li>
                <li><a href="{{ url('/news') }}">Նորություններ</a></li>
                <li><a href="{{ url('/videos') }}">Տեսադարան</a></li>
            </ul>
        </div>

        <!-- Right Side Contact Info -->
        <div class="footer-right">
            <div class="contact-info">
                <p>info@mednews.am</p>
                <p>Yerevan, Armenia</p>
            </div>

            <div class="logos">
                <a href="#"><img src="{{ asset('style/footer1.png') }}" alt="Y Logo"></a>
                <a href="#"><img src="{{ asset('style/footer.png') }}" alt="Second Logo" class="second-logo"></a>
            </div>

            <div class="yweb-text">
                <p>@Yweb</p>
            </div>
        </div>
    </div>
</footer>

</body>
</html>