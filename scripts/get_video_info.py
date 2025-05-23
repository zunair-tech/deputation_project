import sys
import json
import youtube_dl

def get_video_info(url):
    try:
        ydl_opts = {
            'quiet': True,
            'skip_download': True,
        }

        with youtube_dl.YoutubeDL(ydl_opts) as ydl:
            info = ydl.extract_info(url, download=False)

        video_info = {
            "title": info.get("title"),
            "author": info.get("uploader"),
            "length": info.get("duration"),
            "views": info.get("view_count"),
            "description": info.get("description"),
            "publish_date": info.get("upload_date"),
            "thumbnail": info.get("thumbnail"),
            "resolutions": [f"{f['height']}p" for f in info.get("formats", []) if f.get("height")]
        }

        print(json.dumps(video_info))

    except Exception as e:
        print(json.dumps({"error": str(e)}))

if __name__ == "__main__":
    url = sys.argv[1]
    get_video_info(url)
