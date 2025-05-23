<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Video Downloader</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">YouTube Video Downloader</h2>
        <form action="{{ route('download.video') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="videoUrl" class="form-label">Enter YouTube Video URL</label>
                <input type="text" class="form-control" id="videoUrl" name="url" placeholder="Paste YouTube video URL here..." required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Get Download Link</button>
        </form>

        @if(session('download_url'))
            <div class="alert alert-success mt-3">
                <p>Download ready! Click below:</p>
                
                @if(session('is_mobile'))
                    <!-- On Mobile: Show only a normal link (no forced download) -->
                    <a href="{{ session('download_url') }}" class="btn btn-success">Download Now</a>
                @else
                    <!-- On Desktop: Force download -->
                    <a href="{{ session('download_url') }}" class="btn btn-success" download>Download Now</a>
                @endif
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-3">
                <p>{{ session('error') }}</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
