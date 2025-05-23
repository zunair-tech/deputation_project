<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Process\Process;  // ✅ Import Symfony Process


class FacebookVideoController extends Controller
{

    public function fb_downloader()
    {
        return view('fb_downloader');
    }

    public function download(Request $request)
    {
        $url = $request->input('url');

        if (!$url) {
            return back()->with('error', 'No URL provided.');
        }

        try {
            $client = new Client();
            $response = $client->request('GET', 'https://instagram-downloader-download-instagram-videos-stories1.p.rapidapi.com/get-info-rapidapi', [
                'query' => ['url' => $url],
                'headers' => [
                    'x-rapidapi-host' => 'instagram-downloader-download-instagram-videos-stories1.p.rapidapi.com',
                    'x-rapidapi-key' => 'd37de9bb7cmsh89fcffc89b71309p16e557jsn32bea3a7e7f6',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            if (!$data || !isset($data['download_url'])) {
                return back()->with('error', 'Failed to get video download link.');
            }

            $videoUrl = $data['download_url'];
            $filename = 'facebook_video_' . time() . '.mp4';

            return new StreamedResponse(function () use ($videoUrl) {
                $stream = fopen($videoUrl, 'r');
                fpassthru($stream);
                fclose($stream);
            }, 200, [
                'Content-Type' => 'video/mp4',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error downloading video: ' . $e->getMessage());
        }
        //     public function download(Request $request)
        // {
        //     $url = $request->input('url');

        //     if (!$url) {
        //         return back()->with('error', 'No URL provided.');
        //     }

        //     try {
        //         $client = new Client();
        //         $response = $client->request('GET', 'https://instagram-downloader-download-instagram-videos-stories1.p.rapidapi.com/get-info-rapidapi', [
        //             'query' => ['url' => $url],
        //             'headers' => [
        //                 'x-rapidapi-host' => 'instagram-downloader-download-instagram-videos-stories1.p.rapidapi.com',
        //                 'x-rapidapi-key' => 'd37de9bb7cmsh89fcffc89b71309p16e557jsn32bea3a7e7f6',
        //             ],
        //         ]);

        //         $data = json_decode($response->getBody(), true);

        //         if (!$data || !isset($data['download_url'])) {
        //             return back()->with('error', 'Failed to get video download link.');
        //         }

        //         $videoUrl = $data['download_url'];
        //         $thumbnail = $data['thumb'] ?? null; // Fetch thumbnail if available
        //         $quality = $data['quality'] ?? 'Unknown'; // Fetch quality if available
        //         $filename = 'facebook_video_' . time() . '.mp4';

        //         return view('fb_downloader', [
        //             'thumbnail' => $thumbnail,
        //             'download_url' => $videoUrl,
        //             'quality' => $quality,
        //             'filename' => $filename
        //         ]);

        //     } catch (\Exception $e) {
        //         return back()->with('error', 'Error downloading video: ' . $e->getMessage());
        //     }
        // }

    }
}
