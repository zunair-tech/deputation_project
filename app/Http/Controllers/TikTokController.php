<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use GuzzleHttp\Client;

class TikTokController extends Controller
{
    public function tiktok_downloader()
    {
        return view('tiktok_download');
    }


    public function downloadTikTokVideo(Request $request)
{
    $url = $request->input('url');

    // Validate URL input
    if (!$url) {
        return back()->with('error', 'No URL provided.');
    }

    // Ensure it is a TikTok URL
    if (strpos($url, 'tiktok.com') === false) {
        return back()->with('error', 'Invalid TikTok URL.');
    }

    try {
        $client = new Client();
        $response = $client->request('GET', 'https://tiktok-video-no-watermark2.p.rapidapi.com/', [
            'query' => ['url' => $url],
            'headers' => [
                'x-rapidapi-host' => 'tiktok-video-no-watermark2.p.rapidapi.com',
                'x-rapidapi-key' => 'YOUR_RAPIDAPI_KEY', // Replace with your actual API key
            ],
        ]);

        // Check if the API request was successful
        if ($response->getStatusCode() !== 200) {
            return back()->with('error', 'TikTok API request failed. Please try again later.');
        }

        $data = json_decode($response->getBody(), true);

        // Check if API response contains the video link
        if (!$data || empty($data['video']['no_watermark'])) {
            return back()->with('error', 'Failed to retrieve video download link.');
        }

        $videoUrl = $data['video']['no_watermark'];
        $filename = 'tiktok_video_' . time() . '.mp4';

        return new StreamedResponse(function () use ($videoUrl) {
            $stream = fopen($videoUrl, 'r');
            fpassthru($stream);
            fclose($stream);
        }, 200, [
            'Content-Type' => 'video/mp4',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);

    } catch (\GuzzleHttp\Exception\RequestException $e) {
        return back()->with('error', 'Error connecting to TikTok API: ' . $e->getMessage());
    } catch (\Exception $e) {
        return back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
    }
}

}
