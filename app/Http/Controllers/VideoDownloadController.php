<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class VideoDownloadController extends Controller
{
    public function index()
    {
        return view('download');
    }

    public function fetchQualities(Request $request)
    {
        $videoUrl = $request->input('video_url');

        if (!$videoUrl) {
            return back()->with('error', 'Please enter a YouTube Video URL.');
        }

        $videoUrl = html_entity_decode($videoUrl);
        $videoId = $this->extractVideoId($videoUrl);

        if (!$videoId) {
            return back()->with('error', 'Invalid YouTube URL.');
        }

        try {
            $client = new Client();
            $response = $client->request('GET', 'https://ytstream-download-youtube-videos.p.rapidapi.com/dl', [
                'query' => ['id' => $videoId],
                'headers' => [
                    'x-rapidapi-host' => 'ytstream-download-youtube-videos.p.rapidapi.com',
                    'x-rapidapi-key' => env('RAPIDAPI_KEY'),
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            if ($data['status'] === "OK" && isset($data['formats'])) {
                $qualities = [];

                foreach ($data['formats'] as $format) {
                    if (isset($format['qualityLabel'], $format['url']) && isset($format['mimeType']) && strpos($format['mimeType'], 'audio') === false) {
                        // Only select formats that include both audio & video
                        $qualities[] = [
                            'quality' => $format['qualityLabel'],
                            'url' => $format['url']
                        ];
                    }
                }
                return view('download', [
                    'videoId' => $videoId,
                    'qualities' => $qualities
                ]);
            } else {
                return back()->with('error', 'No quality options found with audio.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error fetching video qualities. Please try again.');
        }
    }

    public function download(Request $request)
    {
        $downloadUrl = $request->input('download_url');

        if (!$downloadUrl) {
            return back()->with('error', 'Invalid download URL.');
        }

        return redirect()->away($downloadUrl);
    }

    // public function download(Request $request)
    // {
    //     $downloadUrl = $request->input('download_url');

    //     if (!$downloadUrl) {
    //         return back()->with('error', 'Invalid download URL.');
    //     }

    //     try {
    //         $client = new Client();
    //         $response = $client->request('GET', $downloadUrl, ['stream' => true]);

    //         $headers = [
    //             'Content-Type' => $response->getHeader('Content-Type')[0] ?? 'video/mp4',
    //             'Content-Disposition' => 'attachment; filename="video.mp4"',
    //         ];

    //         return new StreamedResponse(function () use ($response) {
    //             $body = $response->getBody();
    //             while (!$body->eof()) {
    //                 echo $body->read(1024 * 8); // Read in 8 KB chunks
    //                 flush();
    //             }
    //         }, 200, $headers);

    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Failed to download video. The link may have expired.');
    //     }
    // }

    private function extractVideoId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
        return $matches[1] ?? null;
    }



    public function downloadVideo(Request $request)
{
    $request->validate([
        'url' => 'required|url',
    ]);

    try {
        // Extract YouTube Video ID
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $request->url, $matches);

        if (!isset($matches[1])) {
            return redirect()->back()->with('error', 'Invalid YouTube URL.');
        }

        $videoId = $matches[1];

        // API request to fetch the download link
        $client = new Client();
        $response = $client->request('GET', 'https://cloud-api-hub-youtube-downloader.p.rapidapi.com/mux', [
            'query' => [
                'id' => $videoId,
                'quality' => '720',
                'codec' => 'h264',
                'audioFormat' => 'best',
                'language' => 'en',
            ],
            'headers' => [
                'x-rapidapi-host' => 'cloud-api-hub-youtube-downloader.p.rapidapi.com',
                'x-rapidapi-key' => 'd37de9bb7cmsh89fcffc89b71309p16e557jsn32bea3a7e7f6', // Replace with your actual API key
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if (!isset($data['url'])) {
            return redirect()->back()->with('error', 'Failed to get download link.');
        }

        // Detect mobile user agent
        $isMobile = $request->header('User-Agent') && preg_match('/Mobile|Android|iPhone|iPad/i', $request->header('User-Agent'));

        if ($isMobile) {
            // On mobile, return a normal link instead of forcing a download
            Session::flash('download_url', $data['url']);
            Session::flash('is_mobile', true);
        } else {
            // On desktop, force file download
            Session::flash('download_url', $data['url']);
            Session::flash('is_mobile', false);
        }

        return redirect()->back();

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
}
    
}
