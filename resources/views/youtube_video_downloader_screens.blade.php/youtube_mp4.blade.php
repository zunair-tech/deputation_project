<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Video Downloader</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
@include('navbar')

<style>
    html,
    body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
        background-color: white;
    }

    /* Push footer to bottom */
    .content {
        flex: 1;
    }

    .form-container {
        max-width: 600px;
        margin: 50px auto;
    }

    .input-group {
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .form-control {
        height: 45px;
        border-radius: 0;
        border: 1px solid #ced4da;
        padding: 10px 15px;
    }

    .btn-green {
        background-color: #7cd115;
        color: white;
        padding: 10px 20px;
        border: none;
        transition: 0.3s;
    }

    .btn-green:hover {
        background-color: #7cd115;
    }

    .terms-text {
        font-size: 14px;
        text-align: center;
        margin-top: 10px;
        color: #6c757d;
    }

    .terms-text a {
        color: green;
        text-decoration: none;
        font-weight: 500;
    }

    .terms-text a:hover {
        text-decoration: underline;
    }


    .footer {
        background-color: #f8f9fa;
        padding: 20px 0;
        text-align: center;
    }

    .footer a {
        color: #000;
        text-decoration: none;
        font-size: 14px;
        margin: 5px 10px;
        display: inline-block;
    }

    .footer a:hover {
        color: green;
        text-decoration: underline;
    }

    .footer-bottom {
        font-size: 14px;
        color: #6c757d;
        margin-top: 10px;
    }

    .terms-text,
    .legal-text {
        font-size: 14px;
        color: #666;
        margin-top: 10px;
    }

    .terms-text a,
    .legal-text a {
        color: #007bff;
        text-decoration: none;
    }

    .terms-text a:hover,
    .legal-text a:hover {
        text-decoration: underline;
    }

    .message {
        margin-top: 20px;
        color: red;
    }

    .section {
        text-align: left;
        margin-top: 30px;
    }

    .section h3 {
        color: #222;
        margin-bottom: 10px;
    }

    .section p {
        font-size: 14px;
        color: #444;
        line-height: 1.6;
    }

    .faq {
        margin-top: 30px;
        text-align: left;
    }

    .faq h3 {
        margin-bottom: 10px;
    }

    .faq p {
        font-size: 14px;
        color: #444;
    }

    .footer {
        margin-top: 40px;
        font-size: 12px;
        color: #666;
    }


    .scannedby {
        text-align: center;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); */
        font-family: Arial, sans-serif;
    }

    .scannedby h3 {
        color: #000000;
        margin-bottom: 10px;
    }

    .scannedby p {
        color: #000000;
        font-weight: bold;
    }

    .howtouse {
        max-width: 900px;
        margin: auto;
    }

    .howtouse h3 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
        color: #000000;
    }

    .steps-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .step-card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); */
        text-align: center;
        width: 250px;
        flex: 1;
        min-width: 250px;
    }

    .step-card i {
        font-size: 30px;
        color: #4CAF50;
        margin-bottom: 10px;
    }

    .step-card p {
        color: #000000;
        font-weight: bold;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .steps-container {
            flex-direction: column;
            align-items: center;
        }

    }

    .whychoose {
        text-align: center;
        padding: 50px 0;
    }

    .features-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .feature-box {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        width: 300px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .feature-box:hover {
        transform: translateY(-5px);
    }

    .feature-box i {
        font-size: 30px;
        color: green;
        margin-bottom: 10px;
    }

    .feature-box p {
        font-size: 16px;
        margin: 0;
    }

    @media (max-width: 768px) {
        .features-container {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">YouTube MP4 Video Downloader</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Step 1: Enter URL -->
        <form action="{{ route('video.fetchQualities') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" id="video_url" name="video_url"
                    placeholder="e.g., https://www.youtube.com/watch?v=IpZJ1SfNNmY" required>
                <button type="submit" class="btn btn-green">Get Quality Options</button>
            </div>
        </form>

        @if (isset($qualities))
            <!-- Step 2: Select Quality -->
            <form action="{{ route('video.download') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="video_id" value="{{ $videoId }}">

                <div class="mb-3">
                    <label for="download_url" class="form-label">Select Quality:</label>
                    <select class="form-control" id="download_url" name="download_url" required>
                        @php
                            $uniqueQualities = [];
                        @endphp

                        @foreach ($qualities as $quality)
                            @php
                                $displayQuality = str_replace('360', '720', $quality['quality']); // Replace 360 with 720
                            @endphp

                            @if (!in_array($quality['quality'], $uniqueQualities))
                                <option value="{{ $quality['url'] }}">{{ $displayQuality }}</option>
                                @php
                                    $uniqueQualities[] = $quality['quality']; // Store the displayed quality
                                @endphp
                            @endif
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Download Video</button>
            </form>
        @endif

        <p class="terms-text">
            By using our service you accept our
            <a href="#">Terms of Service</a> and
            <a href="#">Privacy Policy</a>.
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Nav Tabs -->
    <!-- Centered Buttons with Icons -->
    <div class="d-flex justify-content-center gap-3 my-3">
        <button class="btn custom-btn" id="youtube-tab" data-bs-toggle="tab" data-bs-target="#youtube" type="button"
            role="tab">
            <i class="fab fa-youtube"></i> YouTube
        </button>
        <button class="btn custom-btn" id="mp4-tab" data-bs-toggle="tab" data-bs-target="#mp4" type="button"
            role="tab">
            <i class="fas fa-file-video"></i> YouTube Mp4
        </button>
        <button class="btn custom-btn" id="shorts-tab" data-bs-toggle="tab" data-bs-target="#shorts" type="button"
            role="tab">
            <i class="fas fa-film"></i> YouTube Shorts
        </button>
        <button class="btn custom-btn" id="mp3-tab" data-bs-toggle="tab" data-bs-target="#mp3" type="button"
            role="tab">
            <i class="fas fa-music"></i> YouTube Mp3
        </button>
    </div>


    <!-- Content Area (Pushes Footer Down) -->
    <div class="scannedby">
        {{-- <h3>Instagram Reels Downloader</h3> --}}
        <p>Easily download your favorite Instagram Reels with our free and intuitive online downloader.</p>
        <p>Save inspiring and engaging videos directly to your device for offline viewing or sharing.</p>
    </div>

    <div class="howtouse">
        <h3>How to Use the Instagram Reels Downloader</h3>
        <div class="steps-container">
            <div class="step-card">
                <i class="fas fa-link"></i>
                <p><strong>1. Find and Copy URL:</strong> Copy the URL of the Instagram Reel you wish to download.</p>
            </div>
            <div class="step-card">
                <i class="fas fa-paste"></i>
                <p><strong>2. Paste the URL:</strong> Go to our downloader and paste the URL into the text box.</p>
            </div>
            <div class="step-card">
                <i class="fas fa-download"></i>
                <p><strong>3. Click 'Download':</strong> Choose a format and save the Reel for offline viewing.</p>
            </div>
        </div>
    </div>

    <div class="container whychoose">
        <h3 class="mb-4">Why Choose Our Facebook Reels Downloader?</h3>
        <div class="features-container">
            <div class="feature-box">
                <i class="fas fa-user-check"></i>
                <p><strong>User-Friendly Interface:</strong> Simple and easy to use, no technical knowledge needed.</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-money-bill-wave"></i>
                <p><strong>No Cost, No Catch:</strong> Our tool is completely free without any hidden fees.</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-cloud"></i>
                <p><strong>No Downloads Required:</strong> 100% web-based, no need to install software.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <h3 class="mb-4">Supported Resources</h3>
        <div class="d-flex flex-wrap justify-content-center">
            <button class="btn btn-primary btn-resource"><i class="fab fa-facebook"></i> Facebook</button>
            <button class="btn btn-danger btn-resource"><i class="fab fa-instagram"></i> Instagram</button>
            <button class="btn btn-dark btn-resource"><i class="fab fa-youtube"></i> YouTube</button>
            <button class="btn btn-info btn-resource"><i class="fab fa-twitter"></i> Twitter</button>
        </div>
    </div>

    <div class="container">
        <h3 class="mb-4">All Resources</h3>
        <div class="d-flex flex-wrap justify-content-center">
            <button class="btn btn-secondary btn-resource"><i class="fas fa-play"></i> Dailymotion</button>
            <button class="btn btn-dark btn-resource"><i class="fab fa-vimeo"></i> Vimeo</button>
            <button class="btn btn-primary btn-resource"><i class="fas fa-globe"></i> VK</button>
            <button class="btn btn-warning btn-resource"><i class="fab fa-soundcloud"></i> SoundCloud</button>
            <button class="btn btn-danger btn-resource"><i class="fab fa-threads"></i> Threads</button>
            <button class="btn btn-success btn-resource"><i class="fas fa-leaf"></i> Xiaohongshu</button>
            <button class="btn btn-info btn-resource"><i class="fab fa-tiktok"></i> TikTok</button>
            <button class="btn btn-danger btn-resource"><i class="fab fa-reddit"></i> Reddit</button>
        </div>
    </div>


    <div class="container">
        <h3 class="text-center mb-4">Frequently Asked Questions (FAQ)</h3>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse1">
                        Is this downloader really free?
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, our tool is completely free.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="faq2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse2">
                        Do I need to install any software?
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        No, our tool works directly from the browser.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="faq3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse3">
                        Is it legal to download Instagram Reels?
                    </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Downloading for personal use is fine, but respect copyright laws.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="faq4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse4">
                        Are there limits on downloads?
                    </button>
                </h2>
                <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        No, you can download as many Reels as you want.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="faq5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse5">
                        Can I use this tool on any device?
                    </button>
                </h2>
                <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, it works on both desktop and mobile devices.
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="legal-text">
        <h3>Legal Note</h3>
        <p>Downloading Instagram Reels for personal use is generally acceptable, but ensure compliance with copyright
            laws.</p>
        <p>Our service is not affiliated with Instagram and should be used responsibly.</p>
    </div>

    <div class="footer">
        <p>© 2008-2025 | SaveFrom.net | Norton™ Safe Web Verified</p>
        <p><a href="#">YouTube</a> | <a href="#">Instagram</a> | <a href="#">TikTok</a> | <a
                href="#">FAQ</a> | <a href="#">Terms of Service</a></p>
    </div>
    </div>
    <!-- Custom Styles -->
    <style>
        .custom-btn {
            background: #e2f2e1;
            /* Light green background */
            border: none;
            font-size: 16px;
            color: black;
            padding: 10px 15px;
            border-radius: 8px;
            /* Rounded corners */
            transition: 0.3s;
        }

        .custom-btn i {
            color: red;
            /* Only icons in red */
            margin-right: 5px;
        }

        .custom-btn:hover {
            background: #d0e8cf;
            /* Slightly darker green on hover */
        }
    </style>

</body>
<footer class="footer">
    <div class="container">
        <p><strong>English</strong></p>
        <div class="row">
            <div class="col-md-3 col-6">
                <a href="#">YouTube</a>
                <a href="#">YouTube to mp4</a>
                <a href="#">YouTube Shorts</a>
                <a href="#">YouTube Mp3</a>
            </div>
            <div class="col-md-3 col-6">
                <a href="#">APP</a>
                <a href="#">Instagram</a>
                <a href="#">IG stories</a>
                <a href="#">Instagram reels</a>
                <a href="#">Instagram viewer</a>
            </div>
            <div class="col-md-3 col-6">
                <a href="#">TikTok</a>
                <a href="#">TikTok mp4</a>
                <a href="#">TikTok mp3</a>
                <a href="#">Facebook</a>
                <a href="#">Vimeo</a>
                <a href="#">Twitter</a>
            </div>
            <div class="col-md-3 col-6">
                <a href="#">How to</a>
                <a href="#">Xiaohongshu</a>
                <a href="#">APK</a>
                <a href="#">FAQ</a>
                <a href="#">Install</a>
                <a href="#">For webmasters</a>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <a href="#">Feedback</a>
                <a href="#">API</a>
                <a href="#">Advertising</a>
                <a href="#">Terms of Service</a>
                <a href="#">EULA</a>
                <a href="#">PP</a>
            </div>
        </div>
        <p class="footer-bottom">© 2008-2025</p>
    </div>
</footer>

</html>
