<?php

use App\Http\Controllers\FacebookVideoController;
use App\Http\Controllers\InstagramController;
use App\Http\Controllers\TikTokController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoDownloadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard');
// });


Route::get('/', [VideoDownloadController::class, 'index']);
Route::get('/download', [VideoDownloadController::class, 'index'])->name('video.index');
Route::post('/youtube/download', [VideoDownloadController::class, 'download'])->name('video.download');
Route::post('/fetch-qualities', [VideoDownloadController::class, 'fetchQualities'])->name('video.fetchQualities');
Route::get('/merge-video/{videoUrl}/{audioUrl}', [VideoDownloadController::class, 'mergeVideoAudio']);

Route::get('/fb/download', [FacebookVideoController::class, 'fb_downloader'])->name('fb_videos.index');

// Route::get('/facebook-video-downloader', function () {
//     return view('fb_downloader');
// });
Route::get('/download-facebook-video', [FacebookVideoController::class, 'download'])->name('facebook.download');
// Route::get('/force-download', [FacebookVideoController::class, 'download'])->name('forceDownload');


Route::get('/insta/download', [InstagramController::class, 'insta_downloader'])->name('insta.index');
Route::get('/download-instagram-video', [InstagramController::class, 'download'])->name('intagram.download');

Route::get('/tikto/download', [TikTokController::class, 'tiktok_downloader'])->name('tiktok.index');
Route::get('/download-tiktok-video', [TikTokController::class, 'downloadTikTokVideo'])->name('tiktok.download');



Route::get('/video-downloaderrrr', function () {
    return view('dashboard'); // Changed view name for clarity
})->name('video.download.page');

Route::post('/download-video', [VideoDownloadController::class, 'downloadVideo'])->name('download.video');

// Route::get('/youtube-videos', function () {
//     return view('download');
// })->name('youtube.index');

// Route::get('/facebook-videos', function () {
//     return view('facebook_videos');
// })->name('facebook.index');
