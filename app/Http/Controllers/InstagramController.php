<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InstagramController extends Controller
{

    public function insta_downloader()
    {
        return view('insta_downloader');
    }

    public function download(Request $request)
    {
        $url = $request->input('url');

        if (!$url) {
            return back()->with('error', 'No URL provided.');
        }

        if (strpos($url, 'instagram.com') === false) {
            return back()->with('error', 'Invalid Instagram URL.');
        }

        try {
            $client = new Client();
            $response = $client->request('GET', 'https://instagram-downloader-download-instagram-videos-stories1.p.rapidapi.com/get-info-rapidapi', [
                'query' => ['url' => $url],
                'headers' => [
                    'x-rapidapi-host' => 'instagram-downloader-download-instagram-videos-stories1.p.rapidapi.com',
                    'x-rapidapi-key' => 'd37de9bb7cmsh89fcffc89b71309p16e557jsn32bea3a7e7f6', // Replace with your actual API key
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            if (!$data || empty($data['download_url'])) {
                return back()->with('error', 'Failed to retrieve video download link.');
            }

            $videoUrl = $data['download_url'];
            $filename = 'instagram_video_' . time() . '.mp4';

            return new StreamedResponse(function () use ($videoUrl) {
                $stream = fopen($videoUrl, 'r');
                fpassthru($stream);
                fclose($stream);
            }, 200, [
                'Content-Type' => 'video/mp4',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error downloading Instagram video: ' . $e->getMessage());
        }
    }
}
