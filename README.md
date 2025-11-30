# Freepik Downloader

This is a simple PHP script that allows you to download assets from **Freepik** using your own **cookies.txt** for authentication. You need to replace the `WALLET_ID` constant with your personal wallet ID from your Freepik account in order to download images, icons, or videos.

## Features
- Download images, icons, and videos from Freepik.
- Requires exported cookies from your Freepik account.
- Access download links for licensed content using your subscription.

## Requirements

1. PHP installed on your server.
2. Export your cookies using **[Cookie Exporter](https://github.com/realSina/cookie-exporter)**.
3. A valid Freepik account with an active subscription.

## Setup

1. **Download the repository** to your local server or web server.
2. **Edit the script**:
   - Open the PHP file and find the line with `define('WALLET_ID', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');`.
   - Replace `XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX` with your actual wallet ID from your Freepik account.
   
## How to Use

1. Place the `cookies.txt` file from your Freepik account in the same directory as the script.
2. Visit the script's URL in the browser with the URL of the asset you want to download. For example: http://yourdomain.com/freepik-downloader.php?url=<freepik_content_url>

## License

MIT License. See the [LICENSE](LICENSE) file for details.

## Disclaimer

Ensure you comply with Freepik's terms of service and copyright laws. This script is intended for personal use only.
