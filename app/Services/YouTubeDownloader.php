<?php
namespace App\Services;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class YouTubeDownloader
{
    protected $ytDlp;

    public function __construct()
{
    // Use backslashes for Windows-style paths
    $this->ytDlp = base_path('public\\yt-dlp.exe');  // Double backslashes for Windows
}


    public function downloadVideo($url)
    {
        // Command to download the video
        $process = new Process([$this->ytDlp, '-f', 'best', $url]);

        try {
            $process->mustRun();  // Execute the command and check for errors
            $output = $process->getOutput();  // Get output of the process (video download info)
            return $output;
        } catch (ProcessFailedException $exception) {
            // Handle errors
            return $exception->getMessage();
        }
    }
}
