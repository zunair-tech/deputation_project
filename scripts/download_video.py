import sys
import os
import json
import youtube_dl

def download_video(url, resolution):
    try:
        download_folder = os.path.join(os.getcwd(), "public/downloads")
        if not os.path.exists(download_folder):
            os.makedirs(download_folder)

        ydl_opts = {
            'format': f'bestvideo[height<={resolution}]+bestaudio/best[height<={resolution}]',
            'outtmpl': os.path.join(download_folder, '%(title)s.%(ext)s'),
            'merge_output_format': 'mp4',
        }

        with youtube_dl.YoutubeDL(ydl_opts) as ydl:
            ydl.download([url])

        print(json.dumps({"message": "Downloaded successfully!", "file_path": download_folder}))

    except Exception as e:
        print(json.dumps({"error": str(e)}))

if __name__ == "__main__":
    url = sys.argv[1]
    resolution = sys.argv[2]
    download_video(url, resolution)
