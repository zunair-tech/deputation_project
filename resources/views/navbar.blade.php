<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            padding: 15px 0;
        }
        .navbar-brand {
            font-size: 22px;
            font-weight: bold;
        }
        .nav-link {
            position: relative;
            font-size: 16px;
            color: black !important;
            padding: 8px 15px;
        }
        .nav-link:hover::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 2px;
            background-color: green;
        }
        .nav-item {
            margin: 0 10px;
        }
        .navbar-nav {
            margin: auto; 
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo/Title on the Left -->
            <a class="navbar-brand" href="#">Downloader</a>

            <!-- Navbar Toggler for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Centered Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('video.index') }}">YouTube</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('fb_videos.index') }}">Facebook</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('insta.index') }}">Instagram</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tiktok.index') }}">TikTok</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
