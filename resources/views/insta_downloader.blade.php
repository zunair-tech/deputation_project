@include('navbar')

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
    }

    .container {
        /* max-width: 800px; */
        margin: 50px auto;
        background: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h2 {
        color: #222;
    }

    .input-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    input {
        width: 70%;
        padding: 10px;
        border: 2px solid #7ed214;
        border-radius: 5px;
        font-size: 16px;
        outline: none;
    }

    button {
        background-color: #7ed214;
        /* Light Green */
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
        margin-left: 5px;
        transition: 0.3s;
    }

    button:hover {
        background-color: #7cb342;
        color: white;
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


        .whychoose {
            width: 100%;
            background: #4CAF50; /* Light green background */
            color: white;
            padding: 40px 20px;
            box-sizing: border-box;
        }

        .whychoose h3 {
            font-size: 26px;
            margin-bottom: 20px;
        }

        .features-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .feature-box {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            width: 250px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .feature-box i {
            font-size: 40px;
            color: white;
            margin-bottom: 10px;
        }

        .feature-box p {
            font-size: 16px;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .features-container {
                flex-direction: column;
                align-items: center;
            }
        }
    }
</style>
@if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
<div class="container">

    <h2 class="center">Instagram Video Downloader</h2>
    <form id="downloadForm">
        <div class="input-container">
            <input type="text" id="videoUrl" name="url" placeholder="Enter Instagram Video URL" required>
            <button type="submit">Download Video</button>
        </div>
        <p class="terms-text">
            By using our service you accept our
            <a href="#">Terms of Service</a> and
            <a href="#">Privacy Policy</a>.
        </p>
    </form>

    <p id="errorMessage" class="message" style="display: none;"></p>

    <div class="scannedby">
        <h3>Scanned by</h3>
        <p>Norton - Norton™ Safe Web</p>
    </div>

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

    <div class="whychoose">
        <h3>Why Choose Our Instagram Reels Downloader?</h3>
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
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
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
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
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
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
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
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
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
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
    document.getElementById('downloadForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent page reload

        let urlInput = document.getElementById('videoUrl');
        let errorMessage = document.getElementById('errorMessage');

        if (!urlInput.value.trim()) {
            errorMessage.textContent = "Please enter a valid URL.";
            errorMessage.style.display = "block";
            return;
        }

        // Redirect to download route
        window.location.href = "{{ route('intagram.download') }}?url=" + encodeURIComponent(urlInput.value);

        // Clear input after submission
        urlInput.value = "";
    });
</script>
